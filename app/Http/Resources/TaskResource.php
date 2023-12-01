<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'auth_status' => $this->auth_status,
            'can_view_error' => $this->canViewError(),
            'pass_mark' => $this->pass_mark,
            'average_grade' => $this->average_grade,
            'student_count' => $this->taskResults->pluck('user_id')->count(),
            'success_rate' => $this->success_rate,
            'status' => $this->status,
            'attempt' => $this->attempt,
            'created_at' => $this->created_at,
            'teacher' => $this->creator->brief,

            /**********************/

            'auth_attempt_count' => $this->auth_attempt_count,
            'attempt_state' => $this->attempt_state,
            'auth_can_start' => $this->auth_can_take_task,
            'webinar' => $this->webinar->brief,
        ];

    }
}
