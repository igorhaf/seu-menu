

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Pisu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/fontawesome.all.min.css')}}">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/cardapio.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Poppins:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{asset('vendor/seumenu/img/page/favicon.png')}}"/>
    <title>Finalização de Pedido</title>

    <meta name="description" content="Seu cardápio online com pedidos!"/>
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Finalização de Pedido" />
    <meta property="og:description" content="Seu cardápio online com pedidos!" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Seu cardápio online com pedidos!" />
    <meta name="twitter:title" content="Checkout" />
    <style type="text/css">
        /*
*
* ==================================================
* FOR DEMO PURPOSES
* ==================================================
*
*/
        body {
            min-height: 100vh;
        }


        .bg-gradient-3 {
            background: #ff416c;
            background: -webkit-linear-gradient(to right, #ff416c, #ff4b2b);
            background: linear-gradient(to right, #ff416c, #ff4b2b);
        }


        .rounded {
            border-radius: 1rem !important;
        }
        /*
        *
        * ==================================================
        * UNNECESSARY STYLE - JUST TO MAKE IT LOOKS NICE
        * ==================================================
        *
        */
        .countdown {
            text-transform: uppercase;
            font-weight: bold;
        }

        .countdown span {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 3rem;
            margin-left: 0.8rem;
        }

        .countdown span:first-of-type {
            margin-left: 0;
        }

        .countdown-circles {
            text-transform: uppercase;
            font-weight: bold;
        }

        .countdown-circles span {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .countdown-circles span:first-of-type {
            margin-left: 0;
        }

        .border-container {
            width: 50px;
            display: inline-block;
        }
        .borderh {
            width: 50px; height: 1px;
            border: 1px solid #dee2e6!important;
        }

        .fa{
            color: #FF435F;
        }
        .icon-background {
            color: #FFF;
        }
        ul {
            padding:0px;
            margin:0px;
            list-style:none;
        }
        ul li {
            display: inline-block;
            /* visual do link */
            color: #333;
            text-decoration: none;
        }
        .opacity{
            opacity: 0.5;
        }
    </style>
</head>
<body>
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
<section class="boxConfirmacao">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="center">
                        <div class="py-5">
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <!-- Countdown 3-->
                                    <div id="delivery_card" class="rounded bg-gradient-3 text-white shadow p-5 text-center mb-5">
                                        <p id="delivery_msg">
                                            AGUARDANDO APROVAÇÃO DO PAGAMENTO
                                        </p>
                                        <ul>
                                            @if($order->payment_type == "pagseguro")
                                                <li>
                                                    <span class="fa-stack fa-2x stepone">
                                                        <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                                        <i class="fa fa-dollar-sign fa-stack-1x" id="steponeicon"></i>
                                                      </span>
                                                </li>
                                                <li>
                                                    <span class="border-container opacity stepone">
                                                      <div class="borderh" id="stepone"></div>
                                                    </span>
                                                </li>
                                            @endif
                                            <li>
                                                 <span class="fa-stack fa-2x opacity steptwo">
                                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fa fa-headset fa-stack-1x" id="steptwoicon"></i>
                                                  </span>
                                            </li>
                                            <li>
                                                <span class="border-container opacity steptwo">
                                                  <div class="borderh" id="steptwo"></div>
                                                </span>
                                            </li>
                                            <li>
                                                 <span class="fa-stack fa-2x opacity steptree">
                                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fa fa-utensils fa-stack-1x"></i>
                                                  </span>
                                            </li>
                                            <li>
                                                <span class="border-container opacity steptree">
                                                  <div class="borderh" id="steptree"></div>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="fa-stack fa-2x opacity stepfour">
                                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fa fa-motorcycle fa-stack-1x"></i>
                                                  </span>
                                            </li>
                                            <li>
                                                <span class="border-container opacity stepfour">
                                                  <div class="borderh" id="stepfour"></div>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="fa-stack fa-2x opacity stepfive">
                                                    <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fa fa-flag-checkered fa-stack-1x"></i>
                                                  </span>
                                            </li>
                                        </ul>
                                        <div id="clock" class="countdown pt-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div><!-- /center -->
                </div>
            </div>
        </div>
    </div>
</section>
</body>

<script src="{{asset('vendor/seumenu/js/jquery-3.4.0.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/mobile-detect.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.countdown.min.js')}}"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    @if(empty($order->status_id))
        @if($order->payment_type != "pagseguro")
            var step = 2;
        @else
            var step = 1;
        @endif
    @else
        var step = {{$order->status_id}};
    @endif


    $(document).ready(function() {

        steps()

        /* =========================================
               COUNTDOWN 1
            ========================================= */
        $('#clock').countdown('{{$prevision}}').on('update.countdown', function(event) {
            var $this = $(this).html(event.strftime(''
                + '<h4 style="color: white">Tempo estimado de entrega</h4>'
                + '<span class="h1 font-weight-bold">%H :</span>'
                + '<span class="h1 font-weight-bold">%M :</span>'
                + '<span class="h1 font-weight-bold">%S</span>'));
        });
    });


    Pusher.logToConsole = true;

    var pusher = new Pusher('dc48f15780a4a7d518eb', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('new-order');
    channel.bind('{{"order-$order->id"}}', function(data) {
        @if($order->payment_type != "pagseguro")
            switch (data['order_status']) {
                case 3:
                    step = 3;
                    break;
                case 4:
                    step = 4;
                    break;
                case 5:
                    step = 5;
                    break;
                case 6:
                    step = 6;
                    break;
                case 7:
                    step = 7;
                    break;
             }
        @else
            switch (data['order_status']) {
                case 2:
                    step = 2;
                    break;
                case 3:
                    step = 3;
                    break;
                case 4:
                    step = 4;
                    break;
                case 5:
                    step = 5;
                    break;
                case 6:
                    step = 6;
                    break;
                case 7:
                    step = 7;
                    break;
            }
        @endif
    });

    function steps(){
        @if($order->payment_type == "pagseguro")
            if(step == 1){
                $('#stepone').fadeIn( 500);
                $('#stepone').animate({width: "50px"}, { duration: 1000})
                    .fadeOut( 500)
                    .animate({width: "-50px"}, { duration: 1000, complete: steps})
            }
        @endif
        if(step == 2){
            @if($order->payment_type == "pagseguro")
                $('#stepone').show();
                $('#stepone').css('width', '50px');
                $('.stepone').removeClass('opacity');
            @endif
            $('#delivery_msg').html('AGUARDANDO APROVAÇÃO DO RESTAURANTE')
            $('#steptwo').fadeIn( 500);
            $('.steptwo').removeClass('opacity');
            $('#steptwo').animate({width: "50px"}, { duration: 1000})
                .fadeOut( 500)
                .animate({width: "-50px"}, { duration: 1000, complete: steps})
        }
        if(step == 3){
            $('#steptwo').show();
            $('#steptwo').css('width', '50px');
            $('#delivery_msg').html('SEU PEDIDO ESTÁ SENDO PREPARADO')
            $('#steptree').fadeIn( 500);
            $('.steptwo').removeClass('opacity');
            $('.steptree').removeClass('opacity');
            $('#steptree').animate({width: "50px"}, { duration: 1000})
                .fadeOut( 500)
                .animate({width: "-50px"}, { duration: 1000, complete: steps})
        }
        if(step == 4){
            $('#steptree').show();
            $('#steptree').css('width', '50px');
            $('#delivery_msg').html('SEU PEDIDO ESTÁ A CAMINHO')
            $('#stepfour').fadeIn( 500);
            $('.steptree').removeClass('opacity');
            $('.stepfour').removeClass('opacity');
            $('#stepfour').animate({width: "50px"}, { duration: 1000})
                .fadeOut( 500)
                .animate({width: "-50px"}, { duration: 1000, complete: steps})
        }
        if(step == 5){
            $('#stepfour').show();
            $('#stepfour').css('width', '50px');
            $('#delivery_msg').html('PEDIDO CONCLUÍDO')
            $('.steptwo').removeClass('opacity');
            $('.steptree').removeClass('opacity');
            $('.stepfour').removeClass('opacity');
            $('.stepfive').removeClass('opacity');
        }
        if(step == 6){
            @if($order->payment_type == "pagseguro")
                $('#stepone').show();
                $('#stepone').css('width', '50px');
            @endif
            $('#delivery_msg').html('O RESTAURANTE RECUSOU SEU PEDIDO')
            $('#steptwo').fadeIn( 500);
            $('#steptwoicon').removeClass('fa-headset');
            $('#steptwoicon').addClass('fa-times');
        }

        @if($order->payment_type == "pagseguro")
            if(step == 7){
                $('#delivery_msg').html('O PEDIDO FOI NEGADO PELO CARTÃO DE CRÉDITO, TENTE OUTRO CARTÃO')
                $('#stepone').show();
                $('#stepone').css('width', '50px');
                $('#steponeicon').removeClass('fa-dollar-sign');
                $('#steponeicon').addClass('fa-times');
            }
        @endif
    }

    // Enable pusher logging - don't include this in production

</script>
</html>
