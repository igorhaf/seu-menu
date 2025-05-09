<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductAdditional extends Model
{


    protected $table = 'orders_products_additionals';

    public function item_additional()
    {
        return $this->hasOne('App\Models\ItemAdditional', 'id', 'item_additional_id');
    }
}
