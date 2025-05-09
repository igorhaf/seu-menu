<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryPoint extends Model
{


    public function delivery_cities()
    {
        return $this->hasOne('App\Models\DeliveryCity', 'id', 'delivery_city_id');
    }

    public function delivery_cities_visible()
    {
        return $this->hasOne('App\Models\DeliveryCity', 'id', 'delivery_city_id')->where('visible', true);
    }
}
