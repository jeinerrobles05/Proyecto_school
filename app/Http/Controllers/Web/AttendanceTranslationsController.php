<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Sale;
use App\Models\TextLesson;
use App\Models\Translation\AttendanceTranslation;
use App\Models\Webinar;
use Illuminate\Http\Request;

class AttendanceTranslationsController extends Controller
{
    public function search($id)
    {
        $user = auth()->user();

        if (!$user->isUser()) {
            abort(404);
        }
        $attendances = Attendance::where('text_lesson_id', $id )->first();
        $attendanceTranslation = AttendanceTranslation::where('attendance_id', $attendances->id)
            ->where('student_id',$user->id)
            ->update([
                'confirmed_assistance'=>1,
            ]);
        return back();
    }
}
