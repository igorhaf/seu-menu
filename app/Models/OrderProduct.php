<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{


    protected $table = 'orders_products';
    public function menu_item()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_id');
    }
    public function orders_products_combo()
    {
        return $this->hasMany('App\Models\OrderProductCombo', 'orders_products_id', 'id');
    }
    public function orders_products_additionals()
    {
        return $this->hasMany('App\Models\OrderProductAdditional', 'orders_products_id', 'id');
    }

    public function orders_products_variables()
    {
        return $this->hasMany('App\Models\OrderProductVariable', 'orders_products_id', 'id');
    }
}
