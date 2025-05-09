<!DOCTYPE html>
<html lang="pt-br">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8"/>
    <title>{{$settings->name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/jquery-confirm.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/jquery-modal.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/cadapio.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Pacifico|Poppins:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{asset('vendor/seumenu/img/page/favicon.png')}}"/>
    <meta name="description" content="{{$settings->name}}, faça já seu pedido online via WhatsApp com nosso cardápio. Delivery prático e rápido!">
    <style>
        h1, h2, h3, h4, h5, h6{
        {{(isset($settings->titles_text_color) && !empty($settings->titles_text_color))?'color: #'.$settings->titles_text_color:'color: #000000'}};
        }
        section.lista-produtos h3:before {
        {{(isset($settings->titles_text_color) && !empty($settings->titles_text_color))?'background: #'.$settings->titles_text_color:'background: #000000'}};
        }
        body {
        {{(isset($settings->titles_text_color) && !empty($settings->titles_text_color))?'color: #'.$settings->titles_text_color:'color: #000000'}};
        }

        section.lista-produtos .descricao {
        {{(isset($settings->content_text_color) && !empty($settings->content_text_color))?'color: #'.$settings->content_text_color:'color: #666'}};
        }
        section.lista-produtos .valor {
        {{(isset($settings->prices_text_color) && !empty($settings->prices_text_color))?'color: #'.$settings->prices_text_color:'color: #008000'}};
        }
        .lista-produtos{
            position: relative;
            z-index: 5;
        {{(isset($settings->background_color) && !empty($settings->background_color))?'background-color: #'.$settings->background_color.';':'background-color: #f5f5f5;'}}
}
        .lista-produtos .lista-produtos_bg{
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
        {{(isset($settings->background_image) && !empty($settings->background_image))?'background-image: url('.$settings->background_image.'); background-size: 100%; background-repeat: no-repeat; background-attachment: fixed;':''}}
        {{(isset($settings->background_image_transparency) && !empty($settings->background_image_transparency))?'opacity: 0.'.$settings->background_image_transparency.';':'opacity: 1;'}}
}
        .header_menu {
            position: relative;
            z-index: 5;
        {{(isset($settings->header_color) && !empty($settings->header_color))?'background-color: #'.$settings->header_color.';':'background-color: #bbbbbb;'}};
        }
        .header_menu .header_menu_bg {
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
        {{(isset($settings->header) && !empty($settings->header))?'background-image: url('.$settings->header.'); background-size: 100%; background-repeat: no-repeat;':''}}
        {{(isset($settings->header_image_transparency) && !empty($settings->header_image_transparency))?'opacity: 0.'.$settings->header_image_transparency.';':'opacity: 1;'}}

}
        header .logo {
        {{((isset($settings->background_image) && !empty($settings->background_image) && $settings->logo_style == 'circle')?'border-radius: 110px;':'border-radius: 4px;')}}
}
        .filtros-header{
        {{(isset($settings->search_bar_background_color) && !empty($settings->search_bar_background_color))?'background: #'.$settings->search_bar_background_color.' !important;':''}}
        {{(isset($settings->search_bar_text_color) && !empty($settings->search_bar_text_color))?'color: #'.$settings->search_bar_text_color.';':''}}
}

        .filtros-header input::placeholder{
        {{(isset($settings->search_bar_text_color) && !empty($settings->search_bar_text_color))?'color: #'.$settings->search_bar_text_color.';':''}}
}
        .filtros-header .fas{
        {{(isset($settings->search_bar_text_color) && !empty($settings->search_bar_text_color))?'color: #'.$settings->search_bar_text_color.';':''}}
}
        .campoFiltro select option {
        {{(isset($settings->search_bar_text_color) && !empty($settings->search_bar_text_color))?'color: #'.$settings->search_bar_text_color.';':''}}
}

        .campoFiltro select{
        {{(isset($settings->search_bar_text_color) && !empty($settings->search_bar_text_color))?'color: #'.$settings->search_bar_text_color.' !important;':''}}
}
        .informacoes{
        {{(isset($settings->footer_background_color) && !empty($settings->footer_background_color))?'background: #'.$settings->footer_background_color.' !important;':''}}
}
        .horarios, .horarios h3, .horarios h3 i::before, .horarios h4{
        {{(isset($settings->schedule_text_color) && !empty($settings->schedule_text_color))?'color: #'.$settings->schedule_text_color.';':''}}
        {{(isset($settings->schedule_background_color) && !empty($settings->schedule_background_color))?'background: #'.$settings->schedule_background_color.' !important;':''}}
}
        .pagamentos, .pagamentos h3, .pagamentos h3 i::before, .pagamentos h4{
        {{(isset($settings->payment_text_color) && !empty($settings->payment_text_color))?'color: #'.$settings->payment_text_color.';':''}}
        {{(isset($settings->payment_background_color) && !empty($settings->payment_background_color))?'background: #'.$settings->payment_background_color.' !important;':''}}
}
    </style>

</head>
<body class="home blog">

<div id="cardapio">
    @if ( session()->has('info') )
        <div class="alert alert-info alert-dismissable text-center">{{ session()->get('info') }}</div>
    @endif
    @if ( session()->has('error') )
        <div class="alert alert-danger alert-dismissable text-center">{{ session()->get('error') }}</div>
    @endif
    @if ( session()->has('warning') )
        <div class="alert alert-warning alert-dismissable text-center">{{ session()->get('warning') }}</div>
    @endif
    <div class="menu-mobile">
        <a href="//{{env('MENU_DOMAIN')}}" class="logo" style="border: 5px solid #ffffff; background-color: #3A3A3A">
            <img src="{{$settings->logo}}">
        </a>
        <ul>
            @foreach($categories as $category)
                <li><a href="#{{Str::slug($category->name)}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="barra-topo" style="background-color: {{(!empty($settings->top_color)?'#'.$settings->top_color:'#848383')}}; !important;">
        <div class="container">
            <span style="color: {{(!empty($settings->top_text_color)?'#'.$settings->top_text_color:'#ffffff')}}; !important">
                @if(isset($settings->whatsapp_number) && !empty($settings->whatsapp_number))
                    <a href="https://api.whatsapp.com/send?phone={{$settings->whatsapp_number}}" target="_blank"><i style="padding-right: 15px; {{(!empty($settings->top_text_color)?'color: #'.$settings->top_text_color:'color: #ffffff')}};" class="fab fa-whatsapp fa-2x"></i></a>
                @endif
                @if(isset($settings->instagram) && !empty($settings->instagram))
                    <a href="http://www.instagram.com/{{$settings->instagram}}" target="_blank" ><i style="padding-right: 15px;  {{(!empty($settings->top_text_color)?'color: #'.$settings->top_text_color:'color: #ffffff')}};" class="fab fa-instagram fa-2x"></i></a>
                @endif
                @if(isset($settings->facebook) && !empty($settings->facebook))
                    <a href="http://www.facebook.com/{{$settings->facebook}}" target="_blank" ><i style="padding-right: 15px;  {{(!empty($settings->top_text_color)?'color: #'.$settings->top_text_color:'color: #ffffff')}};" class="fab fa-facebook fa-2x"></i></a>
                @endif
                @if(!empty($settings->google_map))
                    <a style="color: {{(!empty($settings->top_text_color)?'#'.$settings->top_text_color:'#ffffff')}}; !important" href="https://goo.gl/maps/{{$settings->google_map}}" target="_blank">
                        <i class="fas fa-map-marker-alt"></i>
                        {{$settings->address}}, {{$settings->district}}
                        - {{$settings->city}}
                        / {{$settings->state}}
                    </a>
                @else
                    <i class="fas fa-map-marker-alt"></i>
                    {{$settings->address}}, {{$settings->district}}
                    - {{$settings->city}}
                    / {{$settings->state}}
                @endif
                @if(!empty(auth()->guard('customers')->user()->name))
                    <div style="float:right; color: #0a0302;" class="dropdown">
                      <button class="btn btn-light dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Bem vindo(a) <b>{{current(explode(' ',auth()->guard('customers')->user()->name))}}</b>
                        </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('web-logout')}}">Sair</a>
                      </div>
                    </div>
                @else
                    @if(config('tenant.social_login'))
                        <a href="#modal-login" rel="modal:open" style="float:right;" class="btn btn-light">
                          Faça <b>login</b> ou <b>cadastre-se</b>!
                        </a>
                    @else
                        <a href="#modal-form" rel="modal:open" style="float:right;" class="btn btn-light">
                            Faça <b>login</b> ou <b>cadastre-se</b>!
                        </a>
                    @endif
                @endif
            </span>
        </div>
    </div>
    <header class="header_menu">
        <div class="header_menu_bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <a id="logo_img" href="//{{env('MENU_DOMAIN')}}" class="logo"  style="border: 5px solid {{(!empty($settings->logo_border_color)?'#'.$settings->logo_border_color:'#848383')}}; {{(!empty($settings->logo_background_color)?'background-color: #'.$settings->logo_background_color:'background-color: #ffffff')}}">
                        <img src="{{$settings->logo}}" alt="{{$settings->name}}" title="{{$settings->name}}">
                    </a>
                </div>
                <div class="col-lg-9 col-md-8 col-6 dados">
                    <h2 style="{{(!empty($settings->header_text_color)?'color: #'.$settings->header_text_color:'color: #ffffff')}}"></h2>
                    <h1 style="{{(!empty($settings->header_text_color)?'color: #'.$settings->header_text_color:'color: #ffffff')}}">{{$settings->name}}</h1>
                    <div class="telefones">
                        @if((isset($settings->phone) && !empty($settings->phone)))
                            <a href="tel:{{$settings->phone}}" class="fixo">
                                <i class="fas fa-phone-volume" style="{{(!empty($settings->header_text_color)?'color: #'.$settings->header_text_color:'color: #ffffff')}}"></i>
                                <span style="{{(!empty($settings->header_text_color)?'color: #'.$settings->header_text_color:'color: #ffffff')}}">{{$settings->phone}}</span>
                            </a>
                        @endif
                        <a href="tel:{{$settings->whatsapp_number}}" class="celular">
                            <i class="fas fa-mobile-alt" style="{{(!empty($settings->header_text_color)?'color: #'.$settings->header_text_color:'color: #ffffff')}}"></i>
                            <span style="{{(!empty($settings->header_text_color)?'color: #'.$settings->header_text_color:'color: #ffffff')}}">{{$settings->whatsapp_number}}</span>
                        </a>
                    </div>
                </div>
                <div class="horario-atendimento"  style="float: right" >
                    @if($settings->free_delivery=='true')
                    <div class="row">
                        <div class="col-md-8 col-sm-2" style="
                                font-size: 13px;
                                color: green;
                                font-weight: bold;
                                margin-top: 33px;
                                margin-left: -32px;
                            ">
                            @if($settings->free_delivery_minimal_order != '0.00')
                            Frete grátis para pedidos acima de R$ {{number_format($settings->free_delivery_minimal_order, 2, ',', '.')}}
                            @else
                                Frete grátis para todos os pedidos!
                                @endif
                        </div>
                        <div class="col-md-4">
                            <p class="btn pull-right">
                                <span>
                                    <i class="fas fa-clock"></i>
                                    <strong style="{{($now_status[0]==false)?'color: red':""}}">{{($now_status[0]==false)?'Fechado':"Aberto"}}</strong>
                                    @if($now_status[0]==true)
                                </span>das {{date('H:i', strtotime($now_status[1]['start_time']))}} às {{date('H:i', strtotime($now_status[1]['end_time']))}} <i class="fas fa-angle-down"></i>
                                @endif
                            </p>
                        </div>

                    </div>
                    @else
                        <div class="col-md-4">
                            <p class="btn pull-right">
                                <span>
                                    <i class="fas fa-clock"></i>
                                    <strong style="{{($now_status[0]==false)?'color: red':""}}">{{($now_status[0]==false)?'Fechado':"Aberto"}}</strong>
                                    @if($now_status[0]==true)
                                </span>das {{date('H:i', strtotime($now_status[1]['start_time']))}} às {{date('H:i', strtotime($now_status[1]['end_time']))}} <i class="fas fa-angle-down"></i>
                                @endif
                            </p>
                        </div>
                    @endif

                    <div class="box-horarios" style="display:none">
                        <ul>
                            @foreach($days_of_week as $key => $day_of_week)
                                @if(isset($day_of_week[3][0]))
                                    <li>
                                        <div class="row">
                                            <div style="{{((date('N')) == $key)?"font-weight: bold":''}}" class="col-6">{{$day_of_week[0]}}</div>
                                            <div style="{{((date('N')) == $key)?"font-weight: bold":''}}" class="col-6 text-right">{{date('H:i', strtotime($day_of_week[3][0]->start_time))}}  às  {{date('H:i', strtotime($day_of_week[3][0]->end_time))}}</div>
                                            @foreach($day_of_week[3] as $key2 => $schedule)
                                                @if($key2 != 0)
                                                    <div class="col-6"></div>
                                                    <div style="{{((date('N')) == $key)?"font-weight: bold":''}}" class="col-6 text-right">{{date('H:i', strtotime($schedule->start_time))}}  às  {{date('H:i', strtotime($schedule->end_time))}}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
