<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariableOption extends Model
{
    public function item_variable()
    {
        return $this->hasOne('App\Models\ItemVariable', 'id', 'item_variable_id');
    }

    public function item_variable_visible()
    {
        return $this->hasOne('App\Models\ItemVariable', 'id', 'item_variable_id')->where('visible', true);
    }
}
