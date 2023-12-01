<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\WebinarTasks;
use App\Models\Task;
use Illuminate\Http\Request;
use Validator;

class WebinarTaskController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->get('ajax')['new'];

        $validator = Validator::make($data, [
            'webinar_id' => 'required',
            'task_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $webinar = Webinar::find($data['webinar_id']);

        if (!empty($webinar) and $webinar->canAccess($user)) {

            $task = Task::where('id', $data['task_id'])
                ->where('creator_id', $user->id)
                ->where('webinar_id', null)
                ->first();

            if (!empty($task)) {
                $task->webinar_id = $data['webinar_id'];
                $task->save();

                return response()->json([
                    'code' => 200,
                ], 200);
            }
        }

        abort(403);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $data = $request->get('ajax')[$id];

        $validator = Validator::make($data, [
            'webinar_id' => 'required',
            'task_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $webinar = Webinar::find($data['webinar_id']);

        if (!empty($webinar) and $webinar->canAccess($user)) {

            $task = Task::where('id', $data['task_id'])
                ->where('creator_id', $user->id)
                ->where('webinar_id', null)
                ->first();

            if (!empty($task)) {
                $task->webinar_id = $data['webinar_id'];
                $task->save();

                return response()->json([
                    'code' => 200,
                ], 200);
            }
        }

        abort(403);
    }
}
