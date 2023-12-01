<div id="studyPlanChapterModalHtml" class="d-none">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">{{ trans('public.new_chapter') }}</h2>
        <div class="js-content-form study-chapter-form mt-20" data-action="{{ getAdminPanelUrl() }}/study_plan_chapters/store">

            <input type="hidden" name="ajax[chapter][webinar_id]" class="js-study-chapter-webinar-id" value="">

            @if(!empty(getGeneralSettings('content_translate')))

                <div class="form-group">
                    <label class="input-label">{{ trans('auth.language') }}</label>
                    <select name="ajax[chapter][locale]"
                            class="form-control js-chapter-locale"
                            data-webinar-id="{{ !empty($webinar) ? $webinar->id : '' }}"
                            data-id=""
                            data-relation="chapters"
                            data-fields="title"
                    >
                        @foreach($userLanguages as $lang => $language)
                            <option value="{{ $lang }}">{{ $language }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="ajax[chapter][locale]" value="{{ $defaultLocale }}">
            @endif

            <div class="form-group">
                <label class="input-label">{{ trans('public.chapter_title') }}</label>
                <input type="text" name="ajax[chapter][title]" class="form-control js-ajax-title" value=""/>
                <span class="invalid-feedback"></span>
            </div>


                <div class="form-group">
                    <label class="input-label">{{ trans('public.content') }}</label>
                    <div >
                        <textarea name="ajax[chapter][content]" class="form-control js-ajax-content" rows="7"></textarea>
                    </div>
                </div>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-study-plan-chapter btn btn-sm btn-primary">{{ trans('public.save') }}</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2">{{ trans('public.close') }}</button>
            </div>

        </div>
    </div>
</div>


