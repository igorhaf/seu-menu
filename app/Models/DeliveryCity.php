<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCity extends Model
{


    public function delivery_points()
    {
        return $this->hasMany('App\Models\DeliveryPoint')->orderBy('position', 'ASC');
    }
    public function delivery_points_visible()
    {
        return $this->hasMany('App\Models\DeliveryPoint')->where('visible', true)->orderBy('position', 'ASC');
    }
}
