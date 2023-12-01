<button class="@if(empty($hideDefaultClass) or !$hideDefaultClass) {{ !empty($noBtnTransparent) ? '' : 'btn-transparent' }} text-primary @endif {{ $btnClass ?? '' }}" data-confirm='{{$code}}<table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Día</th>
                                                    <th>Hora de Inicio</th>
                                                    <th>Hora de Finalización</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Aquí puedes llenar la tabla con los horarios -->
                                                @foreach($category["Schedules"] as $horario)
                                                <tr>
                                                <td>
                                                    @if ($horario["day"] ==  "l" ) Lunes
                                                    @elseif ($horario["day"] == "m" ) Martes
                                                    @elseif ($horario["day"] == "x" ) Miércoles
                                                    @elseif ($horario["day"] == "j" ) Jueves
                                                    @elseif ($horario["day"] == "v" ) Viernes
                                                    @elseif ($horario["day"] == "s" ) Sábado
                                                    @else
                                                        Domingo
                                                    @endif
                                                </td>
                                                    <td>{{ $horario["start_time"] }}</td>
                                                    <td>{{ $horario["end_time"] }}</td>
                                                </tr>
                                                @endforeach
                                                <!-- Repite esto para los otros días -->
                                            </tbody>
                                        </table>' data-confirm-href="{{ $url }}" data-confirm-text-yes="{{ trans('admin/main.yes') }}" data-confirm-text-cancel="{{ trans('admin/main.cancel') }}" @if(empty($btnText)) data-toggle="tooltip" data-placement="top" title="{{ !empty($tooltip) ? $tooltip : trans('admin/main.delete') }}" @endif>
    @if(!empty($btnText))
    {!! $btnText !!}
    @else
    <i class="fa {{ !empty($btnIcon) ? $btnIcon : 'fa-times' }}" aria-hidden="true"></i>
    @endif
</button>