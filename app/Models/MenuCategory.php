<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuCategory extends Model
{

    protected $appends = ['category_link'];

    public function getCategoryLinkAttribute()
    {
        return Str::slug($this->name);
    }

    public function menu_itens()
    {
        return $this->hasMany('App\Models\MenuItem')->orderBy('position', 'ASC');
    }

    public function menu_itens_visible()
    {
        return $this->hasMany('App\Models\MenuItem')->orderBy('position', 'ASC')->where('visible', true);
    }
}
