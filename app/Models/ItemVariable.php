<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVariable extends Model
{



    public function variable_options()
    {
        return $this->hasMany('App\Models\VariableOption')->orderBy('position', 'ASC');
    }

    public function variable_options_visible()
    {
        return $this->hasMany('App\Models\VariableOption')->orderBy('position', 'ASC')->where('visible', true);
    }


    public function menu_item()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_id');
    }

    public function menu_item_visible()
    {
        return $this->hasOne('App\Models\MenuItem', 'id', 'menu_item_id')->where('visible', true);
    }
}
