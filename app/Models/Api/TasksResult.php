<?php

namespace App\Models\Api;

use App\Models\TasksResult as WebTasksResult;
use App\User;
use App\Models\Role;

class TasksResult extends WebTasksResult
{
    public function getBriefAttribute()
    {
        return [
            'id' => $this->id,
            'task' => $this->task->details,
            'webinar' => $this->task->webinar->brief,
            'user' => $this->user->brief,
            'user_grade' => $this->user_grade,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'auth_can_try_again' => $this->task->auth_can_take_task,
            'count_try_again' => $this->task->CountTryAgain,

        ];
    }

    public function getDetailsAttribute()
    {
        $details = [
            'reviewable' => $this->reviewable,

            'answer_sheet' => json_decode($this->results, true),
            'task_review' => $this->task_review,
        ];

        return array_merge($this->brief, $details);
    }


    public function getFinishedAttribute()
    {
        if (
            !$this->results && $this->status == TasksResult::$waiting
        ) {

            return false;
        }

        return true;
    }


    public function getReviewableAttribute()
    {

        return ($this->status == self::$waiting && $this->results) ? true : false;
    }

    public function scopeHandleFilters($query)
    {

        $request = request();
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $task_id = $request->get('task_id', null);
        $status = $request->get('status', null);
        $user_id = $request->get('user_id', null);
        $creator_id = $request->get('creator_id', null);

        $instructor = $request->get('instructor', null);
        $open_results = $request->get('open_results', null);

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($task_id) and $task_id != 'all') {
            $query->where('task_id', $task_id);
        }

        if (!empty($user_id) and $user_id != 'all') {
            $query->where('user_id', $user_id);
        }
        if (!empty($creator_id) and $creator_id != 'all') {
            $query->where('creator_id', $creator_id);
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

    public function task()
    {
        return $this->belongsTo('App\Models\Api\Task', 'task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Api\User', 'user_id', 'id');
    }

}

