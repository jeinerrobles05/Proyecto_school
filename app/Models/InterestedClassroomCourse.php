<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestedClassroomCourse extends Model
{
    protected $table = 'interested_courses';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    public function interestedCourseTranslation(){
        return $this->hasMany('App\Models\Translation\InterestedClassroomCourseTranslation', 'interested_courses_id', 'id');
    }
}
