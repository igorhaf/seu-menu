@extends('layouts.admin')

@section('content')
    <p class="help-block">Clique no nome para editar um método de pagamento. Arraste com o <i class="fas fa-arrows-alt"></i> para reordenar, ou use o <i class="fas fa-power-off"></i> para ativar ou desativar.</p>

    <div class="row">

        <div class="col-lg-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Métodos de pagamento</h1>
                <div class="form-group" style="margin-top: 20px">
                    <label>Dinheiro</label>
                    <input type="checkbox" id="payment_method_money" name="payment_method_money"  data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Crédito</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-store-payment')}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="hidden" name="type" value="credit">
                                            <input type="text" name="name_credit" placeholder="Método de pagamento" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                        @error('name_credit')
                                        <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_payment_credit col-12">
                            <tbody>
                            @foreach($payments['credit'] as $payments_credit)
                                <tr  id="item_{{$payments_credit->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $payments_credit->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button"  data-id="{{$payments_credit->id}}" data-name="{{$payments_credit->name}}" data-type="{{$payments_credit->type}}"  class="editPayment btn btn-{{  $payments_credit->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-target="#editPaymentModal">
                                                <div class="text float-left" >{{$payments_credit->name}}</div>
                                            </a>
                                            <a href="{{route('admin-change-visibility-payment', $payments_credit->id)}}" role="button" class="btn btn-{{  $payments_credit->visible === true ? "primary":"secondary" }} btn-lg">
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
        <div class="col-lg-4" style="padding-top: 40px;">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><br></h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Débito</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-store-payment')}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="hidden" name="type" value="debit">
                                            <input type="text" name="name_debit" placeholder="Método de pagamento" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                        @error('name_debit')
                                        <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_payment_debit col-12">
                            <tbody>
                            @foreach($payments['debit'] as $payments_debit)
                                <tr  id="item_{{$payments_debit->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $payments_debit->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button" data-id="{{$payments_debit->id}}" data-name="{{$payments_debit->name}}" data-type="{{$payments_debit->type}}" class="editPayment btn btn-{{  $payments_debit->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-target="#editPaymentModal">
                                                <div class="text float-left" >{{$payments_debit->name}}</div>
                                            </a>
                                            <a href="{{route('admin-change-visibility-payment', $payments_debit->id)}}" role="button" class="btn btn-{{  $payments_debit->visible === true ? "primary":"secondary" }} btn-lg">
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
        <div class="col-lg-4" style="padding-top: 40px;">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><br></h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vale</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-store-payment')}}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="hidden" name="type" value="voucher">
                                            <input type="text" name="name_voucher" placeholder="Método de pagamento" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                        @error('name_voucher')
                                        <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_payment_voucher col-12">
                            <tbody>
                            @foreach($payments['voucher'] as $payments_voucher)
                                <tr  id="item_{{$payments_voucher->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $payments_voucher->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button"  data-id="{{$payments_voucher->id}}" data-name="{{$payments_voucher->name}}" data-type="{{$payments_voucher->type}}" class="editPayment btn btn-{{  $payments_voucher->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-target="#editPaymentModal">
                                                <div class="text float-left" >{{$payments_voucher->name}}</div>
                                            </a>
                                            <a href="{{route('admin-change-visibility-payment', $payments_voucher->id)}}" role="button" class="btn btn-{{  $payments_voucher->visible === true ? "primary":"secondary" }} btn-lg">
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
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando pagamento </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin-update-payment')}}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <input type="hidden" name="id" id="paymentId">
                                <div class="form-group">
                                    <input type="text" placeholder="Método de pagamento"  name="name" id="paymentName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Categoria:</label>
                                    <select name="type" id="paymentType" class="form-control">
                                        <option value="credit">Credito</option>
                                        <option value="debit">Debito</option>
                                        <option value="voucher">Voucher</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-1" style="padding-top: 30px">
                                        <div id="flagFile"  style="padding-top: 0.25rem !important; cursor: pointer;" class="shadow bg-white rounded text-center">
                                            <i class="far fa-image fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <div class="form-group">
                                            <label>Bandeira</label>
                                            <div class="custom-file">
                                                <input type="file" name="flag" id="customFileLang" class="custom-file-input flag-file" lang="es">
                                                <label class="custom-file-label" for="customFileLang">Selecione uma imagem</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deletePaymentModal"  class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePaymentModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir este método de pagamento?</p>
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
        $( document ).ready(function() {
            $('#payment_method_money').bootstrapToggle("{{(isset($settings->payment_method_money) && $settings->payment_method_money==true)?'on':'off'}}");
            $('#payment_method_money').change(function() {
                if($(this).prop("checked") == true){
                    $.post( "{{route('admin-change-accept-money')}}", {payment_method_money: 'on'});
                }else{
                    $.post( "{{route('admin-change-accept-money')}}", {payment_method_money: 'off'});
                }

            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#flagFile').html("<img src='"+e.target.result+"' width='32' height='21' />");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".flag-file").change(function() {
            readURL(this);
        });
        $('#customFileLang').on('change',function(){
            //get the file name
            var fileName = document.getElementById("customFileLang").files[0].name; ;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#flagFile').click(function(){
            $('#customFileLang').trigger('click');
        });
        $('table.db_payment_debit tbody').sortable({
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
                $.post('{{ route('payment-debit-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_payment_voucher tr').css('min-width', $('table.db_payment_voucher').width());
        });


        //payment debit

        $('table.db_payment_voucher tbody').sortable({
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
                $.post('{{ route('payment-voucher-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_payment_voucher tr').css('min-width', $('table.db_payment_voucher').width());
        });

        $('table.db_payment_credit tbody').sortable({
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
                $.post('{{ route('payment-credit-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_payment_debit tr').css('min-width', $('table.db_payment_debit').width());
        });
        $(document).on("click", ".editPayment", function () {
            //Update Delivery points
            var id = $(this).data('id');
            var name = $(this).data('name');
            var type = $(this).data('type');
            $("#deletePaymentModal .modal-footer a").attr( 'href', '{{route('admin-delete-menu-payment')}}/'+id);
            $(".modal-body #paymentId").val( id );
            $(".modal-body #paymentName").val( name );
            $(".modal-body #paymentType").val( type );
        });
    </script>
@stop
