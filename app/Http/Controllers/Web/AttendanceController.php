<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Sale;
use App\Models\TextLesson;
use App\Models\Translation\AttendanceTranslation;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function search($id){
        $user = auth()->user();

        if (!$user->isTeacher() and !$user->isOrganization()) {
            abort(404);
        }

        $text_lesson= TextLesson::where('id',$id)->first();
        $sales = Sale::where('webinar_id', $text_lesson->webinar_id)
            ->join('users', 'users.id', '=', 'sales.buyer_id')
            ->select('users.full_name', 'sales.*')
            ->get();
        $webinar = Webinar::where('id',$text_lesson->webinar_id)->first();

        $attendances = Attendance::where('text_lesson_id', $id )->first();
        $attendanceTranslations = null;
        if(!empty($attendances)){
            $attendanceTranslations = AttendanceTranslation::where('attendance_translations.attendance_id', $attendances->id)
                ->join('users', 'users.id', '=', 'attendance_translations.student_id')
                ->select( 'attendance_translations.*','users.full_name','users.id')
                ->orderBy('users.full_name', 'asc')
                ->get();
        }

        $data = ['sales'=>$sales,
            'attendances' => $attendances,
            'attendanceTranslations'=>$attendanceTranslations,
            'text_lesson'=>$text_lesson,
            'webinar'=> $webinar
        ];
        return view(getTemplate() . '.attendance.index', $data);
    }

    public function update(Request $request,$id)
    {
        $user = auth()->user();

        if (!$user->isTeacher() and !$user->isOrganization()) {
            abort(404);
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if(!empty($data['date'])){
                $startDate = convertTimeToUTCzone($data['date'], $data['timezone']);
                $data['date'] = $startDate->getTimestamp();
            }else{
                $attendanceDate = Attendance::where('id', $id)->first();
                $data['date'] = $attendanceDate->date;
            }

            $attendance = Attendance::where('id', $id)
                ->update([
                    'teacher_id' => $user->isTeacher() ? $user->id : (!empty($data['teacher_id']) ? $data['teacher_id'] : $user->id),
                    'text_lesson_id'=> $data['text_lesson_id'],
                    'date' => $data['date'],
                    'updated_at' => time(),
                ]);

            foreach($data as $k => $v)
            {
                if(strpos($k, 'status')!==false){
                    $a= (int) substr($k, 7);
                    $attendanceTranslation = AttendanceTranslation::where('attendance_id', $id)
                        ->where('student_id',$a)
                        ->update([
                            'status'=>$v,
                        ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return back();
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->isTeacher() and !$user->isOrganization()) {
            abort(404);
        }

        DB::beginTransaction();
        try {
            $data = $request->all();
            $startDate = convertTimeToUTCzone($data['date'], $data['timezone']);
            $data['date'] = $startDate->getTimestamp();

            $attendance = Attendance::create([
                'teacher_id' => $user->isTeacher() ? $user->id : (!empty($data['teacher_id']) ? $data['teacher_id'] : $user->id),
                'text_lesson_id'=> $data['text_lesson_id'],
                'date' => $data['date'],
                'created_at' => time(),
                'updated_at' => time(),
            ]);

            foreach($data as $k => $v)
            {
                if(strpos($k, 'status')!==false){
                    $a= (int) substr($k, 7);
                    AttendanceTranslation::create([
                        'attendance_id' =>$attendance->id,
                        'student_id'=> $a,
                        'status'=>$v,
                        'created_at' => time()
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return back();
    }



}
