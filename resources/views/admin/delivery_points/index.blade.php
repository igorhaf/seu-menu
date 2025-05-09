@extends('layouts.admin')

@section('content')
    <p class="help-block">Clique no nome para editar uma cidade ou ponto de entrega. Arraste com o <i class="fas fa-arrows-alt"></i> para reordenar, ou use o <i class="fas fa-power-off"></i> para ativar ou desativar.</p>

    <div class="row">
        <div class="col-lg-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Entrega</h1>
                <div class="form-group" style="margin-top: 20px">
                    <label>Delivery</label>
                    <input type="checkbox" id="delivery_change" name="delivery" {{($settings->delivery==true?'checked':'')}} data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger" >
                </div>
                <div class="form-group" style="margin-top: 20px">
                    <label>Retirar em loja</label>
                    <input type="checkbox" id="pickup_change" name="pickup"  {{($settings->pickup==true?'checked':'')}} data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger" >
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cidades cobertas pela área de entrega</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-store-delivery-cities')}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" name="city" placeholder="Cidades na área de cobertura" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                        @error('city')
                                        <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_delivery_city col-12">
                            <tbody>
                            @foreach($delivery_cities as $delivery_city)
                                <tr  id="item_{{$delivery_city->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $delivery_city->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button" data-toggle="modal" data-target="#editDeliveryCityModal"  data-city="{{$delivery_city->city}}" data-id="{{$delivery_city->id}}"  class="editDeliveryCity btn btn-{{  $delivery_city->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff; text-align: left" >
                                                <div class="text float-left" >{{$delivery_city->city}}</div>
                                            </a>
                                            <a href="{{route('admin-delivery-cities-change-visibility', $delivery_city->id)}}" role="button" class="btn btn-{{  $delivery_city->visible === true ? "primary":"secondary" }} btn-lg">
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

        <div class="col-lg-7" style="padding-top: 40px;">

            <div class="row" style="margin-right: 20px">
                <div class="col-md-4">
                    <div class="float-right form-group">
                        <label>Frete grátis</label>
                        <input type="checkbox" id="free_delivery_change"  name="free_delivery" {{($settings->free_delivery==true?'checked':'')}}  data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>
                <div class="col-md-8">
                    <form id="form-update-free-delivery-minimal-order">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Valor mínimo para frete grátis</div>
                            </div>
                            <input type="text" id="update-free-delivery-minimal-order-field" class="form-control" value="{{number_format($settings->free_delivery_minimal_order, 2, ',', '.')}}" name="free_delivery_minimal_order" placeholder="0,00" />
                            <div class="input-group-append">
                                <button type="button" id="update-free-delivery-minimal-order"  class="btn btn-primary btn-user">
                                    Redefinir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach($delivery_cities as $delivery_city)
                <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pontos de entrega em {{$delivery_city->city}}</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-store-delivery-points')}}">
                            @csrf
                            <input type="hidden" name="delivery_city_id" value="{{$delivery_city->id}}">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="input-group">
                                            <input type="text" name="district_{{$delivery_city->id}}" placeholder="Bairro ou ponto de entrega" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">R$</div>
                                            </div>
                                            <input type="text" class="delivery_tax" name="tax" placeholder="0,00" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('district_'.$delivery_city->id)
                                        <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </form>
                        <table class="db_delivery col-12">
                            <tbody>
                            @foreach($delivery_city->delivery_points as $delivery_point)
                                <tr  id="item_{{$delivery_point->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $delivery_point->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button" data-id="{{$delivery_point->id}}" data-district="{{$delivery_point->district}}" data-tax="{{number_format($delivery_point->tax, 2, ',', '.')}}"  class="editDelivery btn btn-{{  $delivery_point->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-target="#editDeliveryModal">
                                                <div class="text float-left" >{{$delivery_point->district}}</div>
                                                <div class="text small font-italic float-right" >R$ {{number_format($delivery_point->tax, 2, ',', '.')}}</div>
                                            </a>
                                            <a href="{{route('admin-delivery-points-change-visibility', $delivery_point->id)}}" role="button" class="btn btn-{{  $delivery_point->visible === true ? "primary":"secondary" }} btn-lg">
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
            @endforeach
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="editDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="editDeliveryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando ponto de entrega </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-update-delivery-points')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <input type="hidden" name="id" id="deliveryId">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="district" id="deliveryDistrict" placeholder="Bairro ou ponto de entrega" class="form-control" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <label>Valor&nbsp;&nbsp;</label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input type="text" id="deliveryTax" name="tax" placeholder="0,00" class="form-control">
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteDeliveryModal" class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editDeliveryCityModal" tabindex="-1" role="dialog" aria-labelledby="editDeliveryCityModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando cidade </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-update-delivery-cities')}}">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="id" id="deliveryCityId" value="">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="city" id="deliveryCityCity" placeholder="Cidade na área de cobertura" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteDeliveryCityModal"  type="button" class="btn btn-danger mr-auto">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir esta área de cobertura?</p>
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

    <div class="modal fade" id="deleteDeliveryCityModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir esta cidade?</p>
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
        $(function() {
            $(".delivery_tax").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#deliveryTax").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#update-free-delivery-minimal-order-field").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
        })
        $('table.db_delivery_city tbody').sortable({
            'containment': 'parent',
            'revert': true,
            helper: function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width());
                });
                return $helper;
            },
            'handle': '.handle',
            update: function(event, ui) {
                $.post('{{ route('admin-reposition-delivery-cities') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_delivery_city tr').css('min-width', $('table.db_delivery_city').width());
        });


        $('table.db_delivery tbody').sortable({
            'containment': 'parent',
            'revert': true,
            helper: function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width());
                });
                return $helper;
            },
            'handle': '.handle',
            update: function(event, ui) {
                $.post('{{ route('admin-reposition-delivery-points') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_delivery tr').css('min-width', $('table.db_delivery').width());
        });

        $(document).on("click", ".editDeliveryCity", function () {
            //Update Delivery points
            var city = $(this).data('city');
            var id = $(this).data('id');
            console.log(id);
            $(".modal-body #deliveryCityId").val( id );
            $(".modal-body #deliveryCityCity").val( city );
            $("#deleteDeliveryCityModal .modal-footer a").attr( 'href', '{{route('admin-delete-delivery-city')}}/'+id);

        });
        $(document).on("click", ".editDelivery", function () {
            //Update Delivery points
            var district = $(this).data('district');
            var tax = $(this).data('tax');
            var id = $(this).data('id');
            $(".modal-body #deliveryId").val( id );
            $(".modal-body #deliveryDistrict").val( district );
            $(".modal-body #deliveryTax").val( tax );
            $("#deleteDeliveryModal .modal-footer a").attr( 'href', '{{route('admin-delete-delivery')}}/'+id);
        });
        $( document ).ready(function() {
            $('#update-free-delivery-minimal-order').click(function(){
                let free_delivery_minimal_order = $('#form-update-free-delivery-minimal-order').serialize();
                $.post("{{route('admin-update-free-delivery')}}", free_delivery_minimal_order, function(data) {
                    $.alert({
                        title: 'Pedido mínimo para frete gratís alterado',
                        content: 'O novo pedido mínimo para frete grátis agora é: '+$('#update-free-delivery-minimal-order-field').val(),
                    });
                    return false;
                })
            })

            $('#delivery_change').bootstrapToggle("{{($settings->delivery=='true'?'on':'off')}}");
            $('#delivery_change').change(function() {
                if($(this).prop("checked") == true){
                    $.post( "{{route('admin-change-delivery')}}", {delivery: 'on'});
                }else{
                    $.post( "{{route('admin-change-delivery')}}", {delivery: 'off'});
                }

            });

            $('#free_delivery_change').bootstrapToggle("{{($settings->free_delivery=='true'?'on':'off')}}");
            $('#free_delivery_change').change(function() {
                if($(this).prop("checked") == true){
                    $.post( "{{route('admin-change-free-delivery')}}", {free_delivery: 'on'});
                }else{
                    $.post( "{{route('admin-change-free-delivery')}}", {free_delivery: 'off'});
                }

            });


            $('#pickup_change').bootstrapToggle("{{($settings->pickup=='true'?'on':'off')}}");
            $('#pickup_change').change(function() {
                if($(this).prop("checked") == true){
                    $.post( "{{route('admin-change-pickup')}}", {pickup: 'on'});
                }else{
                    $.post( "{{route('admin-change-pickup')}}", {pickup: 'off'});
                }

            });
        });
    </script>
@stop
