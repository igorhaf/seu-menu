@extends('layouts.menu')

@section('content')

    <section class="filtros-header">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-12 filtro">
                    <div class="campoFiltro">
                        <select>
                            <option value="#inicio">Categorias</option>
                            @foreach($categories as $category)
                                <option value="#{{Str::slug($category->name)}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="busca">
                        <input type="text" name="search" id="search" placeholder="Pesquisar" autocomplete="off">
                        <button type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fixo -->
    <section class="filtros-header filtro-fixo" style="display:none">
        <div class="container"></div>
    </section>

    <!-- Menu Superior -->
    <div class="menu-superior">
        <div class="container">
            <ul>
                @foreach($categories as $category)
                    <li><a href="{{Str::slug($category->name)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @csrf
    <section class="lista-produtos" style=" z-index: 0;">
        <div class="lista-produtos_bg"></div>
        <div class="container">
        @foreach($categories as $category)
            <!-- inicio -->
                <div class="secaoCategoria" id="{{Str::slug($category->name)}}">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{$category->name}}</h3>
                        </div>
                        @if(!empty($category->photo))
                            <div class="col-12">
                                <img class="category-cover" src="{{$category->photo}}">
                            </div>
                        @endif
                    </div>
                    <ul>
                        @foreach($category->menu_itens_visible as $item)
                            <li class="product" data-sku="001" data-name="{{Str::slug($item->name)}}" data-description="{{Str::slug($item->description)}}" data-category="{{Str::slug($category->name)}}">
                                <div class="row">
                                    @if(!empty($item->photo))
                                        <div class="col-sm-2 col-3 col-lg-1 imagem-produto">
                                            <a style="background-image:url({{$item->photo}});" href="{{$item->photo}}" data-lightbox="{{$category->name}}" data-title="{{$category->name}}">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="col-{{!empty($item->photo)?'7':'8'}} col-sm-{{!empty($item->photo)?'4':'6'}} col-lg-{{!empty($item->photo)?'6':'7'}} align-self-center">
                                        <div class="row">
                                            <a href="#modal-product-{{$item->id}}" rel="modal:open" class="text-decoration-none modal-product-link">
                                                <div class="col-12 titulo">
                                                    <strong>{{$item->name}}</strong>
                                                </div>
                                                @if(!empty($item->description))
                                                    <div class="col-12 descricao">
                                                        {{$item->description}}
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-center">
                                        <div class="row">
                                            <div class="col-md-12 align-self-center">
                                                <span class="valor  float-right">R$ {{number_format($item->price, 2, ',', '.')}}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
    <section class="informacoes">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="box pagamentos">
                        @if(isset($settings->payment_method_money) && !empty($settings->payment_method_money) && $settings->payment_method_money == false)
                            <div class="alert-danger" style="text-align: center">No momento não estamos aceitando pagamento em dinheiro.</div>
                            <br />
                        @endif
                        <h3><i class="fas fa-credit-card"></i> Formas de Pagamento</h3>
                        <div class="row">
                            <div class=" col-lg-6">
                                <h4>Cartões de Débito</h4>
                                <ul>
                                    @foreach($payments['debit'] as $debit)
                                        <li>
                                            @if(!empty($debit->flag))
                                                <img width="32" height="21" src="{{$debit->flag}}" />
                                            @else
                                                <img width="32" height="21" src="{{asset('vendor/seumenu/img/money.png')}}" />
                                            @endif
                                            {{$debit->name}}
                                        </li>
                                    @endforeach
                                </ul>
                                <h4>Cartões de Crédito</h4>
                                <ul>
                                    @foreach($payments['credit'] as $credit)
                                        <li>
                                            @if(!empty($credit->flag))
                                                <img width="32" height="21" src="{{$credit->flag}}" />
                                            @else
                                                <img width="32" height="21" src="{{asset('vendor/seumenu/img/money.png')}}" />
                                            @endif
                                            {{$credit->name}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <h4>Vouchers</h4>
                                <ul>
                                    @foreach($payments['voucher'] as $voucher)
                                        <li>
                                            @if(!empty($voucher->flag))
                                                <img width="32" height="21" src="{{$voucher->flag}}" />
                                            @else
                                                <img width="32" height="21" src="{{asset('vendor/seumenu/img/money.png')}}" />
                                            @endif
                                            {{$voucher->name}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box horarios">
                        <h3><i class="fas fa-clock"></i> Horário de Atendimento</h3>
                        <ul>
                            @foreach($days_of_week as $key => $day_of_week)
                                @if(isset($day_of_week[3][0]))
                                    <li>
                                        <div class="row">
                                            <div style="{{((date('N')) == $key)?"font-weight: bold":''}}" class="col-6">{{$day_of_week[0]}}</div>
                                            <div style="{{((date('N')) ==$key)?"font-weight: bold":''}}" class="col-6 text-right">{{date('H:i', strtotime($day_of_week[3][0]->start_time))}}  às  {{date('H:i', strtotime($day_of_week[3][0]->end_time))}}</div>
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
    </section>
    <div class="botoes">
        <div class="container">
            <div class="botao pedir">
                @if($now_status[0]==false)
                    <a role="button" style="color: #fff; background-color: #545b62; border-color: #4e555b;" class="btn-secondary">
                        Estabelecimento fechado
                    </a>
                @else
                    <a style="padding-left: 130px;" href="{{route('web-cart')}}" role="button" id="confirmar-pedido">
                        Prosseguir com pedido <small style="text-transform: none;"> (Pedido mínimo: R$ {{$settings->minimal_order}})</small>
                        <i style="padding-right: 15px;" class="fa fa-shopping-cart fa-2x float-right"> R$ {{number_format((isset(auth()->guard('customers')->user()->id))?\Cart::session(auth()->guard('customers')->user()->id)->getTotal():0.00, 2, ',', '.')}}</i>
                    </a>

                @endif
            </div>
        </div>
    </div>
@endsection
