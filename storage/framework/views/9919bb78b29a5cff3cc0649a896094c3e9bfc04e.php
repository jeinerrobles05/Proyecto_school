

<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title"><?php echo e(trans('task.filter_results')); ?></h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="/panel/tasks/opens" method="get" class="row">
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
                                <label class="input-label"><?php echo e(trans('task.task_or_webinar')); ?></label>
                                <select name="task_id" class="form-control select2" data-placeholder="<?php echo e(trans('public.all')); ?>">
                                    <option value="all"><?php echo e(trans('public.all')); ?></option>

                                    <?php $__currentLoopData = $allTasksWebinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($allTask->id); ?>" <?php if(request()->get('task_id') == $allTask->id): ?> selected <?php endif; ?>><?php echo e($allTask->title .' - '. ($allTask->webinar ? $allTask->webinar->title : '-')); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('public.instructor')); ?></label>
                                <select name="instructor" class="form-control select2" data-placeholder="<?php echo e(trans('public.all')); ?>">
                                    <option value="all"><?php echo e(trans('public.all')); ?></option>

                                    <?php $__currentLoopData = $allInstructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructorId => $instructorName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($instructorId); ?>" <?php if(request()->get('instructor') == $instructorId): ?> selected <?php endif; ?>><?php echo e($instructorName); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
            <h2 class="section-title"><?php echo e(trans('task.open_tasks')); ?></h2>
        </div>

        <?php if($tasks->count() > 0): ?>
            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('public.instructor')); ?></th>
                                    <th><?php echo e(trans('task.task')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.status')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.start_date')); ?></th>
                                    <th class="text-center"><?php echo e(trans('public.end_date')); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="<?php echo e($task->creator->getAvatar()); ?>" class="img-cover" alt="">
                                                </div>
                                                <div class=" ml-5">
                                                    <span class="d-block text-dark-blue font-weight-500"><?php echo e($task->creator->full_name); ?></span>
                                                    <span class="mt-5 font-12 text-gray d-block"><?php echo e($task->creator->email); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <span class="d-block text-dark-blue font-weight-500"><?php echo e($task->title); ?></span>
                                            <span class="font-12 mt-5 text-gray d-block"><?php echo e($task->webinar->title); ?></span>
                                        </td>

                                        <td class="text-dark-blue font-weight-500 align-middle" style="color: #00ad00"><?php echo e(trans('public.'.$task->status)); ?></td>

                                        <td class="text-dark-blue font-weight-500 align-middle"><?php echo e(dateTimeFormat($task->created_at,'j M Y H:i')); ?></td>

                                        <td class="text-dark-blue font-weight-500 align-middle"><?php echo e(dateTimeFormat($task->expiry_days,'j M Y H:i')); ?></td>

                                        <td class="align-middle text-right font-weight-normal">
                                            <div class="btn-group dropdown table-actions table-actions-lg table-actions-lg">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if($task->expiry_days >= time()): ?>
                                                        <a href="/panel/tasks/<?php echo e($task->id); ?>/start" class="webinar-actions d-block mt-10"><?php echo e(trans('public.start')); ?></a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo e($task->webinar->getUrl()); ?>" target="_blank" class="webinar-actions d-block mt-10"><?php echo e(trans('webinars.webinar_page')); ?></a>
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
        <?php echo e($tasks->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/moment.min.js"></script>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/opens.blade.php ENDPATH**/ ?>