<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TasksResult extends Model
{
    static $passed = 'passed';
    static $failed = 'failed';
    static $waiting = 'waiting';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