</div>
<!-- Modal HTML embedded directly into document -->
@if(config('tenant.social_login'))
    <div id="modal-login" class="modal" style="overflow: visible;">

        <div class="container">
            <h3 style="text-align: center">Cadastre-se!</h3>
            <ul class="sign-up-option">
                <li>
                    <a class="btn btn-lg btn-social btn-facebook" style="color: white;">
                        <i class="fab fa-facebook fa-fw"></i>
                        <span>Cadastrar com o Facebook</span>
                    </a>
                </li>
                <li>
                    <a class="btn btn-lg btn-social btn-google" style="color: white;">
                        <i class="fab fa-google fa-fw"></i>
                        <span>Cadastrar com o Google</span>
                    </a>
                </li>
                <li>
                    <a href="#modal-form-signup" rel="modal:open" class="btn btn-lg btn-social btn-email" style="color: white;">
                        <i class="fa fa-envelope fa-fw"></i>
                        <span>Cadastrar com o e-mail e senha</span>
                    </a>
                </li>
            </ul>
        </div>
        <div style="text-align: center;">
            <a href="#modal-form" rel="modal:open" class="text-decoration-none" >
                Já possui uma conta? <strong>Clique aqui para entrar</strong>
            </a>
            <a href="#modal-recovery" rel="modal:open" class="text-decoration-none" >
                <p class="text-center"> Esqueceu a senha?</p>
            </a>
        </div>
    </div>
