<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<div class="">
    <div data-action="<?php echo e(!empty($task) ? ('/panel/tasks/'. $task->id .'/update') : ('/panel/tasks/store')); ?>" class="js-content-form task-form webinar-form">

        <section>
            <h2 class="section-title after-line"><?php echo e(!empty($task) ? (trans('public.edit').' ('. $task->title .')') : trans('task.new_task')); ?></h2>

            <div class="row">
                <div class="col-12 col-md-4">

                    <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                        <div class="form-group mt-25">
                            <label class="input-label"><?php echo e(trans('auth.language')); ?></label>
                            <select name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][locale]"
                                    class="form-control <?php echo e(!empty($task) ? 'js-webinar-content-locale' : ''); ?>"
                                    data-webinar-id="<?php echo e(!empty($task) ? $task->webinar_id : ''); ?>"
                                    data-id="<?php echo e(!empty($task) ? $task->id : ''); ?>"
                                    data-relation="tasks"
                                    data-fields="title"
                            >
                                <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lang); ?>" <?php echo e((!empty($task) and !empty($task->locale)) ? (mb_strtolower($task->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '')); ?>><?php echo e($language); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][locale]" value="<?php echo e($defaultLocale); ?>">
                    <?php endif; ?>

                        <?php if(empty($selectedWebinar)): ?>
                            <?php if(!empty($webinars) and count($webinars)): ?>
                                <div class="form-group mt-3">
                                    <label class="input-label"><?php echo e(trans('panel.webinar')); ?></label>
                                    <select name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][webinar_id]" class="js-ajax-webinar_id custom-select">
                                        <option <?php echo e(!empty($task) ? 'disabled' : 'selected disabled'); ?> value=""><?php echo e(trans('panel.choose_webinar')); ?></option>
                                        <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($webinar->id); ?>" <?php echo e((!empty($task) and $task->webinar_id == $webinar->id) ? 'selected' : ''); ?>><?php echo e($webinar->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="input-label d-block"><?php echo e(trans('admin/main.webinar')); ?></label>
                                    <select name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][webinar_id]" class="js-ajax-webinar_id form-control search-webinar-select2" data-placeholder="<?php echo e(trans('admin/main.search_webinar')); ?>">

                                    </select>

                                    <div class="invalid-feedback"></div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <input type="hidden" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][webinar_id]" value="<?php echo e($selectedWebinar->id); ?>">
                        <?php endif; ?>

                        <?php if(!empty($task)): ?>
                        <div class="form-group mt-3">
                            <label class="input-label"><?php echo e(trans('task.task_group')); ?></label>
                            <select name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][group_id]" class="js-ajax-group_id custom-select">
                                <option <?php echo e(empty($task) ? 'selected disabled' : ''); ?>> <?php echo e(trans('task.tasks_section')); ?></option>
                                
                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($group->id); ?>" <?php echo e(!empty($task) && $task->group_id == $group->id ? 'selected' : ''); ?>>
                                        <?php echo e($group->name); ?> 
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <?php else: ?>
                            <div class="form-group mt-3">
                                <label class="input-label"><?php echo e(trans('task.task_group')); ?></label>
                                <select name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][group_id]" class="js-ajax-group_id custom-select">
                                    <option <?php echo e(!empty($task) ? 'disabled' : 'selected disabled'); ?> > <?php echo e(trans('task.tasks_section')); ?></option>

                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        <?php endif; ?>


                    <div class="form-group <?php if(!empty($selectedWebinar)): ?> mt-25 <?php endif; ?>">
                        <label class="input-label"><?php echo e(trans('task.task_title')); ?></label>
                        <input type="text" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][title]" value="<?php echo e(!empty($task) ? $task->title : old('title')); ?>"  class="js-ajax-title form-control" placeholder=""/>
                        <div class="invalid-feedback"></div>
                    </div>


                    <div class="form-group">
                        <label class="input-label"><?php echo e(trans('update.expiry_days_t')); ?></label>
                        <input type="datetime-local" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][expiry_days]" value="<?php echo e(!empty($task) ? date('Y-m-d\TH:i', $task->expiry_days) : old('expiry_days')); ?>" class="js-ajax-expiry_days form-control" min="<?php echo e(date('Y-m-d\TH:i')); ?>"/>
                        <div class="invalid-feedback"></div>

                        <p class="font-12 text-gray mt-5"><?php echo e(trans('update.task_expiry_days_hint')); ?></p>
                    </div>


                </div>
            </div>
        </section>
        <section>
            <div class="form-group">
                <label class="input-label control-label"><?php echo e(trans('task.task_description')); ?></label>
                <textarea name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][description]" class="summernote form-control text-left  <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e((!empty($task)) ? $task->description :''); ?></textarea>
                <div class="invalid-feedback"><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 d-flex align-items-center">
                    <div class="form-group">
                        <label class="input-label"><?php echo e(trans('panel.attach_file')); ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager" data-input="attach" data-preview="holder">
                                    <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][attach]" id="attach" value="<?php echo e(!empty($task) ? $task->attach : old('attach')); ?>" class="form-control" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="statusSwitch<?php echo e(!empty($task) ? $task->id : 'record'); ?>"><?php echo e(trans('task.active_task')); ?></label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][status]" class="js-ajax-status custom-control-input" id="statusSwitch<?php echo e(!empty($task) ? $task->id : 'record'); ?>" <?php echo e((!empty($task) && $task->status == 'active') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="statusSwitch<?php echo e(!empty($task) ? $task->id : 'record'); ?>"></label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <input type="hidden" name="ajax[<?php echo e(!empty($task) ? $task->id : 'new'); ?>][is_webinar_page]" value="<?php if(!empty($inWebinarPage) and $inWebinarPage): ?> 1 <?php else: ?> 0 <?php endif; ?>">

        <div class="mt-20 mb-20">
            <button type="button" class="js-submit-task-form btn btn-sm btn-primary"><?php echo e(!empty($task) ? trans('public.save_change') : trans('public.create')); ?></button>

            <?php if(empty($task) and !empty($inWebinarPage)): ?>
                <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion"><?php echo e(trans('public.close')); ?></button>
            <?php endif; ?>
        </div>
    </div>

    <?php $__env->startPush('scripts_bottom'); ?>
        <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
        <script src="/assets/default/js/panel/noticeboard.min.js"></script>
    <?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\school_dz\resources\views/web/default/panel/tasks/create_task_form.blade.php ENDPATH**/ ?>