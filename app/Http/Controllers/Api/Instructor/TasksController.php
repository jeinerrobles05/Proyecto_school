<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Role;
use App\Models\WebinarChapter;
use App\User;
use App\Models\Webinar;
use App\Models\TasksResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string|max:255',
            'webinar_id' => 'nullable|exists:webinars,id',
            'chapter_id' => 'nullable|exists:webinar_chapters,id',
            'pass_mark' => 'required|digits_between:1,10',
            'attempt' => 'digits_between:1,10 ',
            'time' => 'digits_between:1,10',
            'active' => 'boolean',
            'certificate' => 'boolean'
        ];
        $data = $request->all();
        validateParam($request->all(), $rules);

        $user = auth()->user();
        $webinar = null;
        $chapter = null;
        if (!empty($data['webinar_id'])) {
            $webinar = Webinar::where('id', $data['webinar_id'])
                ->where(function ($query) use ($user) {
                    $query->where('teacher_id', $user->id)
                        ->orWhere('creator_id', $user->id);
                })->first();

            if (!empty($webinar) and !empty($data['chapter_id'])) {
                $chapter = WebinarChapter::where('id', $data['chapter_id'])
                    ->where('webinar_id', $webinar->id)
                    ->first();
            }
        }

        $task = Task::create([
            'title' => $data['title'],
            'webinar_id' => !empty($webinar) ? $webinar->id : null,
            'chapter_id' => !empty($chapter) ? $chapter->id : null,
            'creator_id' => $user->id,
            'webinar_title' => !empty($webinar) ? $webinar->title : null,
            'attempt' => $data['attempt'] ?? null,
            'pass_mark' => $data['pass_mark'],
            'time' => $data['time'] ?? null,
            'status' => (!empty($data['active']) and $data['active'] == 1) ? Task::ACTIVE : Task::INACTIVE,
            'certificate' => (!empty($data['certificate']) and $data['certificate'] == 1) ? true : false,
            'created_at' => time(),
        ]);

        return apiResponse2(1, 'created', trans('public.stored'));

    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            abort(404);
        }
        $rules = [
            'title' => 'required|string|max:255',
            'webinar_id' => 'nullable|exists:webinars,id',
            'chapter_id' => 'nullable|exists:webinar_chapters,id',
            'pass_mark' => 'required|digits_between:1,10',
            'attempt' => 'digits_between:1,10 ',
            'time' => 'digits_between:1,10',
            'active' => 'boolean',
            'certificate' => 'boolean'
        ];
        validateParam($request->all(), $rules);
        $data = $request->all();
        $user = auth()->user();

        $webinar = null;
        if (!empty($data['webinar_id'])) {
            $webinar = Webinar::where('id', $data['webinar_id'])
                ->where(function ($query) use ($user) {
                    $query->where('teacher_id', $user->id)
                        ->orWhere('creator_id', $user->id);
                })->first();

            if (!empty($webinar) and !empty($data['chapter_id'])) {
                $chapter = WebinarChapter::where('id', $data['chapter_id'])
                    ->where('webinar_id', $webinar->id)
                    ->first();
            }
        }


        $task->update([
            'title' => $data['title'],
            'webinar_id' => !empty($webinar) ? $webinar->id : null,
            'chapter_id' => !empty($chapter) ? $chapter->id : null,
            'webinar_title' => !empty($webinar) ? $webinar->title : null,
            'attempt' => $data['attempt'] ?? null,
            'pass_mark' => $data['pass_mark'],
            'time' => $data['time'] ?? null,
            'status' => (!empty($data['active']) and $data['active'] == 1) ? Task::ACTIVE : Task::INACTIVE,
            'certificate' => (!empty($data['certificate']) and $data['certificate'] == 1) ? true : false,
            'updated_at' => time(),
        ]);


        return apiResponse2(1, 'updated', trans('public.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $user_id = auth()->id();
        $task = Task::where('id', $id)
            ->where('creator_id', $user_id)
            ->first();

        if (!$task) {
            abort(404);
        }
        $task->delete();
        return apiResponse2(1, 'deleted', trans('public.deleted'));
    }

    public function filters(Request $request, $query)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $task_id = $request->get('task_id');
        $total_mark = $request->get('total_mark');
        $status = $request->get('status');
        $active_tasks = $request->get('active_tasks');


        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($task_id) and $task_id != 'all') {
            $query->where('id', $task_id);
        }

        if ($status and $status !== 'all') {
            $query->where('status', strtolower($status));
        }

        if (!empty($active_tasks)) {
            $query->where('status', 'active');
        }

        if ($total_mark) {
            $query->where('total_mark', '>=', $total_mark);
        }

        return $query;
    }

    public function create()
    {
        $user = auth()->user();
        $webinars = Webinar::where(function ($query) use ($user) {
            $query->where('teacher_id', $user->id)
                ->orWhere('creator_id', $user->id);
        })->get();

        $data = [
            'pageTitle' => trans('task.new_task_page_title'),
            'webinars' => $webinars,
        ];

        return view(getTemplate() . '.panel.tasks.create', $data);
    }

    public function edit($id)
    {
        $user = auth()->user();
        $webinars = Webinar::where(function ($query) use ($user) {
            $query->where('teacher_id', $user->id)
                ->orWhere('creator_id', $user->id);
        })->get();

        $task = Task::where('id', $id)
            ->where('creator_id', $user->id)
            ->first();

        if (!empty($task)) {
            $chapters = collect();

            if (!empty($task->webinar)) {
                $chapters = $task->webinar->chapters;
            }

            $data = [
                'pageTitle' => trans('public.edit') . ' ' . $task->title,
                'webinars' => $webinars,
                'task' => $task,
                'chapters' => $chapters,
            ];

            return view(getTemplate() . '.panel.tasks.create', $data);
        }

        abort(404);
    }

    public function start(Request $request, $id)
    {
        $task = Task::where('id', $id)
            ->first();

        $user = auth()->user();

        if ($task) {
            $userTaskDone = TasksResult::where('task_id', $task->id)
                ->where('user_id', $user->id)
                ->get();

            $status_pass = false;
            foreach ($userTaskDone as $result) {
                if ($result->status == TasksResult::$passed) {
                    $status_pass = true;
                }
            }

            if (!isset($task->attempt) or ($userTaskDone->count() < $task->attempt and !$status_pass)) {
                $newTaskStart = TasksResult::create([
                    'task_id' => $task->id,
                    'user_id' => $user->id,
                    'results' => '',
                    'user_grade' => 0,
                    'status' => 'waiting',
                    'created_at' => time()
                ]);

                $data = [
                    'pageTitle' => trans('task.task_start'),
                    'task' => $task,
                    'attempt_count' => $userTaskDone->count() + 1,
                    'newTaskStart' => $newTaskStart
                ];

                return view(getTemplate() . '.panel.tasks.start', $data);
            } else {
                return back()->with('msg', trans('task.cant_start_task'));
            }
        }
        abort(404);
    }

    public function tasksStoreResult(Request $request, $id)
    {
        $user = auth()->user();
        $task = Task::where('id', $id)->first();

        if ($task) {
            $results = $request->get('');
            $taskResultId = $request->get('task_result_id');

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

                    $results["attempt_number"] = $request->get('attempt_number');

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
                            '[t.title]' => $task->title,
                        ];
                        sendNotification('waiting_task', $notifyOptions, $task->creator_id);
                    }

                    return redirect()->route('task_status', ['taskResultId' => $taskResult]);
                }
            }
        }
        abort(404);
    }

    public function status($taskResultId)
    {
        $user = auth()->user();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->where('user_id', $user->id)
            ->first();

        if ($taskResult) {
            $task = $taskResult->task;
            $attemptCount = $task->attempt;

            $userTaskDone = TasksResult::where('task_id', $task->id)
                ->where('user_id', $user->id)
                ->count();

            $canTryAgain = false;
            if ($userTaskDone < $attemptCount) {
                $canTryAgain = true;
            }

            $data = [
                'pageTitle' => trans('task.task_status'),
                'taskResult' => $taskResult,
                'task' => $task,
                'attempt_count' => $userTaskDone,
                'canTryAgain' => $canTryAgain,
            ];

            return view(getTemplate() . '.panel.tasks.status', $data);
        }
        abort(404);
    }

    public function myResults(Request $request)
    {
        $query = TasksResult::where('user_id', auth()->user()->id);

        $taskResultsCount = deepClone($query)->count();
        $passedCount = deepClone($query)->where('status', \App\Models\TasksResult::$passed)->count();
        $failedCount = deepClone($query)->where('status', \App\Models\TasksResult::$failed)->count();
        $waitingCount = deepClone($query)->where('status', \App\Models\TasksResult::$waiting)->count();

        $query = $this->resultFilters($request, deepClone($query));

        $taskResults = $query->with([
            'task' => function ($query) {
                $query->with(['creator', 'webinar']);
            }
        ])->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($taskResults->groupBy('task_id') as $task_id => $taskResult) {
            $canTryAgainTask = false;

            $result = $taskResult->first();
            $task = $result->task;

            if (!isset($task->attempt) or (count($taskResult) < $task->attempt and $result->status !== 'passed')) {
                $canTryAgainTask = true;
            }

            foreach ($taskResult as $item) {
                $item->can_try = $canTryAgainTask;
                if ($canTryAgainTask and isset($task->attempt)) {
                    $item->count_can_try = $task->attempt - count($taskResult);
                }
            }
        }

        $data = [
            'pageTitle' => trans('task.my_results'),
            'tasksResults' => $taskResults,
            'tasksResultsCount' => $taskResultsCount,
            'passedCount' => $passedCount,
            'failedCount' => $failedCount,
            'waitingCount' => $waitingCount
        ];

        return view(getTemplate() . '.panel.tasks.my_results', $data);
    }

    public function opens(Request $request)
    {
        $user = auth()->user();

        $webinarIds = $user->getPurchasedCoursesIds();

        $query = Task::whereIn('webinar_id', $webinarIds)
            ->where('status', 'active')
            ->whereDoesntHave('taskResults', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

        $query = $this->resultFilters($request, deepClone($query));

        $tasks = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => trans('task.open_tasks'),
            'tasks' => $tasks
        ];

        return view(getTemplate() . '.panel.tasks.opens', $data);
    }

    public function results(Request $request)
    {
        $user = auth()->user();

        if (!$user->isUser()) {
            $tasks = Task::where('creator_id', $user->id)
                ->where('status', 'active')
                ->get();

            $tasksIds = $tasks->pluck('id')->toArray();

            $query = TasksResult::whereIn('task_id', $tasksIds);

            $studentsIds = $query->pluck('user_id')->toArray();
            $allStudents = User::select('id', 'full_name')->whereIn('id', $studentsIds)->get();

            $taskResultsCount = $query->count();
            $taskAvgGrad = round($query->avg('user_grade'), 2);
            $waitingCount = deepClone($query)->where('status', \App\Models\TasksResult::$waiting)->count();
            $passedCount = deepClone($query)->where('status', \App\Models\TasksResult::$passed)->count();
            $successRate = ($taskResultsCount > 0) ? round($passedCount / $taskResultsCount * 100) : 0;

            $query = $this->resultFilters($request, deepClone($query));

            $tasksResults = $query->with([
                'task' => function ($query) {
                    $query->with(['creator', 'webinar']);
                }, 'user'
            ])->orderBy('created_at', 'desc')
                ->get();

            $data = [
                //   'pageTitle' => trans('task.results'),
                'tasks_results' => $tasksResults,
                'task_results_count' => $taskResultsCount,
                'success-rate' => $successRate,
                'task_avg_grad' => $taskAvgGrad,
                'waiting_count' => $waitingCount,
                'tasks' => $tasks,
                'all_students' => $allStudents
            ];
            return apiResponse2(1, 'retrieved', trans('public.retrieved'),$data);

            return view(getTemplate() . '.panel.tasks.results', $data);
        }

        abort(404);
    }

    public function resultFilters(Request $request, $query)
    {
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $task_id = $request->get('task_id', null);
        $total_mark = $request->get('total_mark', null);
        $status = $request->get('status', null);
        $user_id = $request->get('user_id', null);
        $instructor = $request->get('instructor', null);
        $open_results = $request->get('open_results', null);

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($task_id) and $task_id != 'all') {
            $query->where('task_id', $task_id);
        }

        if ($total_mark) {
            $query->where('total_mark', $total_mark);
        }

        if (!empty($user_id) and $user_id != 'all') {
            $query->where('user_id', $user_id);
        }

        if ($instructor) {
            $userIds = User::whereIn('role_name', [Role::$teacher, Role::$organization])
                ->where('full_name', 'like', '%' . $instructor . '%')
                ->pluck('id')->toArray();

            $query->whereIn('creator_id', $userIds);
        }

        if ($status and $status != 'all') {
            $query->where('status', strtolower($status));
        }

        if (!empty($open_results)) {
            $query->where('status', 'waiting');
        }

        return $query;
    }

    public function showResult($taskResultId)
    {
        $user = auth()->user();

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->where(function ($query) use ($user, $tasksIds) {
                $query->where('user_id', $user->id)
                    ->orWhereIn('task_id', $tasksIds);
            })->with([
                'task' => function ($query) {
                    $query->with(['webinar']);
                }
            ])->first();

        if (!empty($taskResult)) {
            $numberOfAttempt = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->count();

            $data = [
                'pageTitle' => trans('task.result'),
                'taskResult' => $taskResult,
                'userAnswers' => json_decode($taskResult->results, true),
                'numberOfAttempt' => $numberOfAttempt,
            ];

            return view(getTemplate() . '.panel.tasks.task_result', $data);
        }

        abort(404);
    }

    public function destroyTaskResult($taskResultId)
    {
        $user = auth()->user();

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->whereIn('task_id', $tasksIds)
            ->first();

        if (!empty($taskResult)) {
            $taskResult->delete();

            return response()->json([
                'code' => 200
            ], 200);
        }

        return response()->json([], 422);
    }

    public function editResult($taskResultId)
    {
        $user = auth()->user();

        $tasksIds = Task::where('creator_id', $user->id)->pluck('id')->toArray();

        $taskResult = TasksResult::where('id', $taskResultId)
            ->whereIn('task_id', $tasksIds)
            ->with([
                'task' => function ($query) {
                    $query->with([
                        'webinar'
                    ]);
                }
            ])->first();

        if (!empty($taskResult)) {
            $numberOfAttempt = TasksResult::where('task_id', $taskResult->task->id)
                ->where('user_id', $taskResult->user_id)
                ->count();

            $data = [
                'pageTitle' => trans('task.result'),
                'teacherReviews' => true,
                'taskResult' => $taskResult,
                'newTaskStart' => $taskResult,
                'userAnswers' => json_decode($taskResult->results, true),
                'numberOfAttempt' => $numberOfAttempt,
            ];

            return view(getTemplate() . '.panel.tasks.task_result', $data);
        }

        abort(404);
    }

    public function updateResult(Request $request, $id)
    {
        $user = auth()->user();
        $task = Task::where('id', $id)
            ->where('creator_id', $user->id)
            ->first();

        if (!empty($task)) {
            $taskResultId = $request->get('task_result_id');

            if (!empty($taskResultId)) {

                $taskResult = TasksResult::where('id', $taskResultId)
                    ->where('task_id', $task->id)
                    ->first();

                if (!empty($taskResult)) {

                    $oldResults = json_decode($taskResult->results, true);
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
                        '[t.title]' => $task->title,
                        '[t.result]' => $taskResult->status,
                    ];
                    sendNotification('waiting_task_result', $notifyOptions, $taskResult->user_id);

                    return redirect('panel/tasks/results');
                }
            }
        }

        abort(404);
    }
}
