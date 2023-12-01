<?php

namespace App\Models;

use App\Models\Traits\SequenceContent;
use Illuminate\Database\Eloquent\Model;

class StudyPlanTextLesson extends Model
{
    use SequenceContent;

    protected $table = 'study_plan_text_lessons';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    static $Active = 'active';
    static $Inactive = 'inactive';
    static $Status = ['active', 'inactive'];


    /*public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function getContentAttribute()
    {
        return getTranslateAttributeValue($this, 'content');
    }*/

    public function chapter()
    {
        return $this->belongsTo('App\Models\StudyPlanChapter', 'chapter_id', 'id');
    }

}
