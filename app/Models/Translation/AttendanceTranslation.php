<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class AttendanceTranslation extends Model
{
    protected $table = 'attendance_translations';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    public function attendances(){
        return $this->belongsTo(Attendance::class);
    }
}
