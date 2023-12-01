<?php if(!empty($course->studyPlanChapters) and count($course->studyPlanChapters)): ?>
    <section class="">
        <?php echo $__env->make('web.default.course.tabs.contents.study_plan_chapter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/course/tabs/study_plan.blade.php ENDPATH**/ ?>