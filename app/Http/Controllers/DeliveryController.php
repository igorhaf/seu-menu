<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCity;
use App\Models\Setting;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $delivery_cities = DeliveryCity::orderBy('position', 'ASC')->get();
        return view('admin.delivery_points.index',compact( 'delivery_cities'));
    }

    public function updatePickup(Request $request){
        if($request->get('pickup') == 'on'){
            Setting::setConfig('pickup', true);
        }else{
            Setting::setConfig('pickup', false);
        }
    }

    public function updateDelivery(Request $request){
        if($request->get('delivery') == 'on'){
            Setting::setConfig('delivery', true);
        }else{
            Setting::setConfig('delivery', false);
        }
    }

    public function changeFreeDelivery(Request $request)
    {
        if($request->get('free_delivery') == 'on'){
            Setting::setConfig('free_delivery', 'true');
        }else{
            Setting::setConfig('free_delivery', 'false');
        }
    }

    public function updateFreeDelivery(Request $request)
    {
        $free_delivery_minimal_order = number_format(floatval($request->get('free_delivery_minimal_order')), 2, '.', ',');
        Setting::setConfig('free_delivery_minimal_order', $free_delivery_minimal_order);
    }
}