@endif
<div id="modal-recovery" class="modal" style="overflow: visible;">
    <div class="container">
        <div class="card">
            <article class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Recuperar senha.</h4>
                <hr>
                <form method="POST" action="{{route('web-reset-request')}}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Email" type="email">
                        </div> <!-- input-group.// -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Enviar email de recuperação </button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</div>
@if(isset(request()->route()->parameters['token']) && !empty(request()->route()->parameters['token']))
    <div id="modal-reset-password" class="modal" style="overflow: visible;">
        <div class="container">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1">Cadastre uma nova senha.</h4>
                    <hr>
                    <form method="POST" action="{{route('web-reset-password')}}">
                        @csrf
                        <input name="token" value="{{request()->route()->parameters['token']}}" type="hidden" />
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="email" class="form-control" placeholder="Email" type="email">
                            </div> <!-- input-group.// -->
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input name="password" class="form-control" placeholder="Senha" type="password">
                            </div> <!-- input-group.// -->
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input name="password_confirmation" class="form-control" placeholder="Confirme a sua senha" type="password">
                            </div> <!-- input-group.// -->
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Enviar </button>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
@endif
@foreach($itens as $item)
    <div id="modal-product-{{$item->id}}" class="modal modalComplexo" style="overflow: visible;">
        <div class="container">
            <div class="box">
                <div class="header">
                </div>
                <form method="post" class="body modalItemForm" action="{{route('web-add-cart')}}">
                    <input type="hidden" name="menu_item_id" value="{{$item->id}}">
                @csrf
                    <div class="nomeProduto">
                        <h3 class="price">R$ {{number_format($item->price, 2, ',', '.')}}</h3>
                        <h3>{{$item->name}}</h3>
                        <p>{{$item->description}}</p>
                    </div>
                    @foreach($item->item_variable_visible as $variables)
                        <div class="group" id="variable-{{$variables->id}}" data-min-qtt="1" data-max-qtt="1" data-name="variable-{{$variables->id}}">
                            <div class="title">
                                <span class="required">Obrigatório</span>
                                <h4>{{$variables->variable}}</h4>

                            </div>
                            <div class="row selected_qtt">
                                <div class="col-12">
                                    Você deve selecionar
                                    <span class="green">1</span> opção.

                                    <br>Você selecionou <span class="qtt green">0</span>.
                                </div>
                            </div>
                            <input type="hidden" name="variable[]" value="{{$variables->id}}">
                            @foreach($variables->variable_options_visible as $variables_options)
                                <div class="option">
                                    <div class="row">
                                        <div class="col-7 align-self-center">
                                            <h5>{{$variables_options->option}}</h5>
                                            <small>{{(!empty($variables_options->increase_value))?'R$ +'.number_format($variables_options->increase_value, 2, ',', '.'):((!empty($variables_options->decrease_value))?'R$ -'.number_format($variables_options->decrease_value, 2):'')}}</small>
                                        </div>
                                        <div class="col-5 align-self-center text-right">
                                            <div class="checkbox">
                                                <input type="checkbox" name="option[]" class="option-qtt" value="{{$variables_options->id}}" id="option-{{$variables_options->id}}" data-variableid="{{$variables->id}}" data-name="{{$variables_options->option}}" data-decrease="{{(!empty($variables_options->decrease_value))?$variables_options->decrease_value:0.00}}" data-increase="{{(!empty($variables_options->increase_value))?$variables_options->increase_value:0.00}}" data-itemid="{{$item->id}}">
                                                <label for="option-{{$variables_options->id}}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    @if($item->item_additional_visible->count() != 0)
                        <div class="group" data-min-qtt="0" data-max-qtt="0">
                            <div class="title">
                                <h4>Adicionais</h4>
                            </div>
                            @foreach($item->item_additional_visible as $additional)
                                <div class="option">
                                    <div class="row">
                                        <div class="col-7 align-self-center">
                                            <h5>{{$additional->name}}</h5>
                                            <small>{{(!empty($additional->increase_value))?'R$ +'.number_format($additional->increase_value, 2, ',', '.'):((!empty($additional->decrease_value))?'R$ -'.number_format($additional->decrease_value, 2):'')}}</small>
                                        </div>
                                        <div class="col-5 align-self-center text-right">
                                            <input type="hidden" name="additional_item[]" value="{{$additional->id}}" id="additional-{{$additional->id}}">
                                            <input type="number" class="additional" name="additional[]" value="0"  min="0" step="1" data-decrease="{{(!empty($additional->decrease_value))?$additional->decrease_value:0.00}}" data-increase="{{(!empty($additional->increase_value))?$additional->increase_value:0.00}}" data-itemid="{{$item->id}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($item->combo_visible->count() != 0 && !empty($item->combo_limit))
                        <div class="group combo" data-combo-min-qtt="{{$item->combo_limit}}" data-combo-max-qtt="{{$item->combo_limit}}" data-name="-">
                            <div class="title">
                                <span class="required">Obrigatório</span>
                                <h4>Monte seu combo</h4>
                            </div>
                            <div class="row selected_qtt">
                                <div class="col-12">
                                    Você deve selecionar
                                    <span class="green">{{$item->combo_limit}}</span> opções.
                                    <br>Você selecionou <span class="qtt green">0</span>.
                                </div>
                            </div>
                            @foreach($item->combo_visible as $combo)
                                <div class="option">
                                    <div class="row">
                                        <div class="col-7 align-self-center">
                                            <h5>{{$combo->menu_item->name}}</h5>
                                        </div>
                                        <div class="col-5 align-self-center text-right">
                                            <input type="hidden" name="combo_menu_item[]" value="{{$combo->combo_menu_item_id}}">
                                            <input type="hidden" name="combo_item[]" value="{{$combo->id}}">
                                            @if(!empty($combo->min) && empty($combo->max))
                                                <input type="number" class="combo_qtt" name="combo_qtt[]" data-keep-min="true" data-keep-max="false" data-original-min="{{$combo->min}}" value="0" data-itemid="{{$combo->id}}" data-combo-max-limit="{{$item->combo_limit}}" max="{{$item->combo_limit}}" min="{{$combo->min}}" step="1">
                                                <p style="font-size:10px; color: #c32c31"><strong>(Mínimo de {{$combo->min}} itens)</strong></p>
                                            @endif
                                            @if(!empty($combo->max) && empty($combo->min))
                                                <input type="number" class="combo_qtt" name="combo_qtt[]" data-keep-min="false" data-keep-max="true" data-original-max="{{$combo->max}}" data-itemid="{{$combo->id}}" data-combo-max-limit="{{$item->combo_limit}}" max="{{$combo->max}}" value="0" min="0" step="1">
                                                <p style="font-size:10px; color: #c32c31"><strong>(Máximo de {{$combo->max}} itens)</strong></p>
                                            @endif
                                            @if(!empty($combo->max) && !empty($combo->min))
                                                <input type="number" class="combo_qtt" name="combo_qtt[]" data-keep-max="true" data-keep-min="true" data-original-max="{{$combo->max}}" data-original-min="{{$combo->min}}"  data-itemid="{{$combo->id}}" data-combo-max-limit="{{$item->combo_limit}}" max="{{$combo->max}}" value="{{$combo->min}}" min="{{$combo->min}}" step="1">
                                                <p style="font-size:10px; color: #c32c31"><strong>(Mínimo de {{$combo->min}} e máximo de {{$combo->max}} itens)</strong></p>
                                            @endif
                                            @if(empty($combo->max) && empty($combo->min))
                                                <input type="number" class="combo_qtt" name="combo_qtt[]" data-keep-max="false" data-keep-min="false"  data-itemid="{{$combo->id}}" data-combo-max-limit="{{$item->combo_limit}}" max="{{$item->combo_limit}}" value="0" min="0" step="1">
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="footer">
                        <div class="right">
                            <div class="row">
                                <div class="col-5">
                                    <input type="number" name="product_order_qtt" class="product_order_qtt" value="1" min="1" step="1" data-itemid="{{$item->id}}">
                                    <input name="product_order_subtotal" type="hidden" value="{{$item->price}}" >
                                </div>
                                <div class="col-7 confirmar">
                                    <button type="submit" class="adicionar">Adicionar<br>R$ <span>{{number_format($item->price, 2, ',', '.')}}</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<div id="modal-form" class="modal" style="overflow: visible;">
    <div class="container">
        <div class="card">
            <article class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Entre com sua conta.</h4>
                <hr>
                <form method="post" action="{{route('web-login')}}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Email" type="email">
                        </div> <!-- input-group.// -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password" class="form-control" placeholder="******" type="password">
                        </div> <!-- input-group.// -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Entrar  </button>
                    </div>
                    <a href="#modal-form-signup" rel="modal:open" class="text-decoration-none">
                        <p class="text-center">
                            <i class="fa fa-envelope fa-fw"></i>
                            <span>Cadastrar uma nova conta</span>
                        </p>
                    </a>
                    <a href="#modal-recovery" rel="modal:open" class="text-decoration-none">
                        <p class="text-center"> Esqueceu a senha?</p>
                    </a>
                </form>
            </article>
        </div>
    </div>
