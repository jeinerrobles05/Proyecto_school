@if(!empty($course->studyPlanChapters) and count($course->studyPlanChapters))
    <section class="">
        @include('web.default.course.tabs.contents.study_plan_chapter')
    </section>
@endif
