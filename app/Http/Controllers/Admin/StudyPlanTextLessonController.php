<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyPlanTextLesson;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudyPlanTextLessonController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('admin_webinars_edit');

        $data = $request->get('ajax')['new'];

        $validator = Validator::make($data, [
            'webinar_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $lessonsCount = StudyPlanTextLesson ::where('webinar_id', $data['webinar_id'])->count();

        $webinar = Webinar::where('id', $data['webinar_id'])->first();

        if (!empty($webinar)) {
            $textLesson = StudyPlanTextLesson::create([
                'creator_id' => $webinar->creator_id,
                'webinar_id' => $data['webinar_id'],
                'title' => $data['title'],
                'content' => $data['content']?? null,
                'chapter_id' => $data['chapter_id'] ?? null,
                'order' => $lessonsCount + 1,
                'created_at' => time(),
            ]);

            return response()->json([
                'code' => 200,
            ], 200);
        }

        return response()->json([], 422);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        $data = $request->get('ajax')[$id];

        $validator = Validator::make($data, [
            'webinar_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }


        $textLesson = StudyPlanTextLesson::where('id', $id)
            ->first();

        if (!empty($textLesson)) {
            StudyPlanTextLesson::where('id', $id)
                ->update([
                    'title' => $data['title'],
                    'content' => $data['content']?? null,
                    'chapter_id' => $data['chapter_id'] ?? null,
                    'created_at' => time(),
                    'updated_at' => time(),
                ]);

            removeContentLocale();

            return response()->json([
                'code' => 200,
            ], 200);
        }

        removeContentLocale();

        return response()->json([], 422);
    }

    public function destroy($id)
    {
        $this->authorize('admin_webinars_edit');

        $textLesson = StudyPlanTextLesson::where('id', $id)->first();

        if (!empty($textLesson)) {
            $textLesson->delete();
        }

        return response()->json([
            'code' => 200,
        ], 200);
    }
}