</div>
<div id="modal-form-signup" class="modal" style="overflow: visible;">
    <div class="container">
        <div class="card">
            <article class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Cadastre-se.</h4>
                <hr>
                <form method="post" action="{{route('web-register')}}">
                    @csrf
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="name" class="form-control" placeholder="Nome Completo" type="text" />
                    </div>

                    <div class="form-group input-group">
                        <input name="cpf" id="cpf" class="form-control" placeholder="CPF" type="text">
                        <input name="birthday" id="birthday" class="form-control" placeholder="Nascimento" type="text">
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email address" type="email" />
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone-volume"></i> </span>
                        </div>
                        <input name="cellphone" id="cellphone" class="form-control" placeholder="Celular" type="text" />
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="password" class="form-control" placeholder="Senha" type="password" />
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="password_confirmation" class="form-control" placeholder="Confirme a senha" type="password" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Criar conta  </button>
                    </div>
                    <div style="text-align: center;">
                        <a href="#modal-form" rel="modal:open" class="text-decoration-none" >
                            Já possui uma conta? <strong>Clique aqui para entrar</strong>
                        </a>
                    </div>
                </form>
            </article>
        </div>
    </div>
</div>
<!-- Link to open the modal -->
<br /><br />
<script type="application/javascript">
    var url = "{{env('PROTOCOL').'://'.env('MENU_DOMAIN')}}";
