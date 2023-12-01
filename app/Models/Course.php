<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

}
