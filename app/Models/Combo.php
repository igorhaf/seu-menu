<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{

    public function menu_item()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'combo_menu_item_id');
    }

    public function menu_item_visible()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'combo_menu_item_id')->where('visible', true);
    }
}
