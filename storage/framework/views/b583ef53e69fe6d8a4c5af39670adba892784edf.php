<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line"><?php echo e(trans('public.study_plan')); ?> (<?php echo e(trans('public.optional')); ?>)</h2>
    </div>

    <button type="button" class="js-add-study_plan_chapter btn btn-primary btn-sm mt-15" data-webinar-id="<?php echo e($webinar->id); ?>"><?php echo e(trans('public.new_chapter')); ?></button>
   

    <?php echo $__env->make('admin.webinars.create_includes.accordions.study_plan_chapters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<?php if($webinar->isWebinar()): ?>
    <div id="newSessionForm" class="d-none">
        <?php echo $__env->make('admin.webinars.create_includes.accordions.session',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>

<div id="newFileForm" class="d-none">
    <?php echo $__env->make('admin.webinars.create_includes.accordions.file',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php if(getFeaturesSettings('new_interactive_file')): ?>
    <div id="newInteractiveFileForm" class="d-none">
        <?php echo $__env->make('admin.webinars.create_includes.accordions.new_interactive_file',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>
<div id="newStudyPlanTextLessonForm" class="d-none">
    <?php echo $__env->make('admin.webinars.create_includes.accordions.study_plan_text_lesson',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<div id="newQuizForm" class="d-none">
    <?php echo $__env->make('admin.webinars.create_includes.accordions.quiz',[
             'webinar' => $webinar,
             'quizInfo' => null,
             'webinarChapterPages' => true,
             'creator' => $webinar->creator
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php if(getFeaturesSettings('webinar_assignment_status')): ?>
    <div id="newAssignmentForm" class="d-none">
        <?php echo $__env->make('admin.webinars.create_includes.accordions.assignment',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>

<?php echo $__env->make('admin.webinars.create_includes.study_plan_chapter_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.webinars.create_includes.change_study_plan_chapter_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH C:\laragon\www\school_dz\resources\views/admin/webinars/create_includes/study_plan.blade.php ENDPATH**/ ?>