<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    static $absent = 'absent';
    static $present = 'present';

    public function isAbsent()
    {
        return ($this->status == 'absent');
    }
    public function isPresent()
    {
        return ($this->status == 'present');
    }

    public function attendanceTranslations(){
        return $this->hasMany('App\Models\Translation\attendanceTranslation', 'attendance_id', 'id');
    }
}
