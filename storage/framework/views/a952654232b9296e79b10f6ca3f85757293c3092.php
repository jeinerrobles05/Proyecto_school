<li data-id="<?php echo e(!empty($textLesson) ? $textLesson->id :''); ?>" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="text_lesson_<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>">
        <div class="d-flex align-items-center" href="#collapseTextLesson<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>" aria-controls="collapseTextLesson<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file-text" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block cursor-pointer"><?php echo e(!empty($textLesson) ? $textLesson->title . ($textLesson->accessibility == 'free' ? " (". trans('public.free') .")" : '') : trans('public.add_item')); ?></div>
        </div>

        <div class="d-flex align-items-center">

            <?php if(!empty($textLesson)): ?>
                <button type="button" data-item-id="<?php echo e($textLesson->id); ?>" data-chapter-id="<?php echo e(!empty($chapter) ? $chapter->id : ''); ?>" class="js-change-study-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                    <i data-feather="grid" class="" height="20"></i>
                </button>
            <?php endif; ?>

            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            <?php if(!empty($textLesson)): ?>
                <a href="<?php echo e(getAdminPanelUrl()); ?>/study_plan_text_lesson/<?php echo e($textLesson->id); ?>/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            <?php endif; ?>

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseTextLesson<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>" aria-controls="collapseTextLesson<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseTextLesson<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>" aria-labelledby="text_lesson_<?php echo e(!empty($textLesson) ? $textLesson->id :'record'); ?>" class=" collapse <?php if(empty($textLesson)): ?> show <?php endif; ?>" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form text_lesson-form" data-action="<?php echo e(getAdminPanelUrl()); ?>/study_plan_text_lesson/<?php echo e(!empty($textLesson) ? $textLesson->id . '/update' : 'store'); ?>">
                <input type="hidden" name="ajax[<?php echo e(!empty($textLesson) ? $textLesson->id : 'new'); ?>][webinar_id]" value="<?php echo e(!empty($webinar) ? $webinar->id :''); ?>">

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <?php if(!empty($textLesson)): ?>
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('public.chapter')); ?></label>
                                <select name="ajax[<?php echo e(!empty($textLesson) ? $textLesson->id : 'new'); ?>][chapter_id]" class="js-ajax-chapter_id form-control">
                                    <?php $__currentLoopData = $webinar->studyPlanChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ch->id); ?>" <?php echo e(($textLesson->chapter_id == $ch->id) ? 'selected' : ''); ?>><?php echo e($ch->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="ajax[new][chapter_id]" value="" class="chapter-input">
                        <?php endif; ?>

                        <div class="form-group">
                            <label class="input-label"><?php echo e(trans('public.title')); ?></label>
                            <input type="text" name="ajax[<?php echo e(!empty($textLesson) ? $textLesson->id : 'new'); ?>][title]" class="js-ajax-title form-control" value="<?php echo e(!empty($textLesson) ? $textLesson->title : ''); ?>" placeholder=""/>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="input-label"><?php echo e(trans('public.content')); ?></label>
                            <div class="content-summernote js-ajax-file_path">
                                <textarea class="js-content-summernote form-control <?php echo e(!empty($textLesson) ? 'js-content-'.$textLesson->id : ''); ?>"><?php echo e(!empty($textLesson) ? $textLesson->content : ''); ?></textarea>
                                <textarea name="ajax[<?php echo e(!empty($textLesson) ? $textLesson->id : 'new'); ?>][content]" class="js-hidden-content-summernote <?php echo e(!empty($textLesson) ? 'js-hidden-content-'.$textLesson->id : ''); ?> d-none"><?php echo e(!empty($textLesson) ? $textLesson->content : ''); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-text_lesson btn btn-sm btn-primary"><?php echo e(trans('public.save')); ?></button>

                    <?php if(empty($textLesson)): ?>
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion"><?php echo e(trans('public.close')); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</li>
<?php /**PATH C:\laragon\www\school_dz\resources\views/admin/webinars/create_includes/accordions/study_plan_text_lesson.blade.php ENDPATH**/ ?>