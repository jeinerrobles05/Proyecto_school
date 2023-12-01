

<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="mt-40">
            <h2 class="font-weight-bold font-16 text-dark-blue"><?php echo e($task->title); ?></h2>
            <p class="text-gray font-14 mt-5">
                <a href="<?php echo e($task->webinar->getUrl()); ?>" target="_blank" class="text-gray"><?php echo e($task->webinar->title); ?></a>
                | <?php echo e(trans('task.by')); ?>

                <span class="font-weight-bold">
                    <a href="<?php echo e($task->creator->getProfileUrl()); ?>" target="_blank" class=""> <?php echo e($task->creator->full_name); ?></a>
                </span>
            </p>

            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <div class="row justify-content-between">

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/88.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5"><?php echo e($numberOfAttempt); ?></strong>
                            <span class="font-16 text-gray font-weight-500"><?php echo e(trans('task.attempts')); ?></span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/45.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5"><?php echo e($taskResult->user_grade); ?>/<?php echo e(trans('task.max')); ?></strong>
                            <span class="font-16 text-gray font-weight-500"><?php echo e(trans('task.your_grade')); ?></span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="/assets/default/img/activity/44.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-<?php echo e(($taskResult->status == 'passed') ? 'primary' : ($taskResult->status == 'waiting' ? 'warning' : 'danger')); ?> mt-5">
                                <?php echo e(trans('task.'.$taskResult->status)); ?>

                            </strong>
                            <span class="font-16 text-gray font-weight-500"><?php echo e(trans('public.status')); ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="mt-30 task-form">
            <form action="<?php echo e(!empty($newTaskStart) ? '/panel/tasks/'. $newTaskStart->task->id .'/update-result' : ''); ?> " method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="task_result_id" value="<?php echo e(!empty($newTaskStart) ? $newTaskStart->id : ''); ?>" class="form-control" placeholder=""/>
                <input type="hidden" name="attempt_number" value="<?php echo e($numberOfAttempt); ?>" class="form-control" placeholder=""/>

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

                <div class="form-group mt-35">
                    <p class="text-gray font-14 mt-5">
                        <?php echo e(trans('task.answer')); ?>

                        <span class="font-weight-bold">
                            <a href="<?php echo e($student->user->getProfileUrl()); ?>" target="_blank" class=""> <?php echo e($student->user->full_name); ?></a>
                        </span>
                    </p>
                </div>

                <div class="rounded-lg shadow-sm py-40 px-20">
                    <div class="task-card">
                        <div class="">
                            <h3 <?php if(empty($newTaskStart) or $newTaskStart->task->creator_id != $authUser->id): ?> disabled <?php endif; ?> class="font-weight font-16 text-dark-blue"><?php echo $taskResult->results; ?></h3>
                            <?php if($taskResult->attach): ?>
                                <br>
                                <a href="<?php echo e(url($taskResult->attach)); ?>" target="_blank" class="font-12 mt-10 text-dark-blue"><i data-feather="paperclip" height="14"></i> <?php echo e(trans('task.attach')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if(!empty($newTaskStart) and $newTaskStart->task->creator_id == $authUser->id): ?>
                    <div class="form-group mt-35">
                        <label class="font-16 text-secondary"><?php echo e(trans('task.qualify')); ?></label>
                        <input type="text" name="user_grade" value="<?php echo e($taskResult->user_grade); ?>" class="form-control">

                        <?php $__errorArgs = ['user_grade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex align-items-center mt-30">
                    <?php if(!empty($newTaskStart)): ?>
                        <button type="submit" class="finish btn btn-sm btn-danger"><?php echo e(trans('public.finish')); ?></button>
                    <?php endif; ?>
                </div>
            </form>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/parts/task-start.min.js"></script>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/js/panel/noticeboard.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/task_result.blade.php ENDPATH**/ ?>