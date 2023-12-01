<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class InterestedClassroomCourseTranslation extends Model
{
    protected $table = 'interested_course_translations';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    public function interestedClassroomCourse(){
        return $this->belongsTo(InterestedClassroomCourse::class);
    }
}
