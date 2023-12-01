

<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title"><?php echo e(trans('panel.tasks_statistics')); ?></h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/46.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($tasksCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('task.tasks')); ?></span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/47.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($webinarCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('public.webinars')); ?></span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/48.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($userCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e(trans('quiz.students')); ?></span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title"><?php echo e(trans('task.filter_tasks')); ?></h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="/panel/tasks" method="get" class="row">
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
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('task.webinar_or_group')); ?></label>
                                <select name="group_id" class="form-control select2" data-placeholder="<?php echo e(trans('public.all')); ?>">
                                    <option value="all"><?php echo e(trans('public.all')); ?></option>

                                    <?php $__currentLoopData = $allGroupsLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($allGroup->group_id); ?>">
                                            <?php echo e($allGroup->webinar->title); ?> - <?php echo e($allGroup->group->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(trans('task.task')); ?></label>
                                        <select name="task_id" class="form-control select2" data-placeholder="<?php echo e(trans('public.all')); ?>">
                                            <option value="all"><?php echo e(trans('public.all')); ?></option>

                                            <?php $__currentLoopData = $allTasksLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($allTask->id); ?>" <?php if(request()->get('task_id') == $allTask->id): ?> selected <?php endif; ?>><?php echo e($allTask->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(trans('public.status')); ?></label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="all"><?php echo e(trans('public.all')); ?></option>
                                            <option value="active" <?php if(request()->get('status') == 'active'): ?> selected <?php endif; ?> ><?php echo e(trans('public.active')); ?></option>
                                            <option value="inactive" <?php if(request()->get('status') == 'inactive'): ?> selected <?php endif; ?> ><?php echo e(trans('public.inactive')); ?></option>
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
            <h2 class="section-title"><?php echo e(trans('task.tasks')); ?></h2>

            <form action="/panel/tasks" method="get" class="">
                <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="mb-0 mr-10 cursor-pointer text-gray font-14 font-weight-500" for="activeTasksSwitch"><?php echo e(trans('task.show_only_active_tasks')); ?></label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="active_tasks" class="custom-control-input" id="activeTasksSwitch" <?php if(request()->get('active_tasks',null) == 'on'): ?> checked <?php endif; ?>>
                        <label class="custom-control-label" for="activeTasksSwitch"></label>
                    </div>
                </div>
            </form>
        </div>

        <?php if($tasks->count() > 0): ?>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th class="text-left"><?php echo e(trans('public.title')); ?></th>
                                    <th class="text-center"><?php echo e(trans('task.task_group')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.pass_mark_t')); ?></th>
                                    <th class="text-center"><?php echo e(trans('quiz.students')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.date_created')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.end_date')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.status')); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left">
                                            <span class="d-block"><?php echo e($task->title); ?></span>
                                            <span class="font-12 text-gray d-block">
                                                <?php if(!empty($task->webinar)): ?>
                                                    <?php echo e($task->webinar->title); ?>

                                                <?php else: ?>
                                                    <?php echo e(trans('panel.not_assign_any_webinar')); ?>

                                                <?php endif; ?>
                                        </span>
                                        </td>
                                        <td class="text-center align-middle"><?php echo e($task->group->name); ?></td>
                                        <td class="text-center align-middle"><?php echo e($task->pass_mark); ?></td>
                                        <td class="text-center align-middle">
                                            <span class="d-block"><?php echo e($task->taskResults->pluck('user_id')->count()); ?></span>

                                            <?php if(!empty($task->userSuccessRate) and $task->userSuccessRate > 0): ?>
                                                <span class="font-12 text-primary d-block"><?php echo e($task->userSuccessRate); ?>% <?php echo e(trans('quiz.passed')); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center align-middle"><?php echo e(dateTimeFormat($task->created_at, 'j M Y H:i')); ?></td>
                                        <td class="text-center align-middle"><?php echo e(dateTimeFormat($task->expiry_days, 'j M Y H:i')); ?></td>

                                        <td class="text-center align-middle"><?php echo e(trans('public.'.$task->status)); ?></td>

                                        <td class="text-center align-middle">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu font-weight-normal">
                                                    <a href="/panel/tasks/<?php echo e($task->id); ?>/edit" class="webinar-actions d-block mt-10"><?php echo e(trans('public.edit')); ?></a>
                                                    <a href="/panel/tasks/<?php echo e($task->id); ?>/delete" data-item-id="1" class="webinar-actions d-block mt-10 delete-action"><?php echo e(trans('public.delete')); ?></a>
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
                'file_name' => 'task.png',
                'title' => trans('task.task_no_result'),
                'hint' => nl2br(trans('task.task_no_result_hint')),
                'btn' => ['url' => '/panel/tasks/new','text' => trans('task.create_a_task')]
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endif; ?>

    </section>

    <div class="my-30">
        <?php echo e($tasks->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>

    <script src="/assets/default/js/panel/task_list.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/lists.blade.php ENDPATH**/ ?>