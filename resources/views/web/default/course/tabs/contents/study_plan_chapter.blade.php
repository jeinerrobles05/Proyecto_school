<div class="row">
    <div class="col-12">
        <div class="accordion-content-wrapper" id="chaptersAccordion" role="tablist" aria-multiselectable="true">
            @foreach($course->studyPlanChapters as $chapter)
                @if((!empty($chapter->textLessons) /*and count($chapter->textLessons)*/))
                    <div class="accordion-row rounded-sm border mt-20 p-15">
                        <div class="d-flex align-items-center justify-content-between" role="tab" id="chapter_{{ $chapter->id }}">
                            <div class="js-chapter-collapse-toggle d-flex align-items-center" href="#collapseChapter{{ $chapter->id }}" aria-controls="collapseChapter{{ $chapter->id }}" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true">
                                <span class="chapter-icon mr-15">
                                    <i data-feather="grid" class=""></i>
                                </span>

                                <span class="font-weight-bold text-secondary font-14">{{ $chapter->title }}</span>

                            </div>

                            <div class="d-flex align-items-center">
                                <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseChapter{{ !empty($chapter) ? $chapter->id :'record' }}" aria-controls="collapseChapter{{ !empty($chapter) ? $chapter->id :'record' }}" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
                            </div>
                        </div>

                        <div id="collapseChapter{{ $chapter->id }}" aria-labelledby="chapter_{{ $chapter->id }}" class=" collapse" role="tabpanel">
                            <div class="panel-collapse">
                                <div class="text-gray">
                                    {!! $chapter->content !!}
                                </div>
                                @if(!empty($chapter->textLessons) and count($chapter->textLessons))
                                    @foreach($chapter->textLessons as $textLesson)
                                            @include('web.default.course.tabs.contents.study_plan_text_lesson' , ['textLesson' => $textLesson, 'accordionParent' => 'chaptersAccordion'])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
