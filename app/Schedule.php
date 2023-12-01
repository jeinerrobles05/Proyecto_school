<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'shedules';
    public function group()
    {
        return $this->belongsTo('App\course_group', 'course_group_id', 'id');
    }
   
}
