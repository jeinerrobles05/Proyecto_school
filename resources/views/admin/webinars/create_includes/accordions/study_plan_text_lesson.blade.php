<li data-id="{{ !empty($textLesson) ? $textLesson->id :'' }}" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="text_lesson_{{ !empty($textLesson) ? $textLesson->id :'record' }}">
        <div class="d-flex align-items-center" href="#collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-controls="collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file-text" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block cursor-pointer">{{ !empty($textLesson) ? $textLesson->title . ($textLesson->accessibility == 'free' ? " (". trans('public.free') .")" : '') : trans('public.add_item') }}</div>
        </div>

        <div class="d-flex align-items-center">

            @if(!empty($textLesson))
                <button type="button" data-item-id="{{ $textLesson->id }}" data-chapter-id="{{ !empty($chapter) ? $chapter->id : '' }}" class="js-change-study-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                    <i data-feather="grid" class="" height="20"></i>
                </button>
            @endif

            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            @if(!empty($textLesson))
                <a href="{{ getAdminPanelUrl() }}/study_plan_text_lesson/{{ $textLesson->id }}/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            @endif

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-controls="collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" data-parent="#chapterContentAccordion{{ !empty($chapter) ? $chapter->id :'' }}" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseTextLesson{{ !empty($textLesson) ? $textLesson->id :'record' }}" aria-labelledby="text_lesson_{{ !empty($textLesson) ? $textLesson->id :'record' }}" class=" collapse @if(empty($textLesson)) show @endif" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form text_lesson-form" data-action="{{ getAdminPanelUrl() }}/study_plan_text_lesson/{{ !empty($textLesson) ? $textLesson->id . '/update' : 'store' }}">
                <input type="hidden" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][webinar_id]" value="{{ !empty($webinar) ? $webinar->id :'' }}">

                <div class="row">
                    <div class="col-12 col-lg-6">
                        @if(!empty($textLesson))
                            <div class="form-group">
                                <label class="input-label">{{ trans('public.chapter') }}</label>
                                <select name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][chapter_id]" class="js-ajax-chapter_id form-control">
                                    @foreach($webinar->studyPlanChapters as $ch)
                                        <option value="{{ $ch->id }}" {{ ($textLesson->chapter_id == $ch->id) ? 'selected' : '' }}>{{ $ch->title }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        @else
                            <input type="hidden" name="ajax[new][chapter_id]" value="" class="chapter-input">
                        @endif

                        <div class="form-group">
                            <label class="input-label">{{ trans('public.title') }}</label>
                            <input type="text" name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][title]" class="js-ajax-title form-control" value="{{ !empty($textLesson) ? $textLesson->title : '' }}" placeholder=""/>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="input-label">{{ trans('public.content') }}</label>
                            <div class="content-summernote js-ajax-file_path">
                                <textarea class="js-content-summernote form-control {{ !empty($textLesson) ? 'js-content-'.$textLesson->id : '' }}">{{ !empty($textLesson) ? $textLesson->content : '' }}</textarea>
                                <textarea name="ajax[{{ !empty($textLesson) ? $textLesson->id : 'new' }}][content]" class="js-hidden-content-summernote {{ !empty($textLesson) ? 'js-hidden-content-'.$textLesson->id : '' }} d-none">{{ !empty($textLesson) ? $textLesson->content : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-text_lesson btn btn-sm btn-primary">{{ trans('public.save') }}</button>

                    @if(empty($textLesson))
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">{{ trans('public.close') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
