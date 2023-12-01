<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Api\Controller;
use App\Models\Api\Task;
use App\Models\Reward;
use App\Models\RewardAccounting;
use App\Models\Role;
use App\Models\WebinarChapter;
use App\User;
use App\Models\Webinar;
use App\Models\Api\TasksResult;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TasksResultController extends Controller
{
    public function myResults(Request $request)
    {
        $taskResults = apiAuth()->taskResults()->handleFilters()
            ->orderBy('created_at', 'desc')
            ->get()->map(function ($taskResult) {
                return $taskResult->details;
            });

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'results' => $taskResults
        ]);

    }

    public function myStudentResult(Request $request)
    {
        $user = apiAuth();
        $tasks_id = Task::where('creator_id', $user->id)
            ->where('status', 'active')
            ->get()->pluck('id')->toArray();

        $taskResults = TasksResult::whereIn('task_id', $tasks_id)->handleFilters()
            ->orderBy('created_at', 'desc')
            ->get()->map(function ($taskResult) {
                return $taskResult->details;
            });
        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'results' => $taskResults
        ]);

    }

    public function status($taskResultId)
    {
        $user = apiAuth();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->where('user_id', $user->id)
            ->first();

        if (!$taskResult) {
            abort(404);
        }

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'result' => $taskResult->details
        ]);

    }

    public function start(Request $request, $id)
    {
        $user = apiAuth();
        $task = Task::find($id);
        if (!$task) {
            abort(404);
        }
        $auth_can_take_task_status = $task->auth_can_take_task_status;

        if ($auth_can_take_task_status != 'ok') {
            return apiResponse2(0, $auth_can_take_task_status, trans('api.public.stored'));
        }

        $userTaskDone = TasksResult::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->get();

        $newTaskStart = TasksResult::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'results' => '',
            'user_grade' => 0,
            'status' => 'waiting',
            'created_at' => time()
        ]);

        return apiResponse2(1, 'stored', trans('api.public.stored'),
            [
                'task_result_id' => $newTaskStart->id,
                'task' => $task->details, 'attempt_number' => $userTaskDone->count() + 1]);


    }

    public function tasksStoreResult(Request $request, $id)
    {

        $user = apiAuth();
        $task = Task::where('id', $id)->first();
        abort_unless($task, 404);

        validateParam($request->all(), [
            'task_result_id' => [
                'required', Rule::exists('tasks_results', 'id')->where('user_id', $user->id)
            ],
            'answer_sheet' => ['nullable', 'array', 'min:0'],

            'answer_sheet.*.answer' => ['nullable',

            ],

        ]);

        $auth_can_take_task_status = $task->auth_can_take_task_status;


        $answer_sheet = $request->get('answer_sheet');
        $taskResultId = $request->get('task_result_id');

        if ($task) {

            if (!empty($taskResultId)) {

                $taskResult = TasksResult::where('id', $taskResultId)
                    ->where('user_id', $user->id)
                    ->first();

                if (!empty($taskResult)) {

                    $passMark = $task->pass_mark;
                    $totalMark = 0;
                    $status = '';


                    if (empty($status)) {
                        $status = ($totalMark >= $passMark) ? TasksResult::$passed : TasksResult::$failed;
                    }

                    $attempt_count = TasksResult::where('task_id', $task->id)
                        ->where('user_id', $user->id)
                        ->count();

                    $results["attempt_number"] = $attempt_count;

                    $taskResult->update([
                        'results' => json_encode($results),
                        'user_grade' => $totalMark,
                        'status' => $status,
                        'created_at' => time()
                    ]);

                    if ($taskResult->status == TasksResult::$waiting) {
                        $notifyOptions = [
                            '[c.title]' => $task->webinar ? $task->webinar->title : '-',
                            '[student.name]' => $user->full_name,
                            '[q.title]' => $task->title,
                        ];
                        sendNotification('waiting_task', $notifyOptions, $task->creator_id);
                    }

                    if ($taskResult->status == TasksResult::$passed) {
                        $passTheTaskReward = RewardAccounting::calculateScore(Reward::PASS_THE_TASK);
                        RewardAccounting::makeRewardAccounting($taskResult->user_id, $passTheTaskReward, Reward::PASS_THE_TASK, $task->id, true);
                    }

                    if ($task->certificate) {
                        $certificateReward = RewardAccounting::calculateScore(Reward::CERTIFICATE);
                        RewardAccounting::makeRewardAccounting($taskResult->user_id, $certificateReward, Reward::CERTIFICATE, $task->id, true);
                    }

                    return apiResponse2(1, 'stored', trans('api.public.stored'), [
                        'result' => $taskResult->details
                    ]);
                    //  return redirect()->route('task_status', ['taskResultId' => $taskResult]);
                }
            }
        }
        abort(404);
    }

    public function updateResult(Request $request, $taskResultId)
    {

        $user = apiAuth();

        $taskResult = TasksResult::where('id', $taskResultId)->first();
        abort_unless($taskResult, 404);


        $task = $taskResult->task()->where('creator_id', $user->id)->first();
        abort_unless($task, 404);


        validateParam($request->all(), [
            '*.grade' => 'required',

        ]);

        if (!$taskResult->reviewable) {
            return apiResponse2(0, 'unreviewable', trans('api.task.retrieved'));
        }


        $taskResult = TasksResult::where('id', $taskResultId)
            ->where('task_id', $task->id)
            ->first();

        $oldResults = json_decode($taskResult->results, true);
        $totalMark = 0;
        $status = '';
        $user_grade = $taskResult->user_grade;

        $taskResult->user_grade = $user_grade;
        $passMark = $task->pass_mark;

        if ($taskResult->user_grade >= $passMark) {
            $taskResult->status = TasksResult::$passed;
        } else {
            $taskResult->status = TasksResult::$failed;
        }

        $taskResult->results = json_encode($oldResults);
        $taskResult->save();
        $notifyOptions = [
            '[c.title]' => $task->webinar ? $task->webinar->title : '-',
            '[q.title]' => $task->title,
            '[q.result]' => $taskResult->status,
        ];
        sendNotification('waiting_task_result', $notifyOptions, $taskResult->user_id);
        if ($taskResult->status == TasksResult::$passed) {
            $passTheTaskReward = RewardAccounting::calculateScore(Reward::PASS_THE_TASK);
            RewardAccounting::makeRewardAccounting($taskResult->user_id, $passTheTaskReward, Reward::PASS_THE_TASK, $passTheTaskReward->id, true);
        }

        if ($task->certificate) {
            $certificateReward = RewardAccounting::calculateScore(Reward::CERTIFICATE);
            RewardAccounting::makeRewardAccounting($taskResult->user_id, $certificateReward, Reward::CERTIFICATE, $task->id, true);
        }
        return apiResponse2(1, 'stored', trans('api.public.stored'));


    }

}
