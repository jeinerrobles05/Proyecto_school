<?php

namespace App\Models\Api;

use App\Models\Api\TasksResult;
use App\Models\Api\Traits\CheckWebinarItemAccessTrait;
use App\Models\Task as Model;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Failed;

class Task extends Model
{
    use CheckWebinarItemAccessTrait ;

    public function getBriefAttribute()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'auth_status' => $this->auth_status,
            'pass_mark' => $this->pass_mark,
            'description' => $this->description,
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

    public function getDetailsAttribute()
    {
        $details = [
            'participated_count' => $this->taskResults->count(),
            'latest_students' => $this->latest_students,

        ];

        return array_merge($this->brief, $details);
    }


    public function getAuthCanTakeTaskStatusAttribute()
    {
        $user = apiAuth();
        if (!$user) {
            return null;
        }
        $status = 'ok';
        $hasBought = $this->webinar->checkUserHasBought($user);
        if (!$hasBought) {
            $status = 'not_purchased';
        } elseif ($this->auth_passed_task) {
            $status = 'passed';
        }
        elseif (isset($this->attempt) and
            $this->auth_attempt_count >= $this->attempt

        ) {
            $status = 'max_attempt';
        }


        return $status;

    }

    public function getAuthCanTakeTaskAttribute()
    {
        $user = apiAuth();
        if (!$user) {
            return null;
        }

        if ($this->auth_can_take_task_status == 'ok') {
            return true;
        }
        return false;
    }

    public function getAuthPassedTaskAttribute()
    {
        $user = apiAuth();
        if (!$user) {
            return null;
        }
        $userTaskDone = $this->auth_results;

        $status_pass = false;
        foreach ($userTaskDone as $result) {
            if ($result->status == TasksResult::$passed) {
                $status_pass = true;
            }
        }
        return $status_pass;
    }

    public function getAuthAttemptCountAttribute()
    {
        if ($this->auth_results) {
            return $this->auth_results->count();
        }
        return null;

    }

    public function getCountTryAgainAttribute()
    {
        if (!$this->auth_can_take_task) {
            return 0;
        }

        if (!$this->attempt) {
            return 'unlimited';
        }

        $diff = $this->attempt - $this->auth_results->count();
        return ($diff >= 0) ? $diff : 0;
    }

    public function getAuthResultsAttribute()
    {
        $user = apiAuth();
        if (!$user) {
            return null;
        }
        $userTaskDone = TasksResult::where('task_id', $this->id)
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return $userTaskDone;
    }

    public function getAttemptStateAttribute()
    {
        $a = (!empty(apiAuth()) and !empty($this->auth_results))
            ? $this->auth_results->count() : '0';

        return $a . '/' . $this->attempt;
    }

    public function getSuccessRateAttribute()
    {

        if ($this->taskResults->count()) {
            return round($this->taskResults->where('status', TasksResult::$passed)->pluck('user_id')->count() / $this->taskResults->count() * 100);
        }
        return 0;

    }

    public function getLatestStudentsAttribute()
    {
        return $this->taskResults()->orderBy('created_at', 'desc')->groupBy('user_id')->get()->map(function ($result) {
            return $result->user->brief
                ;
        });
    }

    public function getAverageGradeAttribute()
    {
        return  round($this->taskResults->where('status', TasksResult::$passed)->avg('user_grade'),2);

    }

    public function getAuthStatusAttribute()
    {
        $user = apiAuth();
        if (!$user) {
            return null;
        }
        $user_task_result = $user->taskResults()->
        where('task_id', $this->id)
            ->orderBy('id', 'desc')
            ->get();

        if (!$user_task_result->count()) {
            return 'not_participated';
        }
        if ($user_task_result->where('status', 'passed')->count() > 0) {
            return 'passed';
        }
        if ($user_task_result->first()->status == 'waiting') {
            return 'waiting';
        }

        if ($user_task_result->first()->status == 'failed') {
            return 'failed';
        }

        return null;

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
        $webinar_id = $request->get('webinar_id', null);
        $instructor = $request->get('instructor', null);
        $open_results = $request->get('open_results', null);

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($webinar_id)) {
            $query->where('webinar_id', $webinar_id);
        }

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


    public function webinar()
    {
        return $this->belongsTo('App\Models\Api\Webinar', 'webinar_id', 'id');
    }

    public function taskResults()
    {
        return $this->hasMany('App\Models\Api\TasksResult', 'task_id', 'id');
    }


    public function creator()
    {
        return $this->belongsTo('App\Models\Api\User', 'creator_id', 'id');
    }


}
