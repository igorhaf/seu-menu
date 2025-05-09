<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //if (strpos(php_sapi_name(), 'cli') === false) {
            $settings_array = DB::table('settings')->pluck('value', 'key');
            $settings = json_decode(json_encode($settings_array->all()), FALSE);
            View::share('settings', $settings);
        //}
    }
}
