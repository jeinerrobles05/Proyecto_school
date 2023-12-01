

<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title"><?php echo e(trans('task.results_statistics')); ?></h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/43.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($waitingCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('task.need_to_review')); ?></span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/42.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($taskResultsCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('public.results')); ?></span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/58.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($taskAvgGrad); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('task.average_grade')); ?></span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/45.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($successRate); ?>%</strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('task.success_rate')); ?></span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title"><?php echo e(trans('task.filter_results')); ?></h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="/panel/tasks/results" method="get" class="row">
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('public.from')); ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="from" autocomplete="off" class="form-control <?php if(!empty(request()->get('from'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>" aria-describedby="dateInputGroupPrepend" value="<?php echo e(request()->get('from','')); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('public.to')); ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="to" autocomplete="off" class="form-control <?php if(!empty(request()->get('to'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>" aria-describedby="dateInputGroupPrepend" value="<?php echo e(request()->get('to','')); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('task.webinar_or_group')); ?></label>
                                <select name="group_id" class="form-control select2" data-placeholder="<?php echo e(trans('public.all')); ?>">
                                    <option value="all"><?php echo e(trans('public.all')); ?></option>

                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($task->group_id); ?>"><?php echo e($task->webinar->title); ?> - <?php echo e($task->group->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(trans('task.task')); ?></label>
                                        <select name="task_id" class="form-control select2" data-placeholder="<?php echo e(trans('public.all')); ?>">
                                            <option value="all"><?php echo e(trans('public.all')); ?></option>

                                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($task->id); ?>" <?php if(request()->get('task_id') == $task->id): ?> selected <?php endif; ?>><?php echo e($task->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(trans('public.status')); ?></label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="all"><?php echo e(trans('public.all')); ?></option>
                                            <option value="passed" <?php echo e(request()->get('status','') === "passed" ? 'selected' : ''); ?>><?php echo e(trans('quiz.passed')); ?></option>
                                            <option value="failed" <?php echo e(request()->get('status','') === "failed" ? 'selected' : ''); ?>><?php echo e(trans('quiz.failed')); ?></option>
                                            <option value="waiting" <?php echo e(request()->get('status','') === "waiting" ? 'selected' : ''); ?>><?php echo e(trans('quiz.waiting')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2"><?php echo e(trans('public.show_results')); ?></button>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title"><?php echo e(trans('task.student_results')); ?></h2>

            <form action="/panel/tasks/results" method="get" class="">
                <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="mb-0 mr-10 cursor-pointer font-14 text-gray font-weight-500" for="onlyOpenTasksSwitch"><?php echo e(trans('task.show_only_open_results')); ?></label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="open_results" class="custom-control-input" id="onlyOpenTasksSwitch" <?php if(request()->get('open_results',null) == 'on'): ?> checked <?php endif; ?>>
                        <label class="custom-control-label" for="onlyOpenTasksSwitch"></label>
                    </div>
                </div>
            </form>
        </div>

        <?php if($tasksResults->count() > 0): ?>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('quiz.student')); ?></th>
                                    <th><?php echo e(trans('task.task')); ?></th>
                                    <th class="text-center"><?php echo e(trans('task.student_grade')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.status')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.send_date')); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $tasksResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td class="text-left align-middle">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="<?php echo e($result->user->getAvatar()); ?>" class="img-cover" alt="">
                                                </div>
                                                <div class=" ml-5">
                                                    <span class="d-block"><?php echo e($result->user->full_name); ?></span>
                                                    <span class="mt-5 font-12 text-gray d-block"><?php echo e($result->user->email); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left align-middle">
                                            <span class="d-block"><?php echo e($result->task->title); ?></span>
                                            <span class="font-12 text-gray d-block"><?php echo e($result->task->webinar->title); ?></span>
                                        </td>
                                        <td class="align-middle"><?php echo e($result->user_grade); ?></td>
                                        <td class="align-middle">
                                            <?php switch($result->status):
                                                case (\App\Models\TasksResult::$passed): ?>
                                                    <span class="text-primary"><?php echo e(trans('quiz.passed')); ?></span>
                                                    <?php break; ?>
                                                <?php case (\App\Models\TasksResult::$failed): ?>
                                                    <span class="text-danger"><?php echo e(trans('quiz.failed')); ?></span>
                                                    <?php break; ?>
                                                <?php case (\App\Models\TasksResult::$waiting): ?>
                                                    <span class="text-warning"><?php echo e(trans('quiz.waiting')); ?></span>
                                                    <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>
                                        <td class="align-middle"><?php echo e(dateTimeFormat($result->created_at, 'j M Y H:i')); ?></td>
                                        <td class="align-middle text-right">
                                            <div class="btn-group dropdown table-actions table-actions-lg table-actions-lg">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu font-weight-normal">
                                                    <?php if($result->status != 'waiting'): ?>
                                                        <a href="/panel/tasks/<?php echo e($result->id); ?>/result" class="webinar-actions d-block mt-10"><?php echo e(trans('public.view')); ?></a>
                                                    <?php endif; ?>

                                                    <a href="/panel/tasks/<?php echo e($result->id); ?>/edit-result" class="webinar-actions d-block mt-10"><?php echo e(trans('public.review')); ?></a>
                                                    <a href="/panel/tasks/results/<?php echo e($result->id); ?>/delete" class="webinar-actions d-block mt-10 delete-action"><?php echo e(trans('public.delete')); ?></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>

            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                    'file_name' => 'task2.png',
                    'title' => trans('task.task_result_no_result'),
                    'hint' => trans('task.task_result_no_result_hint'),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

    <div class="my-30">
        <?php echo e($tasksResults->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/moment.min.js"></script>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>

    <script src="/assets/default/js/panel/task_list.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/results.blade.php ENDPATH**/ ?>