<div id="studyPlanChapterModalHtml" class="d-none">
    <div class="custom-modal-body">
        <h2 class="section-title after-line"><?php echo e(trans('public.new_chapter')); ?></h2>
        <div class="js-content-form study-chapter-form mt-20" data-action="<?php echo e(getAdminPanelUrl()); ?>/study_plan_chapters/store">

            <input type="hidden" name="ajax[chapter][webinar_id]" class="js-study-chapter-webinar-id" value="">

            <?php if(!empty(getGeneralSettings('content_translate'))): ?>

                <div class="form-group">
                    <label class="input-label"><?php echo e(trans('auth.language')); ?></label>
                    <select name="ajax[chapter][locale]"
                            class="form-control js-chapter-locale"
                            data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                            data-id=""
                            data-relation="chapters"
                            data-fields="title"
                    >
                        <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lang); ?>"><?php echo e($language); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php else: ?>
                <input type="hidden" name="ajax[chapter][locale]" value="<?php echo e($defaultLocale); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label class="input-label"><?php echo e(trans('public.chapter_title')); ?></label>
                <input type="text" name="ajax[chapter][title]" class="form-control js-ajax-title" value=""/>
                <span class="invalid-feedback"></span>
            </div>


                <div class="form-group">
                    <label class="input-label"><?php echo e(trans('public.content')); ?></label>
                    <div >
                        <textarea name="ajax[chapter][content]" class="form-control js-ajax-content" rows="7"></textarea>
                    </div>
                </div>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-study-plan-chapter btn btn-sm btn-primary"><?php echo e(trans('public.save')); ?></button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2"><?php echo e(trans('public.close')); ?></button>
            </div>

        </div>
    </div>
</div>


<?php /**PATH C:\laragon\www\school_dz\resources\views/admin/webinars/create_includes/study_plan_chapter_modal.blade.php ENDPATH**/ ?>