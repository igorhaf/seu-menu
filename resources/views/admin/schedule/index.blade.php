@extends('layouts.admin')

@section('content')
    <p class="help-block">Use o <i class="fas fa-power-off"></i> para ativar ou desativar.</p>

    <div class="row">

        <div class="col-lg-7">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Horários do estabelecimento</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agenda de abertura do estabelecimento</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-schedule-layout')}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <select name="layout_id" id="scheduleLayoutSelect" class="form-control">
                                                <option value="">Selecione um layout</option>
                                                <option value="1">De terça a domingo (09:00 as 12:00) e (14:00 as 18:00)</option>
                                                <option value="2">De terça a domingo (09:00 as 18:00)</option>
                                                <option value="3">De terça a domingo (horário integral)</option>
                                                <option value="4">Todos os dias (09:00 as 12:00) e (14:00 as 18:00)</option>
                                                <option value="5">Todos os dias (09:00 as 18:00)</option>
                                                <option value="6">Todos os dias (horário integral)</option>
                                                <option value="7">Sabado e domingo (09:00 as 12:00) e (14:00 as 18:00)</option>
                                                <option value="8">Sabado e domingo (09:00 as 18:00)</option>
                                                <option value="9">Sabado e domingo (horário integral)</option>
                                                <option value="10">De segunda a sexta (09:00 as 12:00) e (14:00 as 18:00)</option>
                                                <option value="11">De segunda a sexta (09:00 as 18:00)</option>
                                                <option value="12">De segunda a sexta (horário integral)</option>
                                                <option value="13">De segunda a sábado (09:00 as 12:00) e (14:00 as 18:00)</option>
                                                <option value="14">De segunda a sábado (09:00 as 18:00)</option>
                                                <option value="15">De segunda a sábado (horário integral)</option>
                                            </select>
                                            <div class="input-group-append">
                                                <a style="color: white; cursor: pointer;" role="button" data-toggle="modal" data-target="#applyScheduleLayout" class="applyScheduleLayoutBtn btn btn-primary btn-user">
                                                    Aplicar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12"  style="text-align: center">
                                        <br>
                                        <small>O layout de horários serve como base para o seu preenchimento, após aplicar o layout, você pode alterá-lo do que jeito que preferir.</small>
                                        <br><br>
                                        @if (session('no_shedule'))
                                            <div class="alert alert-danger">
                                                {{ session('no_shedule') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_payment_schedule col-12">
                            <tbody>
                            @foreach($days_of_week as $key => $day_of_week)
                                <tr  id="item_{{$key}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a class="btn btn-lg btn-block btn-{{($day_of_week[1])?'primary':'secondary'}}" style="color: #fff"  style="text-align: left">
                                                <div class="text float-left" >{{$day_of_week[0]}}</div>
                                            </a>
                                            <a href="{{route('admin-schedule-change-visibility', $key)}}" role="button" class="btn btn-{{($day_of_week[1])?'primary':'secondary'}} btn-lg">
                                                <span class="icon text-white-50">
                                                   <i class="fas fa-power-off"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><br></h1>
            </div>
            @foreach($days_of_week as $key => $day_of_week)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{$day_of_week[0]}}</h6>
                </div>
                <div class="card-body">
                    @if (session('logic_error_'.$key))
                        <div class="alert alert-danger">
                            {{ session('logic_error_'.$key) }}
                        </div>
                    @endif
                    <form role="form" method="post" action="{{route('admin-schedule-store')}}">
                        @csrf
                        <input type="hidden" name="week_day" value="{{$key}}" />
                        <div class="form-group">
                            <div class="row">
                                <div class=" col-5">
                                <label>
                                    das <input type="text" name="start_time" placeholder="Horário" class=" timepicker form-control">
                                </label>
                                </div>
                                <div class="col-7">
                                    <label style="margin-bottom: 0.0rem;" for="end_time">às</label>
                                    <div class="input-group">
                                        <input type="text" name="end_time" placeholder="Horário" class=" timepicker form-control">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary btn-user">
                                                Adicionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="db_payment_debit col-12">
                        <tbody>
                        @foreach($day_of_week[3] as $key => $schedule)
                            @if(!empty($schedule))
                            <tr  id="item_{{$key}}">
                                <td>
                                    <div class="btn-group btn-block" role="group">

                                        <a role="button"  class="editShedule btn  btn-{{($schedule->status)?'primary':'secondary'}} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-id="{{$schedule->id}}" data-start_time="{{date('H:i', strtotime($schedule->start_time))}}" data-end_time="{{date('H:i', strtotime($schedule->end_time))}}" data-week_day="{{$schedule->week_day}}" data-target="#editScheduleModal">
                                            <div class="text float-left" >De {{date('H:i', strtotime($schedule->start_time))}}hs às {{date('H:i', strtotime($schedule->end_time))}}hs</div>
                                        </a>
                                        <a href="{{route('admin-schedule-change-item-visibility', $schedule->id)}}" role="button" class="btn  btn-{{($schedule->status)?'primary':'secondary'}} btn-lg">
                                        <span class="icon text-white-50">
                                           <i class="fas fa-power-off"></i>
                                        </span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="applyScheduleLayout" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('admin-schedule-layout')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <p>Tem certeza que deseja aplicar este layout?</p>
                                <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação excluirá todos os agendamentos feitos até agora (menos as excessões) e não poderá ser desfeita.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="layout_id_modal" id="layoutIdModal">
                        <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger" type="submit">Aplicar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando horário </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-update-schedule')}}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <input type="hidden" name="id" id="scheduleId">
                                <input type="hidden" name="week_day" id="scheduleWeekDay" />
                                <div class="form-group">
                                    <div class="row">
                                        <div class=" col-6">
                                            <label>
                                                das <input type="text" id="scheduleStartTime" name="start_time" placeholder="Horário" class=" timepicker form-control">
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label style="margin-bottom: 0.0rem;" for="end_time">às</label>
                                            <div class="input-group">
                                                <input type="text" id="scheduleEndTime" name="end_time" placeholder="Horário" class=" timepicker form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteScheduleModal"  class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Tem certeza que deseja excluir este horário?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação não poderá ser desfeita.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                    <a href="" class="btn btn-danger" role="button">Excluir</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).on("click", ".editShedule", function () {
            var id = $(this).data('id');
            var week_day = $(this).data('week_day');
            var start_time = $(this).data('start_time');
            var end_time = $(this).data('end_time');
            $("#deleteScheduleModal .modal-footer a").attr( 'href', '{{route('admin-delete-schedule')}}/'+id);
            $(".modal-body #scheduleId").val( id );
            $(".modal-body #scheduleStartTime").val( start_time );
            $(".modal-body #scheduleEndTime").val( end_time );
            console.log(week_day)
            $(".modal-body #scheduleWeekDay").val( week_day );
        });
        $(document).on("click", ".applyScheduleLayoutBtn", function () {
            //Update Delivery points
            var id = $('#scheduleLayoutSelect').val();
            $("#layoutIdModal").val( id );
        });
        $( document ).ready(function() {
            $('.timepicker').timepicker({
                'timeFormat': 'H:i',
            }).val('00:00');
        });
    </script>
@stop
