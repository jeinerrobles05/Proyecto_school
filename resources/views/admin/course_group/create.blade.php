@extends('admin.layouts.app')

@push('styles_top')
<link href="/assets/default/vendors/sortable/jquery-ui.min.css" />
@endpush
<?php
// Inicializa el arreglo que almacenará los valores
$valores = array();

// Verifica si se ha enviado el formulario
if (isset($_POST['agregar'])) {
    // Obtiene el valor ingresado
    $nuevo_valor = $_POST['nuevo_valor'];

    // Agrega el valor al arreglo
    $valores[] = $nuevo_valor;
} ?>
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Crear Grupo </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
            </div>
            <div class="breadcrumb-item active">
                <a href="{{ getAdminPanelUrl() }}/grupos/create">Grupos</a>
            </div>
            <div class="breadcrumb-item">Crear</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="form" action="{{ getAdminPanelUrl() }}/grupos/store" method="Post">
                            {{ csrf_field() }}



                            <div class="form-group">
                                <label class="input-label">Instructor</label>
                                <select name="teacher_id" class="form-control " data-placeholder="Search teachers">

                                    @if(!empty($teachers) and $teachers->count() > 0)
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-label">Curso</label>
                                <select class="form-control " name="course_id" data-placeholder="selecciona un curso">

                                    @if(!empty($courses) and $courses->count() > 0)
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->slug }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="row">

                                <div class="col-12 col-md-6 col-lg-3">

                                    <div class="form-group">
                                        <label class="input-label">Dia</label>
                                        <select id="campo1" class="form-control" name="day" data-placeholder="Selecciona un día">
                                            <option value="l">Lunes</option>
                                            <option value="m">Martes</option>
                                            <option value="x">Miércoles</option>
                                            <option value="j">Jueves</option>
                                            <option value="v">Viernes</option>
                                            <option value="s">Sábado</option>
                                            <option value="d">Domingo</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">

                                    <div class="form-group">
                                        <label class="input-label">Hora inicio</label>
                                        <select id="campo2" class="form-control" name="start_time" data-placeholder="Selecciona una hora de inicio">
                                            <option value="8:00 AM">8:00 AM</option>
                                            <option value="9:00 AM">9:00 AM</option>
                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="11:00 AM">11:00 AM</option>
                                            <option value="12:00 PM">12:00 PM</option>
                                            <option value="1:00 PM">1:00 PM</option>
                                            <option value="2:00 PM">2:00 PM</option>
                                            <option value="3:00 PM">3:00 PM</option>
                                            <option value="4:00 PM">4:00 PM</option>
                                        </select>


                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">

                                    <div class="form-group">
                                        <label class="input-label">Hora Finalizacion</label>
                                        <select id="campo3" class="form-control" name="end_time" data-placeholder="Selecciona una hora de inicio">

                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="11:00 AM">11:00 AM</option>
                                            <option value="12:00 PM">12:00 PM</option>
                                            <option value="1:00 PM">1:00 PM</option>
                                            <option value="2:00 PM">2:00 PM</option>
                                            <option value="3:00 PM">3:00 PM</option>
                                            <option value="4:00 PM">4:00 PM</option>
                                            <option value="5:00 PM">5:00 PM</option>
                                            <option value="6:00 PM">6:00 PM</option>
                                        </select>


                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="text-right mt-4">
                                        <button onclick="agregarFila()" type="button" class="btn btn-primary">Agregar horario</button>
                                    </div>
                                </div>

                            </div>
                            <table name="tabla" class="table table-striped font-14" id="miTabla">
                                <tr>
                                    <th>Dia</th>
                                    <th>Hora inicio</th>
                                    <th>Hora Finalizacion</th>
                                </tr>
                            </table>



                            <div class="text-right mt-4">
                                <button onclick="enviarFormulario()" type="button" class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
                            </div>
                        </form>

                        <li class="form-group main-row list-group d-none">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text cursor-pointer move-icon">
                                        <i class="fa fa-arrows-alt"></i>
                                    </div>
                                </div>

                                <input type="text" name="sub_categories[record][title]" class="form-control w-auto flex-grow-1" placeholder="{{ trans('admin/main.choose_title') }}" />

                                <div class="input-group-append">
                                    <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {

            event.preventDefault(); // Detiene el envío del formulario
            enviarFormulario();
        });

        function validarHoras() {
            var horaInicio = document.getElementById("campo2").value;
            var horaFinalizacion = document.getElementById("campo3").value;

            var horaInicioObj = new Date("01/01/2000 " + horaInicio);
            var horaFinalizacionObj = new Date("01/01/2000 " + horaFinalizacion);

            if (horaInicioObj >= horaFinalizacionObj) {
                alert('La hora de inicio debe ser mayor que la hora de finalización.');
                return false; // Detiene el envío del formulario
            }

            return true; // Permite el envío del formulario si las horas son válidas
        }
        // Función para agregar una fila
        function agregarFila() {
            if (validarHoras()) {
                // Obtén los valores de los campos
                var valor1 = document.getElementById("campo1").value;
                var valor2 = document.getElementById("campo2").value;
                var valor3 = document.getElementById("campo3").value;


                // Verifica si los datos ya existen
                var nuevaFila = [valor1, valor2, valor3];
                if (datosExistentes(nuevaFila)) {
                    alert('Estos datos ya existen en la tabla.');
                    return;
                }

                // Crea una nueva fila en la tabla
                var tabla = document.getElementById("miTabla");
                var fila = tabla.insertRow();

                // Inserta celdas con los valores
                var celda1 = fila.insertCell(0);
                celda1.innerHTML = valor1;
                var celda2 = fila.insertCell(1);
                celda2.innerHTML = valor2;
                var celda3 = fila.insertCell(2);
                celda3.innerHTML = valor3;


                // Borra los valores en los campos de entrada
                document.getElementById("campo1").value = "";
                document.getElementById("campo2").value = "";
                document.getElementById("campo3").value = "";


                // Guarda los datos en el localStorage
                var tableData = JSON.parse(localStorage.getItem('tableData')) || [];
                tableData.push(nuevaFila);
                localStorage.setItem('tableData', JSON.stringify(tableData));
            }

        }

        // Carga los datos del localStorage al cargar la página
        window.onload = function() {
            var tableData = JSON.parse(localStorage.getItem('tableData')) || [];
            var tabla = document.getElementById("miTabla");

            tableData.forEach(function(rowData) {
                var fila = tabla.insertRow();
                rowData.forEach(function(cellData) {
                    var celda = fila.insertCell();
                    celda.innerHTML = cellData;
                });
            });
        };

        function datosExistentes(data) {
            var tableData = JSON.parse(localStorage.getItem('tableData')) || [];
            for (var i = 0; i < tableData.length; i++) {
                if (JSON.stringify(tableData[i]) === JSON.stringify(data)) {
                    return true;
                }
            }
            return false;
        }

        function enviarFormulario() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var urlActual = window.location.origin;


            var table = document.getElementById('miTabla');
            var tableData = [];

            for (var i = 1; i < table.rows.length; i++) {
                var row = table.rows[i];
                var dia = row.cells[0].innerText;
                var start = row.cells[1].innerText;
                var end = row.cells[2].innerText;
                tableData.push({
                    day: dia,
                    start_time: start,
                    end_time: end
                });
            }


            var instructorId = document.querySelector('select[name="teacher_id"]').value;
            var courseId = document.querySelector('select[name="course_id"]').value;





            var formData = JSON.stringify({
                horario: tableData,
                teacher_id: instructorId,
                course_id: courseId,
            });

            alert(urlActual + "/admin/grupos/store")

            fetch(urlActual + "/admin/grupos/store", {

                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },

                    body: formData
                })
                .then(response => {
                    if (response.ok) {

                        alert('Formulario enviado correctamente');
                        console.log(response);

                        localStorage.removeItem('tableData');
                    } else {

                        alert('Error al enviar el formulario');
                    }
                })
                .catch(error => {
                    alert('Error de red:', error);
                });

        }
    </script>
</section>
@endsection

@push('scripts_bottom')
<script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>

<script src="/assets/default/js/admin/categories.min.js"></script>
@endpush