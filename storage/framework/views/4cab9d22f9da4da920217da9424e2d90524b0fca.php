

<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="mt-40">
            <h2 class="font-weight-bold font-16 text-dark-blue"><?php echo e($task->title); ?></h2>
            <p class="text-gray font-14 mt-5">
                <a href="<?php echo e($task->webinar->getUrl()); ?>" target="_blank" class="text-gray"><?php echo e($task->webinar->title); ?> - <?php echo e($task->group->name); ?></a>
                | <?php echo e(trans('public.by')); ?>

                <span class="font-weight-bold">
                    <a href="<?php echo e($task->creator->getProfileUrl()); ?>" target="_blank" class="font-14"> <?php echo e($task->creator->full_name); ?></a>
                </span>
            </p>

            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <div class="row justify-content-between">
                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/58.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5"><?php echo e(trans('task.min')); ?>/<?php echo e(trans('task.max')); ?></strong>
                            <span class="font-16 text-gray"><?php echo e(trans('task.passing_grade')); ?></span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/88.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5"><?php echo e(trans('task.In_progress')); ?></strong>
                            <span class="font-16 text-gray"><?php echo e(trans('task.task')); ?></span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/clock.svg" width="64" height="64" alt="">
                            <?php if(!empty($task->time)): ?>
                                <strong class="font-30 font-weight-bold text-secondary mt-5">
                                    <div class="d-flex align-items-center timer ltr" data-minutes-left="<?php echo e($task->time); ?>"></div>
                                </strong>
                            <?php else: ?>
                                <strong class="font-30 font-weight-bold text-secondary mt-5"><?php echo e(dateTimeFormat($task->expiry_days, 'j M Y H:i')); ?></strong>
                            <?php endif; ?>
                            <span class="font-16 text-gray"><?php echo e(trans('task.remaining_time')); ?></span>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="mt-30 task-form">
            <form action="/panel/tasks/<?php echo e($task->id); ?>/store-result" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="task_result_id" value="" class="form-control" placeholder=""/>
                <input type="hidden" name="attempt_number" value="<?php echo e($attempt_count); ?>" class="form-control" placeholder=""/>

                <div class="form-group mt-35">
                    <p class="text-gray font-14 mt-5">
                        <?php echo e(trans('task.task_description')); ?>

                    </p>
                </div>

                <div class="rounded-lg shadow-sm py-20 px-20">
                    <div class="task-card">
                        <div class="">
                            <h3 class="font-weight font-16 text-secondary"><?php echo $task->description; ?></h3>
                            <?php if(!empty($task->attach)): ?>
                                <br>
                                <a href="<?php echo e(url($task->attach)); ?>" target="_blank" class="font-12 mt-10 text-dark-blue"><i data-feather="paperclip" height="14"></i> <?php echo e(trans('task.attach')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg shadow-sm py-25 px-20 mt-30">
                    <div class="task-card">
                        <div class="form-group">
                            <label class="input-label control-label"><?php echo e(trans('site.answer')); ?></label>
                            <textarea name="answer" class="summernote form-control text-left <?php $__errorArgs = ['answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"></textarea>
                            <div class="invalid-feedback"><?php $__errorArgs = ['answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                        </div>
                        <div class="form-group mt-20">
                            <label class="input-label"><?php echo e(trans('panel.attach_file')); ?></label>
                            <input type="file" name="uploaded_file" class="form-control-file <?php $__errorArgs = ['uploaded_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <div class="invalid-feedback"><?php $__errorArgs = ['uploaded_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mt-30">
                    <button type="submit" class="finish btn btn-sm btn-danger"><?php echo e(trans('public.finish')); ?></button>
                </div>
            </form>
        </section>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/video/video.min.js"></script>
    <script src="/assets/default/vendors/jquery.simple.timer/jquery.simple.timer.js"></script>
    <script src="/assets/default/js/parts/task-start.min.js"></script>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/js/panel/noticeboard.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/start.blade.php ENDPATH**/ ?>