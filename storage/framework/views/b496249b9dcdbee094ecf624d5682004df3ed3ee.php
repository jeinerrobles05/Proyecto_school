

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(getAdminPanelUrl()); ?>"><?php echo e(trans('admin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item"><?php echo e($pageTitle); ?></div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <form action="<?php echo e(getAdminPanelUrl()); ?>/enrollments/store" method="Post">
                                        <?php echo e(csrf_field()); ?>


                                      
                                        <div class="form-group mt-3">
                                            <label class="input-label">Webinar</label>
                                            <select name="webinar_id" class="search-webinar-select2 custom-select">
                                                <option selected disabled> Seleccione un webinar</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="input-label">Grupo</label>
                                            <select name="group_id" class="js-ajax-course_group_id custom-select">
                                                <option <?php echo e('selected disabled'); ?> > Seleccione un grupo</option>

                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label d-block"><?php echo e(trans('admin/main.user')); ?></label>
                                            <select name="user_id" class="form-control search-user-select2" data-placeholder="<?php echo e(trans('public.search_user')); ?>">

                                            </select>
                                            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class=" mt-4">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('admin/main.add')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
    <script src="/assets/default/js/panel/public.min.js"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/admin/enrollment/add_student_to_a_class.blade.php ENDPATH**/ ?>