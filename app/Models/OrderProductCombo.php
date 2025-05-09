<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductCombo extends Model
{
    protected $table = 'orders_products_combo';
    public function combo_menu_item()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'combo_menu_item_id');
    }
}
