@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

<div class="">
    <div data-action="{{ !empty($task) ? ('/panel/tasks/'. $task->id .'/update') : ('/panel/tasks/store') }}" class="js-content-form task-form webinar-form">

        <section>
            <h2 class="section-title after-line">{{ !empty($task) ? (trans('public.edit').' ('. $task->title .')') : trans('task.new_task') }}</h2>

            <div class="row">
                <div class="col-12 col-md-4">

                    @if(!empty(getGeneralSettings('content_translate')))
                        <div class="form-group mt-25">
                            <label class="input-label">{{ trans('auth.language') }}</label>
                            <select name="ajax[{{ !empty($task) ? $task->id : 'new' }}][locale]"
                                    class="form-control {{ !empty($task) ? 'js-webinar-content-locale' : '' }}"
                                    data-webinar-id="{{ !empty($task) ? $task->webinar_id : '' }}"
                                    data-id="{{ !empty($task) ? $task->id : '' }}"
                                    data-relation="tasks"
                                    data-fields="title"
                            >
                                @foreach($userLanguages as $lang => $language)
                                    <option value="{{ $lang }}" {{ (!empty($task) and !empty($task->locale)) ? (mb_strtolower($task->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '') }}>{{ $language }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][locale]" value="{{ $defaultLocale }}">
                    @endif

                        @if(empty($selectedWebinar))
                            @if(!empty($webinars) and count($webinars))
                                <div class="form-group mt-3">
                                    <label class="input-label">{{ trans('panel.webinar') }}</label>
                                    <select name="ajax[{{ !empty($task) ? $task->id : 'new' }}][webinar_id]" class="js-ajax-webinar_id custom-select">
                                        <option {{ !empty($task) ? 'disabled' : 'selected disabled' }} value="">{{ trans('panel.choose_webinar') }}</option>
                                        @foreach($webinars as $webinar)
                                            <option value="{{ $webinar->id }}" {{  (!empty($task) and $task->webinar_id == $webinar->id) ? 'selected' : '' }}>{{ $webinar->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="input-label d-block">{{ trans('admin/main.webinar') }}</label>
                                    <select name="ajax[{{ !empty($task) ? $task->id : 'new' }}][webinar_id]" class="js-ajax-webinar_id form-control search-webinar-select2" data-placeholder="{{ trans('admin/main.search_webinar') }}">

                                    </select>

                                    <div class="invalid-feedback"></div>
                                </div>
                            @endif
                        @else
                            <input type="hidden" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][webinar_id]" value="{{ $selectedWebinar->id }}">
                        @endif

                        @if(!empty($task))
                        <div class="form-group mt-3">
                            <label class="input-label">{{ trans('task.task_group') }}</label>
                            <select name="ajax[{{ !empty($task) ? $task->id : 'new' }}][group_id]" class="js-ajax-group_id custom-select">
                                <option {{ empty($task) ? 'selected disabled' : '' }}> {{ trans('task.tasks_section') }}</option>
                                {{-- Loop sobre los grupos para generar las opciones --}}
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ !empty($task) && $task->group_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }} {{-- Ajusta esto según la estructura de tu modelo de grupo --}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        @else
                            <div class="form-group mt-3">
                                <label class="input-label">{{ trans('task.task_group') }}</label>
                                <select name="ajax[{{ !empty($task) ? $task->id : 'new' }}][group_id]" class="js-ajax-group_id custom-select">
                                    <option {{ !empty($task) ? 'disabled' : 'selected disabled' }} > {{ trans('task.tasks_section') }}</option>

                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        @endif


                    <div class="form-group @if(!empty($selectedWebinar)) mt-25 @endif">
                        <label class="input-label">{{ trans('task.task_title') }}</label>
                        <input type="text" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][title]" value="{{ !empty($task) ? $task->title : old('title') }}"  class="js-ajax-title form-control" placeholder=""/>
                        <div class="invalid-feedback"></div>
                    </div>


                    <div class="form-group">
                        <label class="input-label">{{ trans('update.expiry_days_t') }}</label>
                        <input type="datetime-local" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][expiry_days]" value="{{ !empty($task) ? date('Y-m-d\TH:i', $task->expiry_days) : old('expiry_days') }}" class="js-ajax-expiry_days form-control" min="{{ date('Y-m-d\TH:i') }}"/>
                        <div class="invalid-feedback"></div>

                        <p class="font-12 text-gray mt-5">{{ trans('update.task_expiry_days_hint') }}</p>
                    </div>


                </div>
            </div>
        </section>
        <section>
            <div class="form-group">
                <label class="input-label control-label">{{ trans('task.task_description') }}</label>
                <textarea name="ajax[{{ !empty($task) ? $task->id : 'new' }}][description]" class="summernote form-control text-left  @error('message') is-invalid @enderror">{{ (!empty($task)) ? $task->description :'' }}</textarea>
                <div class="invalid-feedback">@error('message') {{ $message }} @enderror</div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 d-flex align-items-center">
                    <div class="form-group">
                        <label class="input-label">{{ trans('panel.attach_file') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager" data-input="attach" data-preview="holder">
                                    <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][attach]" id="attach" value="{{ !empty($task) ? $task->attach : old('attach') }}" class="form-control" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="statusSwitch{{ !empty($task) ? $task->id : 'record' }}">{{ trans('task.active_task') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][status]" class="js-ajax-status custom-control-input" id="statusSwitch{{ !empty($task) ? $task->id : 'record' }}" {{ (!empty($task) && $task->status == 'active') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="statusSwitch{{ !empty($task) ? $task->id : 'record' }}"></label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <input type="hidden" name="ajax[{{ !empty($task) ? $task->id : 'new' }}][is_webinar_page]" value="@if(!empty($inWebinarPage) and $inWebinarPage) 1 @else 0 @endif">

        <div class="mt-20 mb-20">
            <button type="button" class="js-submit-task-form btn btn-sm btn-primary">{{ !empty($task) ? trans('public.save_change') : trans('public.create') }}</button>

            @if(empty($task) and !empty($inWebinarPage))
                <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">{{ trans('public.close') }}</button>
            @endif
        </div>
    </div>

    @push('scripts_bottom')
        <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
        <script src="/assets/default/js/panel/noticeboard.min.js"></script>
    @endpush
