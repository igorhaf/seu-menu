<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    protected $table = 'menu_itens';

    public function category()
    {
        return $this->hasOne('App\Models\MenuCategory', 'id', 'menu_category_id');
    }

    public function category_visible()
    {
        return $this->hasOne('App\Models\MenuCategory', 'id', 'menu_category_id')->where('visible', true);
    }


    public function item_variable()
    {
        return $this->hasMany('App\Models\ItemVariable');
    }

    public function item_variable_visible()
    {
        return $this->hasMany('App\Models\ItemVariable')->where('visible', true);
    }

    public function item_additional()
    {
        return $this->hasMany('App\Models\ItemAdditional');
    }

    public function item_additional_visible()
    {
        return $this->hasMany('App\Models\ItemAdditional')->where('visible', true);
    }

    public function combo()
    {
        return $this->hasMany('App\Models\Combo');
    }

    public function combo_visible()
    {
        return $this->hasMany('App\Models\Combo')->where('visible', true);
    }
}
