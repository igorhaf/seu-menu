<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menu_categories = MenuCategory::orderBy('position', 'ASC')->get();
        return view('admin.menu.index',compact('menu_categories'));
    }
}
