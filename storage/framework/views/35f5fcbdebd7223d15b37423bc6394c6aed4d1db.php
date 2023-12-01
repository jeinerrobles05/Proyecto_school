<button class="<?php if(empty($hideDefaultClass) or !$hideDefaultClass): ?> <?php echo e(!empty($noBtnTransparent) ? '' : 'btn-transparent'); ?> text-primary <?php endif; ?> <?php echo e($btnClass ?? ''); ?>" data-confirm='<?php echo e($code); ?><table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Día</th>
                                                    <th>Hora de Inicio</th>
                                                    <th>Hora de Finalización</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Aquí puedes llenar la tabla con los horarios -->
                                                <?php $__currentLoopData = $category["Schedules"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                <td>
                                                    <?php if($horario["day"] ==  "l" ): ?> Lunes
                                                    <?php elseif($horario["day"] == "m" ): ?> Martes
                                                    <?php elseif($horario["day"] == "x" ): ?> Miércoles
                                                    <?php elseif($horario["day"] == "j" ): ?> Jueves
                                                    <?php elseif($horario["day"] == "v" ): ?> Viernes
                                                    <?php elseif($horario["day"] == "s" ): ?> Sábado
                                                    <?php else: ?>
                                                        Domingo
                                                    <?php endif; ?>
                                                </td>
                                                    <td><?php echo e($horario["start_time"]); ?></td>
                                                    <td><?php echo e($horario["end_time"]); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <!-- Repite esto para los otros días -->
                                            </tbody>
                                        </table>' data-confirm-href="<?php echo e($url); ?>" data-confirm-text-yes="<?php echo e(trans('admin/main.yes')); ?>" data-confirm-text-cancel="<?php echo e(trans('admin/main.cancel')); ?>" <?php if(empty($btnText)): ?> data-toggle="tooltip" data-placement="top" title="<?php echo e(!empty($tooltip) ? $tooltip : trans('admin/main.delete')); ?>" <?php endif; ?>>
    <?php if(!empty($btnText)): ?>
    <?php echo $btnText; ?>

    <?php else: ?>
    <i class="fa <?php echo e(!empty($btnIcon) ? $btnIcon : 'fa-times'); ?>" aria-hidden="true"></i>
    <?php endif; ?>
</button><?php /**PATH C:\laragon\www\school_dz\resources\views/admin/includes/modal_button.blade.php ENDPATH**/ ?>