

<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="mt-40">
            <h2 class="font-weight-bold font-16 text-dark-blue"><?php echo e($task->title); ?></h2>
            <p class="text-gray font-14 mt-5"><?php echo e($task->webinar->title); ?> | <?php echo e(trans('public.by')); ?> <span class="font-weight-bold"><?php echo e($task->creator->full_name); ?></span></p>

            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <div class="row justify-content-between">

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

        <section class="mt-30 rounded-lg shadow-sm py-25 px-20">

            <?php switch($taskResult->status):

                case (\App\Models\TasksResult::$passed): ?>
                    <div class="no-result default-no-result mt-50 d-flex align-items-center justify-content-center flex-column">
                        <div class="no-result-logo">
                            <img src="/assets/default/img/no-results/497.png" alt="">
                        </div>
                        <div class="d-flex align-items-center flex-column mt-30 text-center">
                            <h2 class="section-title"><?php echo e(trans('task.status_passed_title')); ?></h2>
                            <p class="mt-5 text-center"><?php echo trans('task.status_passed_hint'); ?><?php echo e($taskResult->user_grade); ?></p>

                            <div class=" mt-25">
                                <a href="/panel/tasks/my-results" class="btn btn-sm btn-primary"><?php echo e(trans('public.show_results')); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php break; ?>

                <?php case (\App\Models\TasksResult::$failed): ?>
                    <div class="no-result status-failed mt-50 d-flex align-items-center justify-content-center flex-column">
                        <div class="no-result-logo">
                            <img src="/assets/default/img/no-results/339.png" alt="">
                        </div>
                        <div class="d-flex align-items-center flex-column mt-30 text-center">
                            <h2 class="section-title"><?php echo e(trans('task.status_failed_title')); ?></h2>
                            <p class="mt-5 text-center"><?php echo trans('task.status_failed_hint'); ?><?php echo e($taskResult->user_grade); ?></p>
                            <div class=" mt-25">
                                <a href="/panel/tasks/my-results" class="btn btn-sm btn-primary"><?php echo e(trans('public.show_results')); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php break; ?>

                <?php case (\App\Models\TasksResult::$waiting): ?>
                    <div class="no-result status-waiting mt-50 d-flex align-items-center justify-content-center flex-column">
                        <div class="no-result-logo">
                            <img src="/assets/default/img/no-results/242.png" alt="">
                        </div>
                        <div class="d-flex align-items-center flex-column mt-30 text-center">
                            <h2 class="section-title"><?php echo e(trans('task.status_waiting_title')); ?></h2>
                            <p class="mt-5 text-center"><?php echo nl2br(trans('task.status_waiting_hint')); ?></p>
                            <div class=" mt-25">
                                <a href="/panel/tasks/my-results" class="btn btn-sm btn-primary"><?php echo e(trans('public.show_results')); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php break; ?>
            <?php endswitch; ?>

        </section>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/status.blade.php ENDPATH**/ ?>