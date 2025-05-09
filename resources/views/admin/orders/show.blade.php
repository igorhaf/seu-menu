<h3 style="text-align: center">Dados para entrega</h3>
<hr/>
<p><strong>Nome do usuário:</strong> {{$order->customer->name}}</p>
<p><strong>Nome para entrega:</strong> {{$order->name}}</p>
<p><strong>Celular:</strong> {{$order->cellphone}}</p>
<p><strong>Endereço:</strong> {{$order->address}}</p>
<p>
    <strong>CEP:</strong> {{$order->postal_code}}
</p>
<p>
    <strong>Pornto de referência:</strong> {{$order->reference_point}}
</p>
<p>
    <strong>Cidade:</strong> {{$order->city}}
    <strong>Bairro:</strong> {{$order->district}}
</p>
<p>
    <strong>Número:</strong> {{$order->number}}
</p>
@if(!empty($order->complement))
    <p>
        <strong>Complemento:</strong> {{$order->complement}}
    </p>
@endif
<p></p>
<p><strong>Ponto de referência:</strong> {{$order->reference_point}}</p>
@if($order->payment_type == "money")
    <p><strong>Forma de pagamento:</strong> {{$order->payment_type_name}} <strong>Troco:</strong> {{($order->money_change)?$order->money_change:'sem troco'}}
@endif
@if($order->payment_type == "card_machine")
    <p><strong>Forma de pagamento:</strong> {{$order->payment->type_name}} - {{$order->payment->name}}
@endif
@if($order->payment_type == "pagseguro")
    <p><strong>Forma de pagamento:</strong> PagSeguro - {{$order->credit_card_flag}}
@endif
<h3 style="text-align: center">Dados do pedido</h3>
<hr/>

@foreach($order->order_products as $order_product)
    <table width="100%">
    <tr>
        <td><strong><p style="font-size: large">{{$order_product->menu_item->name}}</p></strong></td>
        <td width="20%"><strong>x{{$order_product->quantity}}</strong></td>
        <td width="20%"><strong>R$ {{number_format($order_product->price*$order_product->quantity, 2, ',', '.')}}</strong></td>
    </tr>
    @if($order_product->orders_products_combo->count() != 0)
            <tr>
                <td colspan="2"><strong>Itens do combo</strong></td>
            </tr>
        @foreach($order_product->orders_products_combo as $orders_product_combo)
                <tr>
                    <td>{{$orders_product_combo->combo_menu_item->name}}</td>
                    <td width="20%" colspan="2"><strong>x{{$orders_product_combo->quantity}}</td>
                </tr>
        @endforeach
    @endif
    @if($order_product->orders_products_variables->count() != 0)
            <tr>
                <td colspan="2"><strong>Opções obrigatórias</strong></td>
            </tr>
        @foreach($order_product->orders_products_variables as $orders_products_variable)
                <tr>
                    <td>{{$orders_products_variable->item_variable->variable}}</td>
                    <td width="20%">{{\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->variable_option->option}}</td>
                    @if(!empty(\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->increase_value) || !empty(\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->decrease_value))
                        @if(!empty(\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->increase_value))
                            <td width="20%">R$ {{number_format(\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->increase_value, 2, ',', '.')}}</td>
                        @endif
                        @if(!empty(\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->decrease_value))
                            <td width="20%">R$ {{number_format(\App\Models\OrderProductVariableOption::getOption($orders_products_variable->id)->decrease_value, 2, ',', '.')}}</td>
                        @endif
                    @else
                        <td width="20%"> </td>
                    @endif
                </tr>
        @endforeach
    @endif
    @if($order_product->orders_products_additionals->count() != 0)
        <tr>
            <td colspan="2"><strong>Adicionais</strong></td>
        </tr>
        @foreach($order_product->orders_products_additionals as $orders_products_additional)
                <tr>
                    <td>{{$orders_products_additional->item_additional->name}}</td>
                    <td width="20%"><strong>x{{$orders_products_additional->quantity}}</td>
                    @if(!empty($orders_products_additional->increase_value) || !empty($orders_products_additional->decrease_value))
                        @if(!empty($orders_products_additional->increase_value))
                            <td width="20%">R$ {{number_format($orders_products_additional->increase_value*$orders_products_additional->quantity, 2, ',', '.')}}</td>
                        @endif
                        @if(!empty($orders_products_additional->decrease_value))
                            <td width="20%">R$ {{number_format($orders_products_additional->decrease_value*$orders_products_additional->quantity, 2, ',', '.')}}</td>
                        @endif
                    @else
                        <td width="20%"> </td>
                    @endif

                </tr>
        @endforeach
    @endif

</table>
    <hr/>


@endforeach
<table width="100%">
    <tr>
        <td><p style="font-size: large">Subtotal:</p></td>
        <td width="20%"><strong><p>R$ {{number_format($order->total, 2, ',', '.')}}</p></strong></td>
    </tr>
</table>
<hr/>
<table width="100%">
    <tr>
        <td><strong><p>Entrega:</p></strong></td>
        <td width="20%"><strong><p>R$ {{number_format($order->delivery_tax, 2, ',', '.')}}</p></strong></td>
    </tr>
</table>
<hr/>
<table width="100%">
    <tr>
        <td><strong><p style="font-size: large">Total:</p></strong></td>
        <td width="20%"><strong><p style="font-size: large">R$ {{number_format($order->total+$order->delivery_tax, 2, ',', '.')}}</p></strong></td>
    </tr>
</table>


