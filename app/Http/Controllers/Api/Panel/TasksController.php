<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Api\Task;
use App\Models\Api\TasksResult;
use App\Models\WebinarChapter;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function show($id){
        $task = Task::where('id', $id)
            ->where('status', WebinarChapter::$chapterActive)->first();
        abort_unless($task, 404);

        if ($error = $task->canViewError()) {
            //       return $this->failure($error, 403, 403);
        }
        $resource = new TaskResource($task);
        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), $resource);
    }

    public function created(Request $request)
    {
        $user = apiAuth();
        $tasks = $user->userCreatedTasks()->
        orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')->get()->map(function ($task) {
                return $task->details;
            });

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'tasks' => $tasks
        ]);
    }

    public function notParticipated(Request $request)
    {
        $user = apiAuth();
        $webinarIds = $user->getPurchasedCoursesIds();

        $tasks = Task::whereIn('webinar_id', $webinarIds)
            ->where('status', 'active')
            ->whereDoesntHave('taskResults', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->handleFilters()
            ->orderBy('created_at', 'desc')
            ->get()->map(function ($task) {
                return $task->details;
            });

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'tasks' => $tasks
        ]);

    }

    public function resultsByTask($taskId)
    {

        $user = apiAuth();
        $query = TasksResult::where('user_id', $user->id)
            ->where('task_id', $taskId);

        abort_unless(deepClone($query)->count(), 404);

        $result = (deepClone($query)->where('status', TasksResult::$passed)->first()) ?: null;
        if (!$result) {
            $result = deepClone($query)->latest()->first();
        }


        return apiResponse2(1, 'retrieved', trans('api.public.retrieved')
            , $result->details
        );


    }

}
