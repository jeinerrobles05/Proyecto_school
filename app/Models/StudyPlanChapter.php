<?php

namespace App\Models;

use App\Models\Traits\SequenceContent;
use Illuminate\Database\Eloquent\Model;

class StudyPlanChapter extends Model
{
    use SequenceContent;
    protected $table = 'study_plan_chapters';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    static $chapterTextLesson = 'text_lesson';

    static $chapterTypes = ['text_lesson'];

   /* public $translatedAttributes = ['title'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }*/

    public function textLessons()
    {
        return $this->hasMany('App\Models\StudyPlanTextLesson', 'chapter_id', 'id');
    }

    public function webinar()
    {
        return $this->hasOne('App\Models\Webinar', 'webinar_id', 'id');
    }

    public function getTopicsCount()
    {
        $count = 0;
        $count += $this->textLessons->where('status', 'active')->count();
        return $count;
    }
}
