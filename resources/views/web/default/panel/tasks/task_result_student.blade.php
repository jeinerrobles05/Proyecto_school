@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <div class="container">
        <section class="mt-40">
            <h2 class="font-weight-bold font-16 text-dark-blue">{{ $task->title }}</h2>
            <p class="text-gray font-14 mt-5">
                <a href="{{ $task->webinar->getUrl() }}" target="_blank" class="text-gray">{{ $task->webinar->title }} - {{ $task->group->name }}</a>
                | {{ trans('public.by') }}
                <span class="font-weight-bold">
                    <a href="{{ $task->creator->getProfileUrl() }}" target="_blank" class="font-14"> {{ $task->creator->full_name }}</a>
                </span>
            </p>

            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <div class="row justify-content-between">
                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/58.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{ trans('task.min') }}/{{ trans('task.max') }}</strong>
                            <span class="font-16 text-gray">{{ trans('task.passing_grade') }}</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/88.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{ trans('task.In_progress') }}</strong>
                            <span class="font-16 text-gray">{{ trans('task.task') }}</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/clock.svg" width="64" height="64" alt="">
                            @if(!empty($task->time))
                                <strong class="font-30 font-weight-bold text-secondary mt-5">
                                    <div class="d-flex align-items-center timer ltr" data-minutes-left="{{ $task->time }}"></div>
                                </strong>
                            @else
                                <strong class="font-30 font-weight-bold text-secondary mt-5">{{ dateTimeFormat($task->expiry_days, 'j M Y H:i') }}</strong>
                            @endif
                            <span class="font-16 text-gray">{{ trans('task.remaining_time') }}</span>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="mt-30 task-form">
            <form action="/panel/tasks/{{ $newTaskStart->task->id }}/update-result-student" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="task_result_id" value="{{ !empty($newTaskStart) ? $newTaskStart->id : ''}}" class="form-control" placeholder=""/>
                <input type="hidden" name="attempt_number" value="{{  $attempt_count }}" class="form-control" placeholder=""/>

                <div class="form-group mt-35">
                    <p class="text-gray font-14 mt-5">
                        {{ trans('task.task_description') }}
                    </p>
                </div>

                <div class="rounded-lg shadow-sm py-20 px-20">
                    <div class="task-card">
                        <div class="">
                            <h3 class="font-weight font-16 text-secondary">{!! $task->description !!}</h3>
                            @if(!empty($task->attach))
                                <br>
                                <a href="{{ url($task->attach) }}" target="_blank" class="font-12 mt-10 text-dark-blue"><i data-feather="paperclip" height="14"></i> {{ trans('task.attach') }}</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="rounded-lg shadow-sm py-25 px-20 mt-30">
                    <div class="task-card">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="input-label control-label">{{ trans('site.answer') }}</label>
                                <textarea name="answer" class="summernote form-control text-left @error('answer') is-invalid @enderror">{{ $taskResult->results }}</textarea>
                                <div class="invalid-feedback">@error('answer') {{ $message }} @enderror</div>
                            </div>
                            <div class="form-group mt-20">
                                <label class="input-label">{{ trans('panel.attach_file') }}</label>
                                <input type="file" name="uploaded_file" class="form-control-file @error('uploaded_file') is-invalid @enderror">
                                <div class="invalid-feedback">@error('uploaded_file') {{ $message }} @enderror</div>
                                @if ($taskResult->attach)
                                    <br>
                                    <a href="{{ url($taskResult->attach) }}" target="_blank" class="font-12 mt-10 text-dark-blue"><i data-feather="paperclip" height="14"></i> {{ $taskResult->attach }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mt-30">
                    @if(!empty($newTaskStart))
                        <button type="submit" class="finish btn btn-sm btn-danger">{{ trans('public.finish') }}</button>
                    @endif
                </div>
            </form>
        </section>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/parts/task-start.min.js"></script>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/js/panel/noticeboard.min.js"></script>
@endpush
