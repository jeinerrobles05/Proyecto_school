<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line">{{ trans('public.study_plan') }} ({{ trans('public.optional') }})</h2>
    </div>

    <button type="button" class="js-add-study_plan_chapter btn btn-primary btn-sm mt-15" data-webinar-id="{{ $webinar->id }}">{{ trans('public.new_chapter') }}</button>
   {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModal" >Abrir Modal</button>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>--}}

    @include('admin.webinars.create_includes.accordions.study_plan_chapters')
</section>

@if($webinar->isWebinar())
    <div id="newSessionForm" class="d-none">
        @include('admin.webinars.create_includes.accordions.session',['webinar' => $webinar])
    </div>
@endif

<div id="newFileForm" class="d-none">
    @include('admin.webinars.create_includes.accordions.file',['webinar' => $webinar])
</div>

@if(getFeaturesSettings('new_interactive_file'))
    <div id="newInteractiveFileForm" class="d-none">
        @include('admin.webinars.create_includes.accordions.new_interactive_file',['webinar' => $webinar])
    </div>
@endif
<div id="newStudyPlanTextLessonForm" class="d-none">
    @include('admin.webinars.create_includes.accordions.study_plan_text_lesson',['webinar' => $webinar])
</div>


<div id="newQuizForm" class="d-none">
    @include('admin.webinars.create_includes.accordions.quiz',[
             'webinar' => $webinar,
             'quizInfo' => null,
             'webinarChapterPages' => true,
             'creator' => $webinar->creator
        ])
</div>

@if(getFeaturesSettings('webinar_assignment_status'))
    <div id="newAssignmentForm" class="d-none">
        @include('admin.webinars.create_includes.accordions.assignment',['webinar' => $webinar])
    </div>
@endif

@include('admin.webinars.create_includes.study_plan_chapter_modal')
@include('admin.webinars.create_includes.change_study_plan_chapter_modal')


