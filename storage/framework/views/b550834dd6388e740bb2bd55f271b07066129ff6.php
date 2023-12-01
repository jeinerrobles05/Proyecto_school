<div id="changeStudyPlanChapterModalHtml" class="d-none">
    <div class="custom-modal-body">
        <h2 class="section-title after-line"><?php echo e(trans('update.change_chapter')); ?></h2>

        <div class="js-content-form study-change-chapter-form mt-20" data-action="<?php echo e(getAdminPanelUrl()); ?>/study_plan_chapters/change">

            <input type="hidden" name="ajax[webinar_id]" class="" value="<?php echo e($webinar->id); ?>">
            <input type="hidden" name="ajax[item_id]" class="js-item-id" value="">

            <div class="form-group">
                <label class="input-label"><?php echo e(trans('public.chapter')); ?></label>

                <select name="ajax[chapter_id]" class="js-ajax-study_chapter_id custom-select">
                    <option value=""><?php echo e(trans('update.select_chapter')); ?></option>

                    <?php if(!empty($webinar->studyPlanChapters) and count($webinar->studyPlanChapters)): ?>
                        <?php $__currentLoopData = $webinar->studyPlanChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($chapter->id); ?>"><?php echo e($chapter->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-change-study-plan-chapter btn btn-sm btn-primary"><?php echo e(trans('public.save')); ?></button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2"><?php echo e(trans('public.close')); ?></button>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\school_dz\resources\views/admin/webinars/create_includes/change_study_plan_chapter_modal.blade.php ENDPATH**/ ?>