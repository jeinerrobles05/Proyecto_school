<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_group extends Model
{
    protected $table = 'course_groups';
    public function teacher()
    {
        return $this->belongsTo('App\User', 'instructor_id', 'id');
    }
    public function curso()
    {
        return $this->belongsTo('App\Models\Webinar', 'curso_id', 'id');
    }
    public function Schedules()
    {
        return $this->hasMany('App\Schedule', 'course_group_id', 'id');
    }
}
