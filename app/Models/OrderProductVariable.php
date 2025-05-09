<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductVariable extends Model
{


    protected $table = 'orders_products_variable';

    public function item_variable()
    {
        return $this->hasOne('App\Models\ItemVariable', 'id', 'item_variable_id');
    }
}
