<div id="changeStudyPlanChapterModalHtml" class="d-none">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">{{ trans('update.change_chapter') }}</h2>

        <div class="js-content-form study-change-chapter-form mt-20" data-action="{{ getAdminPanelUrl() }}/study_plan_chapters/change">

            <input type="hidden" name="ajax[webinar_id]" class="" value="{{ $webinar->id }}">
            <input type="hidden" name="ajax[item_id]" class="js-item-id" value="">

            <div class="form-group">
                <label class="input-label">{{ trans('public.chapter') }}</label>

                <select name="ajax[chapter_id]" class="js-ajax-study_chapter_id custom-select">
                    <option value="">{{ trans('update.select_chapter') }}</option>

                    @if(!empty($webinar->studyPlanChapters) and count($webinar->studyPlanChapters))
                        @foreach($webinar->studyPlanChapters as $chapter)
                            <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-change-study-plan-chapter btn btn-sm btn-primary">{{ trans('public.save') }}</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2">{{ trans('public.close') }}</button>
            </div>

        </div>
    </div>
</div>
