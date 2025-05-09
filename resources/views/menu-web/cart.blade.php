<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/html">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8"/>
    <title>Pisu Sushi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/fontawesome.all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/jquery-confirm.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/cardapio.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Poppins:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{asset('vendor/seumenu/img/page/favicon.png')}}"/>
</head>
<body class="home blog">
<input type="hidden" value="14981422715" id="whatsapp-phone">
<!-- Header Confirmação -->
<section class="headerConfirmacao">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row">
                    <div class="col-md-2 col-4">
                        <div class="box-logo" style="background: #3A3A3A;">
                                <img src="{{asset('/img/logo-pisu.jpg')}}" alt="Pisu">
                        </div>
                    </div>
                    <div class="col-md-10 col-8">
                        <a href="/" id="voltar-cardapio" class="voltar">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Box Confirmação -->
<div id="confirmacao"  class="container-fluid">
    <form id="onepage_checkoutform" method="POST" action="{{route('web-send')}}">
        @csrf
        <div class="container">
            <section id="confirmacao-pedido" class="boxConfirmacao">
                <div class="row">

                    <div class="col-12">
                        <div class="center">

                            <!-- info entrega -->
                            <div class="infoEntregaConfirmacao">

                                <h3 class="title">Informações para Entrega</h3>
                                <div class="dados-usuario">
                                    <div class="row">
                                        <div class="col-6 nome campo">
                                            <input type="text" id="name" name="name" value="{{auth()->guard('customers')->user()->name}}" placeholder="Quem irá recerber a encomenda.">
                                        </div>
                                        <div class="col-6 celular campo">
                                            <input type="text" id="phone" name="cellphone" value="{{auth()->guard('customers')->user()->cellphone}}" placeholder="Celular" class="mobile">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="seleciona">
                                      <div class="box">
                                          <a id="entrega" data-open="entrega" class="ativo"><i class="fas fa-motorcycle"></i> Entrega</a>

                                          <a id="retirada" data-open="retirada"><i class="fas fa-hotel"></i> Retirar no Local</a>
                                    </div>
                                </div> --}}
                                <!-- Dados Entrega -->
                                <div id="entrega" class="formEntrega">
                                    <div class="row">
                                        <div class="col-md-3 cep campo">
                                            <input type="text" id="zip_code" name="zip_code" placeholder="CEP" class="cep">
                                        </div>
                                        <div class="col-md-7 col-6 endereco campo">
                                            <input type="text" id="address" name="address" placeholder="Endereço" maxlength="100">
                                        </div>
                                        <div class="col-md-2 col-6 numero campo">
                                            <input type="text" id="number" name="number" placeholder="Nº" maxlength="10">
                                        </div>
                                        <input type="hidden" id="city" name="city" value="">
                                        <input type="hidden" id="state" name="state" value="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 complemento campo">
                                            <input type="text" id="complement" name="complement" placeholder="Complemento (Ex: Bloco/Apto)" maxlength="100">
                                        </div>
                                        <div class="col-md-4 col-6 bairro campo">
                                            <select name="district" id="district">
                                                <option selected disabled hidden>Bairro</option>
                                                @foreach($delivery_districts as $delivery_district)
                                                    <option data-district-id="{{$delivery_district->id}}" data-tax="{{$delivery_district->tax}}" value="{{$delivery_district->district}}">{{$delivery_district->district}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6 ref campo">
                                            <input type="text" id="reference" name="reference" placeholder="Ponto de Ref." maxlength="100">
                                        </div>
                                    </div>
                                    <div class="alert alert-warning" style="display:none;">
                                        <i class="fas fa-exclamation-triangle"></i> Campos Obrigatórios.
                                    </div>
                                    <!-- Alerta após sair do número -->
                                    <div class="alert alert-primary alerta-complemento" style="display:none">
                                        <i class="fas fa-exclamation-triangle"></i> Não esqueça de informar o <strong>complemento de endereço</strong> se houver.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Retirada -->
                                <div id="retirada" class="formEntrega" style="display: none">
                                    <div class="card login retirada">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Endereço para Retirada</h5>
                                            <p>
                                                <i class="fas fa-map-marker-alt"></i> <strong>
                                                    Rua Alcides Zloccowick, Pina - Recife / Pernambuco
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/><br/>
                            <!-- lista-itens -->
                            <div class="lista-itens">
                                <h3 class="title">Confirmação de Pedido</h3>
                                <table id="tbl-confirmacao-pedido" class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%"><strong>Produto</strong></th>
                                        <th class="text-center" style="width: 20%"><strong>Valor Unitário</strong></th>
                                        <th class="text-center" style="width: 20%"><strong>Qtd.</strong></th>
                                        <th class="text-center" style="width: 20%"><strong>Remover</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($itens as $key => $item)

                                        <tr>
                                            @if($item->associatedModel->getTable() == 'menu_itens')
                                                <td style="width: 50%"><strong>{{$item->name}}</strong>
                                                    @foreach($item->attributes as $key => $combo_item)
                                                        @if($combo_item['item_qtt'] != 0)
                                                            @if($loop->first)<span>(</span>@endif
                                                            {{$combo_item['item_qtt']}}x {{$combo_item['item_name']}}
                                                            @if(!$loop->last),@endif
                                                            @if($loop->last)<span>)</span>@endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @else
                                                <td style="width: 50%"> - {{$item->name}}</td>
                                            @endif
                                                <td class="text-center" style="width: 20%">R$ {{number_format($item->price, 2, ',', '.')}}</td>
                                                <td class="text-center" style="width: 20%">{{$item->quantity}}</td>
                                                @if($item->associatedModel->getTable() == 'variable_options')
                                                    <td class="text-center" style="width: 20%; color: grey"><div><i class="fa fa-trash"></i></div></td>
                                                @else
                                                    <td class="text-center" style="width: 20%; color: darkred"><a href="{{route('web-remove-cart', $item->id)}}"><i class="fa fa-trash"></i></a></td>
                                                @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="obsConfirmacao">
                                    <label class="text-center">Observações</label>
                                    <input type="text" id="obsConfirmacao" name="obsConfirmacao" placeholder="Detalhes do Pedido">
                                </div>

                                <!-- Taxa de entrega (Valor informado ou Consulte) -->
                                <div class="valoresConfirmacao">
                                    <div class="right text-right">
                                        <div id="pedido-subtotal" class="box" style="">
                                            <span>Subtotal</span>
                                            <strong id="pedido-subtotal-valor">R$ {{number_format((isset(auth()->guard('customers')->user()->id))?\Cart::session(auth()->guard('customers')->user()->id)->getTotal():0.00, 2, ',', '.')}}</strong>
                                        </div>
                                        <div id="pedido-taxa-entrega" class="box margin" style="">
                                            <span>Taxa de Entrega</span>
                                            @if($settings->free_delivery == 'true')
                                                @if(\Cart::session(auth()->guard('customers')->user()->id)->getTotal() < floatval($settings->free_delivery_minimal_order))
                                                <strong id="pedido-taxa-entrega-valor">Consulte</strong>
                                                @else
                                                <strong style="color: green" id="pedido-taxa-entrega-valor">Grátis</strong>
                                                @endif
                                            @else
                                                <strong id="pedido-taxa-entrega-valor">Consulte</strong>
                                            @endif

                                            <input type="hidden" name="delivery_tax" id="delivery_tax" value="0.00" />
                                        </div>
                                        <div class="box total">
                                            <span>Total</span>
                                            <strong id="pedido-total-valor">R$ {{number_format((isset(auth()->guard('customers')->user()->id))?\Cart::session(auth()->guard('customers')->user()->id)->getTotal():0.00, 2, ',', '.')}}</strong>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="pagamentoConfirmacao" class="pagamentoConfirmacao">
                                <h3 class="title">Formas de Pagamento</h3>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box">
                                            <input type="radio" class="pagamento" name="pagamento" id="maquininha" value="card_machine">
                                            <label for="maquininha">Trazer a Máquininha</label>
                                            <div class="secundario bandeirasMaq animated sladeInDown faster" style="display:none">
                                                <p><i class="fas fa-credit-card"></i> Bandeira:</p>
                                                <select name="card_type" id="selecaoBandeiraMaq" class="form-control">
                                                    <option value="">Selecione</option>
                                                    @foreach($payments as $payment)
                                                        <option value="{{$payment->id}}">{{$payment->type_name}} - {{$payment->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">
                                            <input type="radio" class="pagamento" name="pagamento" id="aplicativo" value="pagseguro">
                                            <label for="aplicativo">Pagar pelo aplicativo</label>
                                            <div class="secundario bandeirasApp animated sladeInDown faster" style="display:none">
                                                <p><i class="fas fa-key"></i> Seus dados não serão salvos</p>
                                                <input type="hidden" name="senderHash" id="senderHash" />
                                                <input type="hidden" name="creditCardToken" id="creditCardToken" value="">
                                                <input type="hidden" name="brand" id="brand" value="">
                                                <div class="input-group" style="padding-bottom: 10px">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text rounded-right" ><i class="fa fa-credit-card"></i></span>
                                                    </div>
                                                    <input type="text" id="pagseguro_cc_card_num" class="form-control border-right-0 pagseguro_cc_card_num" placeholder="Número do cartão">
                                                </div>
                                                <div class="row" style="padding-bottom: 10px">
                                                    <div class="col-6">
                                                        <input type="text" style="width: 100%;" id="pagseguro_cc_exp_date" class="form-control pagseguro_cc_exp_date" placeholder="Validade">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" style="width: 100%;" class="form-control pagseguro_cc_card_code" placeholder="CCV">
                                                    </div>
                                                </div>
                                                <input type="text" style="width: 100%;" class="form-control pagseguro_cc_card_name" name="creditCardHolderName" placeholder="Nome impresso no cartão">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">
                                            <input type="radio" class="pagamento" name="pagamento" id="dinheiro" value="money">
                                            <label for="dinheiro">Dinheiro</label>
                                            <div class="secundario troco slideInDown faster" style="display:none">
                                                <p><i class="fas fa-money-bill-alt"></i> Troco para:</p>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">R$</div>
                                                    </div>
                                                    <input type="money" id="change" name="change" placeholder="Ex: 100,00" class="form-control price">
                                                </div>
                                                <div class="input-group box-sem-troco">
                                                    <input type="checkbox" name="no_change" id="no-change">
                                                    <label for="no-change">Sem troco</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /center -->
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <div class="center">
                            <div class="text-center">
                                <div class="align-content-center">
                                    <a onclick="pagseguroCheckout()" class="btn btn-success btn-lg btn-block align-self-center">
                                        Concluir Pedido
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

<script src="{{asset('vendor/seumenu/js/jquery-3.4.0.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.mask.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/slidereveal.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/popper.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-scrollspy.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/mobile-detect.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/currency.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/common.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/pedido.js')}}"></script>
<script type="text/javascript" src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
<script>

    function pagseguroCheckout() {
        if($('#aplicativo').is(':checked')) {
            var senderHash = PagSeguroDirectPayment.getSenderHash();
            $("input[name='senderHash']").val(senderHash);
            if ($("input[name='creditCardToken']").val().length == 0) {
                if ($('.pagseguro_cc_exp_date').val()) {
                    var split = $('.pagseguro_cc_exp_date').val().toString().split("/");
                }
                var param = {
                    brand: $("input[name='brand']").val(),
                    cardNumber: $('.pagseguro_cc_card_num').val(),
                    cvv: $('.pagseguro_cc_card_code').val(),
                    expirationMonth: split[0],
                    expirationYear: split[1],
                    success: function (response) {
                        $("input[name='creditCardToken']").val(response.card.token);
                        console.log($("input[name='creditCardToken']").val())
                        $('#onepage_checkoutform').trigger('submit');
                    },
                    error: function (response) {
                        $.alert({
                            title: 'Cartão de crédito inválido.',
                            content: 'Cartão de crédito inválido. Não conseguimos processar seu pedido.',
                        });
                        return false;
                    }
                }
                PagSeguroDirectPayment.createCardToken(param);
            }
        }else{
            $('#onepage_checkoutform').trigger('submit');
        }
    }

    function pagseguroValidateCard (element, bypassLengthTest) {
        $("input[name='creditCardToken']").val('');
        var cardNum = $(element).val().replace(/[^\d.]/g, '');
        if (cardNum.length >= 6) {
            PagSeguroDirectPayment.getBrand({
                cardBin: cardNum.substr(0, 6),
                success: function(response) {
                    if (typeof response.brand.name != 'undefined') {
                        $("input[name='brand']").val(response.brand.name);
                    }else{
                        $.alert({
                            title: 'Cartão de crédito inválido.',
                            content: 'Validamos os primeiros 6 números do seu cartão de crédito e está inválido. Por favor esvazie o campo e tente digitar de novo.',
                        });
                        return false;
                    }
                },
                error: function(response) {
                    $.alert({
                        title: 'Cartão de crédito inválido.',
                        content: 'Validamos os primeiros 6 números do seu cartão de crédito e está inválido. Por favor esvazie o campo e tente digitar de novo.',
                    });
                    return false;
                }});
        }
    }
    $(document).ready(function(){
        $('#pagseguro_cc_exp_date').mask('00/0000');
        $('#pagseguro_cc_card_num').mask('0000 0000 0000 0000');
        $('.pagamento').prop('checked', false);
        $('#zip_code').on('blur', function(){
            if($.trim($("#zip_code").val()) != ""){
                $("#address").val('(Aguarde, consultando CEP ...)');
                $.getScript("/getcep?formato=javascript&cep="+$("#zip_code").val(), function(){
                    if(resultadoCEP["resultado"]){
                        $("#address").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                        $("#district").val(unescape(resultadoCEP["bairro"]));
                        $("#city").val(unescape(resultadoCEP["cidade"]));
                        $("#state").val(unescape(resultadoCEP["uf"]));

                        if(typeof $('#district').find(':selected').data('tax') != 'undefined'){
                            @if($settings->free_delivery == 'false' || \Cart::session(auth()->guard('customers')->user()->id)->getTotal() < floatval($settings->free_delivery_minimal_order))
                                let delivery_tax = $('#district').find(':selected').data('tax').toFixed(2)
                                $('#delivery_tax').val(delivery_tax)
                                $('#pedido-taxa-entrega-valor').text('R$ '+delivery_tax.replace('.', ','))
                                delivery_tax = (parseFloat(delivery_tax)+{{\Cart::session(auth()->guard('customers')->user()->id)->getTotal()}}).toFixed(2)
                                $('#pedido-total-valor').text('R$ '+ delivery_tax.replace('.', ','))
                            @endif
                        }else{
                            $.alert({
                                title: 'CEP',
                                content: 'Ainda não temos entrega para este CEP',
                            });
                            return false;
                        }

                    }else{
                        $.alert({
                            title: 'CEP',
                            content: 'Ainda não temos entrega para este CEP',
                        });
                        return false;
                    }
                });
            }
        });
        $('#district').bind('change', function(){
            $('#pedido-taxa-entrega-valor').text('R$ '+(parseFloat($(this).find(':selected').data('tax'))).toFixed(2).replace('.', ','))
            $('#delivery_tax').val((parseFloat($(this).find(':selected').data('tax'))).toFixed(2))
        })
        //pedido-taxa-entrega
        PagSeguroDirectPayment.setSessionId("{{ PagSeguro::startSession() }}");
        $('.pagseguro_cc_card_num').keyup(function(){
            pagseguroValidateCard(this, false);
        });
        $('.pagseguro_cc_card_num').focusout(function(){
            pagseguroValidateCard(this, true);
        });
        $('#no-change').change(function(){
            $('#change').val('')
        })

    });
    $('#onepage_checkoutform').submit(function(){
        if( !$(this).find('#name').val() ) {
            $.alert({
                title: 'Nome',
                content: 'É preciso definir quem irá receber o pedido',
            });
            return false;
        }
        if( !$(this).find('#phone').val() ) {
            $.alert({
                title: 'Telefone do portador',
                content: 'É preciso definir telefone',
            });
            return false;
        }
        if( $(this).find('#phone').val().length < 14 ||  $(this).find('#phone').val().length > 15) {
            $.alert({
                title: 'Telefone do portador',
                content: 'Digite um telefone válido',
            });
            return false;
        }
        if( !$(this).find('#zip_code').val() ) {
            $.alert({
                title: 'CEP',
                content: 'É preciso informar um CEP para a entrega',
            });
            return false;
        }
        if( !$(this).find('#address').val() ) {
            $.alert({
                title: 'Endereço',
                content: 'É preciso informar um endereço para a entrega',
            });
            return false;
        }
        if( !$(this).find('#district').val() ) {
            $.alert({
                title: 'Bairro',
                content: 'É preciso informar um bairro para a entrega',
            });
            return false;
        }
        if( !$(this).find('#reference').val() ) {
            $.alert({
                title: 'Ponto de referência',
                content: 'É preciso informar uma referência para a entrega',
            });
            return false;
        }
        var iz_checked = false;
        $(".pagamento").each(function(){
            if($(this).is(':checked')){
                iz_checked = true
            }
        });
        if ( ! iz_checked ){
            $.alert({
                title: 'Metôdo de pagamento',
                content: 'É preciso informar um metôdo de pagamento',
            });
            return false;
        }
        if($('#maquininha').is(':checked')){
            if( !$('#selecaoBandeiraMaq').val() ) {
                $.alert({
                    title: 'Cartão',
                    content: 'Selecione qual o tipo de cartão que será utilizado no pagamento na entrega',
                });
                return false;
            }
        }
        if($('#dinheiro').is(':checked')){

            if( !$('#change').val() ) {
                if(!$('#no-change').is(':checked')) {
                    $.alert({
                        title: 'Troco',
                        content: 'Para pagamentos em dinheiro é necessario informar o troco, caso não precise, marque a opção "Sem troco"',
                    });
                    return false;
                }

            }
            if(!$('#no-change').is(':checked')) {
                let delivery_tax = $('#district').find(':selected').data('tax').toFixed(2)
                let total_delivery = (parseFloat(delivery_tax)+{{\Cart::session(auth()->guard('customers')->user()->id)->getTotal()}}).toFixed(2)
                let change_money = parseFloat($('#change').val().replace(',', '.')).toFixed(2)
                if(parseFloat(total_delivery) > parseFloat(change_money)){
                    $.alert({
                        title: 'Troco',
                        content: 'O valor informádo para o troco é menor que o total do pedido',
                    });
                    return false;
                }
            }
        }
        if($('#aplicativo').is(':checked')) {
            if( !$('.pagseguro_cc_card_num').val() ) {
                $.alert({
                    title: 'Dados do cartão inválidos',
                    content: 'Informe o numero do cartão',
                });
                return false;
            };
            if( !$('.pagseguro_cc_exp_date').val() ) {
                $.alert({
                    title: 'Dados do cartão inválidos',
                    content: 'Informe o mês e ano de validade do cartão',
                });
                return false;
            };
            if( !$('.pagseguro_cc_card_code').val() ) {
                $.alert({
                    title: 'Dados do cartão inválidos',
                    content: 'Informe o código verificador do cartão',
                });
                return false;
            };
            if( !$('.pagseguro_cc_card_name').val() ) {
                $.alert({
                    title: 'Dados do cartão inválidos',
                    content: 'Informe o nome impresso no cartão',
                });
                return false;
            };
        }
    })
</script>
</body>
</html>