</script>
<script src="{{asset('vendor/seumenu/js/jquery-3.4.0.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.mask.min.js')}}"></script>
<script type="application/javascript">
    $(document).ready(function(){
        $("#cpf").mask("999.999.999-99");
        $("#birthday").mask("99/99/9999");
        $('#cellphone').mask('(00) 0000-00009');
        $('#cellphone').blur(function(event) {
            if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $('#cellphone').mask('(00) 00000-0009');
            } else {
                $('#cellphone').mask('(00) 0000-00009');
            }
        });
        $( '.modal-product-link' ).click(function(){
            let combo_total = 0;
            let product_link = $(this).attr('href')
            $(product_link+' .combo_qtt').each(function(){
                if(typeof $(this).attr('max') != "undefined"){
                    combo_total += parseInt($(this).val())
                }
            })
            $(product_link+' .combo_qtt').each(function(){
                if(typeof $(this).attr('max') != "undefined"){
                    if($(this).data('keep-max') != true) {
                        $(this).attr('max', parseInt($(this).data('combo-max-limit')) - combo_total)
                    }
                    if($(this).data('keep-min') == true && $(this).data('keep-max') != true) {
                        $(this).attr('max', (parseInt($(this).data('combo-max-limit')) - combo_total)+parseInt($(this).val()))
                    }
                }
            })
            $('.combo > .selected_qtt > div > .qtt').text(combo_total)
        })
        /**/
        $('#confirmar-pedido').click(function(){
            if({{number_format((isset(auth()->guard('customers')->user()->id))?\Cart::session(auth()->guard('customers')->user()->id)->getTotal():0.00, 2, ',', '.')}} == 0.00){
                $.alert({
                    title: 'Carrinho vazio',
                    content: 'É necessário escolher pelo menos um item',
                });
                return false
            }
            if(parseFloat({{$settings->minimal_order}}) > parseFloat({{number_format((isset(auth()->guard('customers')->user()->id))?\Cart::session(auth()->guard('customers')->user()->id)->getTotal():0.00, 2, ',', '.')}})){
                $.alert({
                    title: 'Pedido mínimo',
                    content: 'O pedido mínimo para este restaurante é de R$ {{$settings->minimal_order}}',
                });
                return false
            }
        })
        $('.modalItemForm').submit(function() {
            let checked = true
            $(this).find('div[id^="variable-"]').each(function(){
                checked = false
                $(this).find('.option-qtt').each(function (){
                    if($(this).is(':checked'))
                    {
                        checked = true
                    }
                })
                if(checked === false){
                    return false
                }
            })
            if(checked === false){
                $.alert({
                    title: 'Item(s) obrigatório(s)!',
                    content: 'Faltou marcar alguma opção obrigatória?',
                });
                return false
            }
            let combo_total = 0
            $(this).find('.combo_qtt').each(function(){
                if(typeof $(this).attr('max') != "undefined"){
                    combo_total += parseInt($(this).val())
                }
            })
            if(combo_total > $(this).find('.combo').data('combo-max-qtt')){
                $.alert({
                    title: 'Combo!',
                    content: 'Seu combo está acima do permitido',
                });
                return false
            }
            if(combo_total < $(this).find('.combo').data('combo-min-qtt')){
                $.alert({
                    title: 'Combo!',
                    content: 'Escolha todos os items do seu combo',
                });
                return false
            }
        });
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    });
    function calcPrice(item_id, variableid = null)
    {
        let new_value = 0;

        let original_price = $('#modal-product-' + item_id + ' input[name=product_order_subtotal]').val();
        $('#modal-product-' + item_id + ' .confirmar > button > span').text(parseFloat(original_price).toFixed(2).replace('.', ','))
        new_value = parseFloat(original_price.replace(',', '.')) * $('#modal-product-' + item_id + ' .product_order_qtt').val()

        let increase = 0
        let decrease = 0
        let selected = false;
        let product_order_qtt = $('#modal-product-' + item_id + ' .product_order_qtt').val()
        $('#modal-product-' + item_id + ' .option-qtt').each(function (){
            if($(this).is(':checked'))
            {
                if(variableid != null) {
                    selected = true
                }
                let value_string = $('#modal-product-' + item_id + ' .confirmar > button > span').text()
                if ($(this).data('increase') != 0 || $(this).data('decrease') != 0) {
                    if ($(this).data('increase') != 0) {
                        increase = $(this).data('increase')+increase
                        new_value = (parseFloat(value_string.replace(',', '.')) * product_order_qtt) + parseFloat(increase) *  product_order_qtt
                    }
                    if ($(this).data('decrease') != 0) {
                        decrease = $(this).data('decrease')+decrease
                        new_value = (parseFloat(value_string.replace(',', '.')) * product_order_qtt) - parseFloat(decrease) *  product_order_qtt
                    }
                }
            }
        })

        if(variableid != null){
            if(!$('#variable-'+variableid+' .option-qtt').is(':checked')){
                selected = false
            }
            if(selected === true) {
                $('#variable-'+variableid+' .selected_qtt > div > .qtt').text('1')
            }else {
                $('#variable-' + variableid + ' .selected_qtt > div > .qtt').text('0')
            }
        }

        $('#modal-product-' + item_id + ' .additional').each(function (){
            if (typeof $(this).data('increase') != "undefined" || typeof $(this).data('decrease') != "undefined"){
                if ($(this).data('increase') != 0) {
                    let increase = $(this).data('increase')
                    let additionals = (increase * $(this).val()) * product_order_qtt;
                    new_value = parseFloat(new_value) + additionals
                }
                if ($(this).data('decrease') != 0) {
                    let decrease = $(this).data('decrease')
                    let additionals = (decrease * $(this).val()) * product_order_qtt;
                    new_value = parseFloat(new_value) - additionals
                }
            }
        })
        $('#modal-product-' + item_id + ' .confirmar > button > span').text((new_value).toFixed(2).toString().replace('.', ','))
    }
    $('.option-qtt').bind("change", function() {
        let  data_min = $('#variable-'+$(this).data('variableid')).data('min-qtt')
        let  data_max = $('#variable-'+$(this).data('variableid')).data('max-qtt')

        if(data_max == 1 && data_min == 1){
            $('#variable-'+$(this).data('variableid')+' .option-qtt').not(this).prop('checked', false);
        }
        calcPrice($(this).data('itemid'), $(this).data('variableid'))
    });
    $('.additional').bind("change", function() {
        calcPrice($(this).data('itemid'))
    });

    $('.product_order_qtt').bind("change", function() {

        calcPrice($(this).data('itemid'))
    });


    $('.combo_qtt').bind("change", function() {
        let combo_status = 0
        $('.combo > .selected_qtt > div > .qtt').text(0)

        $('.combo_qtt').each(function(){
            if(typeof $(this).attr('max') != "undefined"){
                combo_status += parseInt($(this).val())
            }
        })

        $('.combo_qtt').each(function(){
            if(typeof $(this).attr('max') != "undefined") {
                // || parseInt($(this).val()) >= combo_status
                    if($(this).data('combo-max-limit')-combo_status >= 0 && $(this).data('combo-max-limit') >= combo_status){

                        if ($(this).data('keep-max') == false && $(this).data('keep-min') == false) {
                            if ($(this).parent() != $(this)){
                                $(this).attr('max', (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val()))
                            }
                        }
                        if ($(this).data('keep-max') == true && $(this).data('keep-min') == true) {
                            if ($(this).parent() != $(this)){
                                if ($(this).data('original-max') >= (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val())){
                                    $(this).attr('max', (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val()))
                                }else{
                                    $(this).attr('max', $(this).data('original-max'))
                                }
                            }
                        }
                        if ($(this).data('keep-max') == false && $(this).data('keep-min') == true ) {
                            if ($(this).parent() != $(this)){
                                if ($(this).data('original-min') <= (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val())){
                                    $(this).attr('max', (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val()))
                                }else{
                                    $(this).attr('max', $(this).data('original-max'))
                                }
                            }
                        }
                        if ($(this).data('keep-max') == true && $(this).data('keep-min') == false) {

                            if ($(this).parent() != $(this)){
                                if ($(this).data('original-max') >= (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val())){
                                    $(this).attr('max', (parseInt($(this).data('combo-max-limit')) - combo_status)+parseInt($(this).val()))
                                }else{
                                    $(this).attr('max', $(this).data('original-max'))
                                }
                            }
                        }
                    }
            }
        })

        $('.combo > .selected_qtt > div > .qtt').text(combo_status)
    });

    //$('#combo-'.$(this).data('itemid'))
</script>
@if(isset(request()->route()->parameters['token']) && !empty(request()->route()->parameters['token']))
    <script>
        $(document).ready(function(){
            $("#modal-reset-password").modal('show');
        });
    </script>
@endif
<script src="{{asset('vendor/seumenu/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/lightbox.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.modal.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/slidereveal.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/popper.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-scrollspy.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/currency.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/mobile-detect.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/common.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/options-groups.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/cardapio.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/pedido.js')}}"></script>
</body>
</html>
