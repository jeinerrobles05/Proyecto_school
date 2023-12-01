@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')
    <section>
        <h2 class="section-title">{{empty($attendances) ?'Asistencia':'Actalizar Asistencia' }}</h2>
    </section>

    <div class="card-body">
        <div>
            <form method="post" action="/attendances/{{ !empty($attendances) ? $attendances->id.'/update' : 'store' }}" id="attendancesForm" class="webinar-form" name="tableForm">
                {{ csrf_field() }}

                <div class="form-group">
                    <div>
                    <label class="input-label">Fecha</label>

                        @if(!empty($attendances))
                            <label class="input-label">: {{dateTimeFormat($attendances->date, 'd/m/Y', false,false, $webinar->timezone)}}</label>
                        @endif
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="dateInputGroupPrepend">
                               <i class="fa fa-calendar-alt "></i>
                           </span>
                        </div>
                        @if(!empty($attendances))
                            <input type="date" name="date" class="form-control" aria-describedby="dateInputGroupPrepend" aria-describedby="dateInputGroupPrepend"/>
                            <input type="hidden" name="attendance_id" value={{$attendances->id}} >
                            <input type="hidden" name="teacher_id" value={{$attendances->teacher_id}}>
                            <input type="hidden" name="text_lesson_id" value={{$attendances->text_lesson_id}} >
                        @else
                            <input type="date" name="date" value={{date("Y-m-d")}} class="form-control" aria-describedby="dateInputGroupPrepend" aria-describedby="dateInputGroupPrepend"/>
                            <input type="hidden" name="dateview" value={{date("d-m-Y h:i:s")}} >
                            <input type="hidden" name="teacher_id" value={{$webinar->teacher_id}}>
                            <input type="hidden" name="text_lesson_id" value={{$text_lesson->id}} >
                        @endif
                        <input type="hidden" name="timezone" value={{$webinar->timezone}} >
                    </div>
                </div>

                <div class="form-group table-responsive">
                    @if(!empty($attendances))
                        <table class="table table-striped font-14 " value="category" id="tabla" >
                            <tr>
                                <th>Estudiante</th>
                                <th class="text-left">Estado</th>
                            </tr>

                            @foreach($attendanceTranslations as $atte)
                                <tr class="text-center" name="tr">
                                    <td id="id_student"  name="status" >{{ $atte->full_name}}
                                    </td>
                                    <td id="status" name="status">
                                        <select name="status-{{ $atte->student_id }}" class="custom-select" >
                                            <option value="absent" @if(  $atte->status == 'absent') selected @endif>Ausente</option>
                                            <option value="present"  @if( $atte->status == 'present') selected @endif>Presente</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <table class="table table-striped font-14 " value="category" id="tabla" >
                            <tr>
                                <th>Estudiante</th>
                                <th class="text-left">Estado</th>
                            </tr>
                            @foreach($sales  as $attendance)
                                <tr class="text-center" name="tr">
                                    <td id="id_student"  name="full_name" >{{ $attendance->full_name}}
                                    </td>
                                    <td >
                                        <select name="status-{{ $attendance->buyer_id }}" class="custom-select">
                                            <option value="absent" >Ausente</option>
                                            <option value="present" >Presente</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
                <div class="text-right mt-4">
                    <button class="btn btn-primary">{{!empty($attendances)?'Actualizar':'Guardar'}}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
