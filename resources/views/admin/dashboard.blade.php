@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Painel de Controle</h1>
</div>
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-whatsapp shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-whatsapp text-uppercase mb-1">Whatsapp</div>
                        @if(!isset($settings->whatsapp_number) || $settings->whatsapp_number == null)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Não informado</div>
                        @else
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$settings->whatsapp_number }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        @if(!isset($settings->whatsapp_number) || $settings->whatsapp_number == null)
                            <i class="fab fa-whatsapp fa-2x text-gray-300"></i>
                        @else
                            <i class="fab fa-whatsapp fa-2x text-gray-300 text-whatsapp"></i>
                        @endif
                    </div>
                </div>
                <a data-toggle="modal" data-target="#editWhatsappModal" class="mr-2 d-none d-lg-inline text-primary text-primary-400 small" style="cursor: pointer">Editar</a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-instagram shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-instagram text-uppercase mb-1">Instagram</div>
                        @if(!isset($settings->instagram) || $settings->instagram == null)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Não informado</div>
                        @else
                            <a href="{{'http://www.instagram.com/'.$settings->instagram}}" target="_blank" class="h5 mb-0 font-weight-bold text-gray-800">{{'@'.$settings->instagram }}</a>
                        @endif
                    </div>
                    <div class="col-auto">
                        @if(!isset($settings->instagram) || $settings->instagram == null)
                            <i class="fab fa-instagram fa-2x text-gray-300"></i>
                        @else
                            <i class="fab fa-instagram fa-2x text-gray-300 text-instagram"></i>
                        @endif
                    </div>
                </div>
                <a data-toggle="modal" data-target="#editInstagramModal" class="mr-2 d-none d-lg-inline text-primary text-primary-400 small" style="cursor: pointer">Editar</a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-google shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-google text-uppercase mb-1">Informações de endereço</div>
                        @if($settings->address == null && $settings->google_map)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Não informado</div>
                        @else
                            @if($settings->google_map != null && $settings->address != null)
                                <small class="text-muted">
                                    <a href="https://goo.gl/maps/{{$settings->google_map}}" target="_blank" class="mb-0 font-weight-bold text-gray-800">{{$settings->address }}, {{$settings->address_number }}, {{$settings->district }}, {{$settings->city }} - {{$settings->state }}</a>
                                </small>
                            @elseif($settings->address == null)
                                <small class="text-muted">
                                    <a href="https://goo.gl/maps/{{$settings->google_map}}" target="_blank" class="mb-0 font-weight-bold text-gray-800">{{$settings->google_map }}</a>
                                </small>
                            @endif
                        @endif
                    </div>
                    <div class="col-auto">
                        @if($settings->google_map == null)
                            <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
                        @else
                            <i class="fas fa-map-marked-alt fa-2x text-gray-300 text-google"></i>
                        @endif
                    </div>
                </div>
                <a data-toggle="modal" data-target="#editGooglemapsModal" class="mr-2 d-none d-lg-inline text-primary text-primary-400 small" style="cursor: pointer">Editar</a>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-facebook shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-facebook text-uppercase mb-1">Facebook</div>
                        @if(!isset($settings->facebook) || $settings->facebook == null)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Não informado</div>
                        @else
                            <a href="{{'http://www.facebook.com/'.$settings->facebook}}" target="_blank" class="h5 mb-0 font-weight-bold text-gray-800" >{{$settings->facebook }}</a>
                        @endif
                    </div>
                    <div class="col-auto">
                        @if(!isset($settings->facebook) || $settings->facebook == null)
                            <i class="fab fa-facebook fa-2x text-gray-300"></i>
                        @else
                            <i class="fab fa-facebook fa-2x text-gray-300 text-facebook"></i>
                        @endif
                    </div>
                </div>
                <a data-toggle="modal" data-target="#editFacebookModal" class="mr-2 d-none d-lg-inline text-primary text-primary-400 small" style="cursor: pointer">Editar</a>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Volume de pedidos por horário</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    {{--<canvas id="myAreaChart"></canvas>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Referências de visitas</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>Mais vendidos
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i>Tráfego Direto
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Mídias Sociais
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referências
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mais vendidos</h6>
            </div>
            {{--<div class="card-body">
                <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>--}}
        </div>

    </div>

    <div class="col-lg-6 mb-4">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Horários</h6>
            </div>
            {{--<div class="card-body">
                <div class="row">
                    <div id="caleandar" class="col-12"></div>
                </div>
            </div>--}}
        </div>
    </div>
</div>
@endsection
@section('modals')
    <div class="modal fade" id="editFacebookModal" tabindex="-1" role="dialog" aria-labelledby="editAdditionalModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando o endereço do facebook </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-dashboard-update-facebook')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="input-group col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">http://facebook.com/</div>
                                </div>
                                <input value="{{(isset($settings->facebook))?$settings->facebook:''}}" type="text" name="facebook" class="form-control" style="width: 50%;"  placeholder="Ex: dudu_lanches">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editInstagramModal" tabindex="-1" role="dialog" aria-labelledby="editAdditionalModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando o nome no instagram </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-dashboard-update-instagram')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="input-group col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input value="{{(isset($settings->instagram))?$settings->instagram:''}}" type="text" name="instagram" class="form-control" style="width: 50%;"  placeholder="Ex: restaurante_do_dudu">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGooglemapsModal" tabindex="-1" role="dialog" aria-labelledby="editAdditionalModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando informações de endereço </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-dashboard-update-google-maps')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="input-group col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">https://goo.gl/maps/</div>
                                </div>
                                <input value="{{(isset($settings->google_map))?$settings->google_map:''}}" type="text" name="google_map" class="form-control" style="width: 50%;"  placeholder="Ex: W1JFdGtgG78GcEFp7">
                            </div>
                            <div class="input-group col-12">
                                <input value="{{(isset($settings->address))?$settings->address:''}}" type="text" name="address" class="form-control" style="width: 50%;"  placeholder="Endereço">
                            </div>
                            <div class="input-group col-4">
                                <input value="{{(isset($settings->address_number))?$settings->address_number:''}}" type="text" name="address_number" class="form-control" style="width: 50%;"  placeholder="N">
                            </div>
                            <div class="input-group col-8">
                                <input value="{{(isset($settings->district))?$settings->district:''}}" type="text" name="district" class="form-control" style="width: 50%;"  placeholder="Bairro">
                            </div>
                            <div class="input-group col-4">
                                <input value="{{(isset($settings->cep))?$settings->cep:''}}" type="text" name="cep" class="form-control" style="width: 50%;"  placeholder="N">
                            </div>
                            <div class="input-group col-4">
                                <input value="{{(isset($settings->city))?$settings->city:''}}" type="text" name="city" class="form-control" style="width: 50%;"  placeholder="N">
                            </div>
                            <div class="input-group col-4">
                                <input value="{{(isset($settings->state))?$settings->state:''}}" type="text" name="state" class="form-control" style="width: 50%;"  placeholder="N">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editWhatsappModal" tabindex="-1" role="dialog" aria-labelledby="editAdditionalModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando o número do WhatsApp </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-dashboard-update-whatsapp')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <input class="form-control" value="{{(isset($settings->whatsapp_number))?$settings->whatsapp_number:''}}" type="text form-control" id="whatsapp_number" name="whatsapp_number" placeholder="Ex: (11) 9 9999-9999" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                        <b<script src="{{asset('vendor/seumenu/js/demo/chart-area-demo.js')}}"></script><button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
<?php
$referral_referral = (isset($settings->referral_referral))?$settings->referral_referral:0;
$referral_social = (isset($settings->referral_social))?$settings->referral_social:0;
$referral_direct = (isset($settings->referral_direct))?$settings->referral_direct:0;
$total = $referral_referral+$referral_social+$referral_direct;
if($referral_referral != 0){
    $referral = round(( $referral_referral / $total ) * 100);
}else{
    $referral = 0;
}
if($referral_social != 0){
    $social = round(( $referral_social / $total ) * 100);
}else{
    $social = 0;
}
if($referral_direct != 0){
    $direct = round(( $referral_direct / $total ) * 100);
}else{
    $direct = 0;
}
?>
@section('javascript')
    <script src="{{asset('vendor/seumenu/js/demo/chart-area-demo.js')}}"></script>
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [{{$direct}}, {{$referral}}, {{$social}}],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
        var events = [
            {'Date': new Date(2020, 3, 5), 'Title': 'Doctor appointment at 3:25pm.'},
            {'Date': new Date(2020, 3, 18), 'Title': 'New Garfield movie comes out!', 'Link': 'https://www.google.com'},
            {'Date': new Date(2020, 3, 27), 'Title': '25 year anniversary', 'Link': 'https://www.google.com'},
        ];
        var settings = {};
        var element = document.getElementById('caleandar');
        caleandar(element, events, settings);
    </script>
@stop
