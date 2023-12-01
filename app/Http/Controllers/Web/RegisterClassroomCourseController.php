<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\InterestedClassroomCourse;
use App\Models\Sale;
use App\Models\TextLesson;
use App\Models\Translation\AttendanceTranslation;
use App\Models\Translation\InterestedClassroomCourseTranslation;
use App\Models\Translation\WebinarTranslation;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterClassroomCourseController extends Controller
{
    public function search($id){
        $user = null;

        if (auth()->check()) {
            $user = auth()->user();
        }

        $course = WebinarTranslation::where('webinar_id',$id)->first();
        $courses=Webinar::where('type','classroom_course')
            ->join('webinar_translations', 'webinar_translations.webinar_id', '=', 'webinars.id')
            ->select( 'webinars.*','webinar_translations.title')
            ->orderBy('webinar_translations.title', 'asc')
            ->get();
        $data=['user' => $user,'course' => $course,'courses' => $courses];
        return view(getTemplate() . '.auth.register_interested_courses',$data);


    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string|min:3',
            'mobile' => 'required|numeric',
            'email' => 'required|email|max:255',
            'term' => 'required',
            'courses' => 'required',
        ],[
            'full_name.required' => 'El campo de nombre es obligatorio.',
            'full_name.string' => 'El nombre debe ser una cadena.',
            'full_name.min:3' => 'El nombre debe ser al menos 3 letras.',
            'mobile.required' => 'El campo de teléfono es obligatorio.',
            'mobile.numeric' => 'El teléfono debe ser un número.',
            'term.required' => 'El campo de términos y condiciones es obligatorio.',
            'courses.required' => 'El campo de cursos es obligatorio.',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();

            $interestedClassroomCourse = InterestedClassroomCourse::create([
                'user_id' => $data['user_id'],
                'full_name'=> $data['full_name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'country_id' => $data['country_id'],
                'terms' => 1,
                'pending' => 1,
                'created_at' => time(),

            ]);

            foreach($data['courses'] as $course)
            {
                    InterestedClassroomCourseTranslation::create([
                        'interested_courses_id' =>$interestedClassroomCourse->id,
                        'webinar_id'=> $course,
                        'created_at' => time()
                    ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        /*return back();*/
        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => trans('update.data_sent_successfully'),
            'status' => 'success'
        ];
        return redirect('/')->with(['toast' => $toastData]);

    }


}
