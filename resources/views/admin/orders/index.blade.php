@extends('layouts.admin')

@section('content')
    <!-- /.container-fluid -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo" role="tab" aria-controls="todo" aria-selected="true">Pendentes de confirmação</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inprogress-tab" data-toggle="tab" href="#inprogress" role="tab" aria-controls="inprogress" aria-selected="false">Em preparo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false">Enviados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Concluídos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="todo" role="tabpanel" aria-labelledby="todo-tab">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pedidos pendentes</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            @if($order_pendings->isNotEmpty())
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Celular</th>
                                        <th>Endereço</th>
                                        <th>Data/Horário</th>
                                        <th style="text-align: center">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody id="order_data">
                                    @foreach ($order_pendings as $order_pending)
                                        <tr>
                                            <td>{{$order_pending->name}}</a></td>
                                            <td>{{$order_pending->cellphone}}</td>
                                            <td>{{$order_pending->address}}</td>
                                            <td>{{date('d/m/Y H:i:s', strtotime($order_pending->created_at))}}</td>
                                            <td style="text-align: center"><button class="btn btn-primary viewOrderModalPendding" data-toggle="modal" data-order-id="{{$order_pending->id}}" data-target="#viewOrderModalPendding">Visualizar</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Nenhum registro encontrado</p>
                            @endif

                            {{ $order_pendings->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="inprogress" role="tabpanel" aria-labelledby="inprogress-tab">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pedidos aceitos</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            @if($order_accepteds->isNotEmpty())
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Celular</th>
                                        <th>Endereço</th>
                                        <th>Data/Horário</th>
                                        <th style="text-align: center">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order_accepteds as $order_accepted)
                                        <tr>
                                            <td>{{$order_accepted->name}}</a></td>
                                            <td>{{$order_accepted->cellphone}}</td>
                                            <td>{{$order_accepted->address}}</td>
                                            <td>{{date('d/m/Y H:i:s', strtotime($order_accepted->created_at))}}</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-primary viewOrderModalAccepted" data-toggle="modal" data-order-id="{{$order_accepted->id}}" data-target="#viewOrderModalAccepted">Visualizar</button>
                                                <a href="{{route('admin-order-sent', $order_accepted->id)}}" role="button" class="btn btn-success" >Enviar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Nenhum registro encontrado</p>
                            @endif

                            {{ $order_accepteds->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pedidos enviados</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            @if($order_sents->isNotEmpty())
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Celular</th>
                                        <th>Endereço</th>
                                        <th>Data/Horário</th>
                                        <th style="text-align: center">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order_sents as $order_sent)
                                        <tr>
                                            <td>{{$order_sent->name}}</a></td>
                                            <td>{{$order_sent->cellphone}}</td>
                                            <td>{{$order_sent->address}}</td>
                                            <td>{{date('d/m/Y H:i:s', strtotime($order_sent->created_at))}}</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-primary viewOrderModalSent" data-toggle="modal" data-order-id="{{$order_sent->id}}" data-target="#viewOrderModalSent">Visualizar</button>
                                                <a href="{{route('admin-order-delivered', $order_sent->id)}}" role="button" class="btn btn-success" >Concluir</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Nenhum registro encontrado</p>
                            @endif

                            {{ $order_sents->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pedidos finalizados</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            @if($order_dones->isNotEmpty())
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Celular</th>
                                        <th>Endereço</th>
                                        <th>Data/Horário</th>
                                        <th style="text-align: center">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order_dones as $order_done)
                                        <tr>
                                            <td>{{$order_done->name}}</a></td>
                                            <td>{{$order_done->cellphone}}</td>
                                            <td>{{$order_done->address}}</td>
                                            <td>{{date('d/m/Y H:i:s', strtotime($order_done->created_at))}}</td>
                                            <td style="text-align: center"><button class="btn btn-primary viewOrderModalDone" data-toggle="modal" data-order-id="{{$order_done->id}}" data-target="#viewOrderModalDone">Visualizar</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Nenhum registro encontrado</p>
                            @endif

                            {{ $order_dones->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="viewOrderModalPendding" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalPendding" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pedido </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div style="min-height: 400px; height: 400px" class="col-12">
                            <div id="modalOrderPendding"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" data-toggle="modal" data-target="#refuseConfirmation"  class="btn btn-danger mr-auto" type="button">Recursar pedido</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                    <a href="" role="button" id="accept_order" class="btn btn-success">Aceitar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewOrderModalAccepted" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalAccepted" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pedido </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div style="min-height: 400px; height: 400px" class="col-12">
                            <div id="modalOrderAccepted"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                    <a href="" role="button" id="sent_order" class="btn btn-success">Enviar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewOrderModalSent" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalSent" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pedido </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div style="min-height: 400px; height: 400px" class="col-12">
                            <div id="modalOrderSent"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                    <a href="" role="button" id="done_order" class="btn btn-success">Concluir</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewOrderModalDone" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalDone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pedido </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div style="min-height: 400px; height: 400px" class="col-12">
                            <div id="modalOrderDone"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="refuseConfirmation" tabindex="-1" role="dialog" aria-labelledby="refuseConfirmation" aria-hidden="true">
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
                            <p>Tem certeza que deseja rejeitar este pedido?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação não poderá ser desfeita.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                    <a href="" class="btn btn-danger" id="reject_order" role="button">Rejeitar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@stop
