

<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Lista de grupos</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(getAdminPanelUrl()); ?>"><?php echo e(trans('admin/main.dashboard')); ?></a>
            </div>
            <div class="breadcrumb-item">Grupo</div>
        </div>
    </div>
     <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-12 col-md-6 col-lg-5">
                                <label class="input-label">Instructor</label>
                                <select name="teacher_id" class="form-control " data-placeholder="Search teachers">
                                    <option value="">Todos</option>
                                    <?php if(!empty($teachers) and $teachers->count() > 0): ?>
                                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($teacher->full_name); ?>"><?php echo e($teacher->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>

                            </div>
                            <div class="col-12 col-md-6 col-lg-5">
                                <label class="input-label">Curso</label>
                                <select class="form-control " name="course_id" data-placeholder="selecciona un curso">
                                    <option value="">Todos</option>
                                    <?php if(!empty($courses) and $courses->count() > 0): ?>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($course->slug); ?>"><?php echo e($course->slug); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2">
                                <label class="input-label" style="visibility: hidden;">Curso</label>
                                <div class="text-center">
                                    <button onclick="Filtro()" type="button" class="btn btn-primary">Filtrar</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">

                        <a href="<?php echo e(getAdminPanelUrl()); ?>/grupos/create" class="btn btn-primary">Agregar Nuevo Grupo</a>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="category-table" class="table table-striped font-14">
                                <tr>
                                    <th>id</th>
                                    <th class="text-left">Nombre</th>
                                    <th>Instructor</th>
                                    <th>Curso</th>
                                    <th>Horario</th>
                                </tr>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($category): ?>
                                <tr>
                                    <td>
                                        <?php echo e($category['id']); ?>

                                    </td>

                                    <td class="text-left"><?php echo e($category['name']); ?></td>
                                    <td><?php echo e($category['teacher']['full_name']); ?></td>
                                    <td><?php echo e($category['curso']['slug']); ?></td>
                                    <td>
                                        <?php echo $__env->make('admin.includes.modal_button',[
                                        'code'=>'Horario|
                                        

                                        ',
                                        'url' => '/admin/grupos',
                                        'tooltip' => 'Ver Horario',
                                        'btnClass' => '',
                                        'btnIcon' => 'fa-eye',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalEjemplo" tabindex="-1" role="dialog" aria-labelledby="modalEjemploLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEjemploLabel">Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal aquí -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<script>
    $(document).ready(function() {
        $('#modalEjemplo').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // El botón que abrió el modal
            var horarios = JSON.parse(button.data('horarios'));
            // Convierte el atributo JSON en un objeto
            console.log(horarios);
            // Construye el contenido del modal con los datos de horarios
            var modalContent = '<table class="table table-bordered">';
            modalContent += '<thead><tr><th>Día</th><th>Hora de Inicio</th><th>Hora de Finalización</th></tr></thead>';
            modalContent += '<tbody>';
            horarios.forEach(function(item) {
                modalContent += '<tr><td>' + item['day'] + '</td><td>' + item['startTime'] + '</td><td>' + item['endTime'] + '</td></tr>';
            });
            modalContent += '</tbody></table>';

            // Actualiza el contenido del modal
            $(this).find('.modal-body').html(modalContent);
        });
    });
     function Filtro() {

        var instructorId = $("select[name='teacher_id']").val();
        var courseId = $("select[name='course_id']").val();

        // Mostrar todas las filas de la tabla
        $("#category-table tbody tr").show();

        if (instructorId !== "") {
            // Ocultar las filas que no coinciden con el instructor seleccionado
            $("#category-table tbody tr").each(function() {
                var rowInstructorId = $(this).find("td:eq(2)").text(); // Ajusta el índice según la columna del instructor
                if (rowInstructorId !== instructorId) {
                    $(this).hide();
                }
            });
        }

        if (courseId !== "") {
            // Ocultar las filas que no coinciden con el curso seleccionado
            $("#category-table tbody tr").each(function() {
                var rowCourseId = $(this).find("td:eq(3)").text(); // Ajusta el índice según la columna del curso
                if (rowCourseId !== courseId) {
                    $(this).hide();
                }
            });
        }

    };
</script>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\school_dz\resources\views/admin/course_group/lists.blade.php ENDPATH**/ ?>