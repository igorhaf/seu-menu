<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    function getPaymentTypeNameAttribute()
    {
        switch ($this->payment_type){
            case 'money':
                return 'dinheiro';
                break;
            case 'pagseguro':
                return 'PagSeguro';
                break;
            case 'card_machine':
                return 'maquineta';
                break;
        }
    }

    protected $table = 'orders_delivery';
    protected $fillable = ["reference", "name", "cellphone", "payment_type", "payment_method", "money_change", "credit_card_flag", "pickup", "postal_code", "address", "number", "complement", "district", "city", "state", "status_id", "reference_point", "delivery_tax", "observations", "customer_id"];
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
    public function payment()
    {
        return $this->hasOne('App\Models\Payment', 'id', 'credit_card_flag');
    }
    public function order_products()
    {
        return $this->hasMany('App\Models\OrderProduct', 'orders_delivery_id', 'id');
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach($this->order_products as $order_item){
            $total = $total + $order_item->price;
                foreach ($order_item->orders_products_additionals as $order_additionals){
                    if(!empty($order_additionals->increase_value)) {
                        $total = $total + ($order_additionals->increase_value * $order_additionals->quantity) * $order_item->quantity;
                    }
                    if(!empty($order_additionals->decrease_value)){
                        $total = $total + ($order_additionals->decrease_value * $order_additionals->quantity) * $order_item->quantity;
                    }

            }

                foreach ($order_item->orders_products_variables as $order_variable){
                    if(!empty(OrderProductVariableOption::getOption($order_variable->id)->increase_value)) {
                        $total = $total + (OrderProductVariableOption::getOption($order_variable->id)->increase_value) * $order_item->quantity;
                    }
                    if(!empty(OrderProductVariableOption::getOption($order_variable->id)->decrease_value)){
                        $total = $total + (OrderProductVariableOption::getOption($order_variable->id)->decrease_value) * $order_item->quantity;
                    }

            }
        }
        return $total;
    }
}
