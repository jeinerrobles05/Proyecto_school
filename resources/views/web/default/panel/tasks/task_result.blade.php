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
                | {{ trans('task.by') }}
                <span class="font-weight-bold">
                    <a href="{{ $task->creator->getProfileUrl() }}" target="_blank" class=""> {{ $task->creator->full_name }}</a>
                </span>
            </p>

            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <div class="row justify-content-between">

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/88.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{ $numberOfAttempt }}</strong>
                            <span class="font-16 text-gray font-weight-500">{{ trans('task.attempts') }}</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/45.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{ $taskResult->user_grade }}/{{ trans('task.max') }}</strong>
                            <span class="font-16 text-gray font-weight-500">{{ trans('task.your_grade') }}</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/44.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-{{ ($taskResult->status == 'passed') ? 'primary' : ($taskResult->status == 'waiting' ? 'warning' : 'danger') }} mt-5">
                                {{ trans('task.'.$taskResult->status) }}
                            </strong>
                            <span class="font-16 text-gray font-weight-500">{{ trans('public.status') }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="mt-30 task-form">
            <form action="{{ !empty($newTaskStart) ? '/panel/tasks/'. $newTaskStart->task->id .'/update-result' : '' }} " method="post">
                {{ csrf_field() }}
                <input type="hidden" name="task_result_id" value="{{ !empty($newTaskStart) ? $newTaskStart->id : ''}}" class="form-control" placeholder=""/>
                <input type="hidden" name="attempt_number" value="{{  $numberOfAttempt }}" class="form-control" placeholder=""/>

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

                <div class="form-group mt-35">
                    <p class="text-gray font-14 mt-5">
                        {{ trans('task.answer') }}
                        <span class="font-weight-bold">
                            <a href="{{ $student->user->getProfileUrl() }}" target="_blank" class=""> {{ $student->user->full_name }}</a>
                        </span>
                    </p>
                </div>

                <div class="rounded-lg shadow-sm py-40 px-20">
                    <div class="task-card">
                        <div class="">
                            <h3 @if(empty($newTaskStart) or $newTaskStart->task->creator_id != $authUser->id) disabled @endif class="font-weight font-16 text-dark-blue">{!! $taskResult->results !!}</h3>
                            @if ($taskResult->attach)
                                <br>
                                <a href="{{ url($taskResult->attach) }}" target="_blank" class="font-12 mt-10 text-dark-blue"><i data-feather="paperclip" height="14"></i> {{ trans('task.attach') }}</a>
                            @endif
                        </div>
                    </div>
                </div>

                @if(!empty($newTaskStart) and $newTaskStart->task->creator_id == $authUser->id)
                    <div class="form-group mt-35">
                        <label class="font-16 text-secondary">{{ trans('task.qualify') }}</label>
                        <input type="text" name="user_grade" value="{{ $taskResult->user_grade }}" class="form-control">

                        @error('user_grade')
                        <div class="invalid-feedback"></div>
                        @enderror
                    </div>
                @endif

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
