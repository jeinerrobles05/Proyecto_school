<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class TaskTranslation extends Model
{
    protected $table = 'task_translations';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}
