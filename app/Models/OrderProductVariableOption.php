<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductVariableOption extends Model
{


    protected $table = 'orders_products_variable_options';

    static public function getOption($orders_products_variable_id)
    {
        $order_option = self::where('orders_products_variable_id', $orders_products_variable_id)->first();
        return $order_option;
    }
    public function variable_option()
    {
        return $this->hasOne('App\Models\VariableOption', 'id', 'variable_option_id');
    }
}
