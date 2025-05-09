<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderDelivery;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $order_pendings = OrderDelivery::where('status_id', '2')->orderBy('id', 'DESC')->paginate(20);
        $order_accepteds = OrderDelivery::where('status_id', '3')->orderBy('id', 'DESC')->paginate(20);
        $order_sents = OrderDelivery::where('status_id', '4')->orderBy('id', 'DESC')->paginate(20);
        $order_dones = OrderDelivery::where('status_id', '5')->orderBy('id', 'DESC')->paginate(20);
        return view('admin.orders.index',compact('order_pendings', 'order_accepteds', 'order_sents', 'order_dones'));
    }

    public function updatePickup(Request $request)
    {
        if($request->get('pickup') == 'on'){
            Setting::setConfig('pickup', 'true');
        }else{
            Setting::setConfig('pickup', 'false');
        }
    }

    public function updateDelivery(Request $request)
    {
        if($request->get('delivery') == 'on'){
            Setting::setConfig('delivery', 'true');
        }else{
            Setting::setConfig('delivery', 'false');
        }
    }

    public function updateFreeDelivery(Request $request)
    {
        if($request->get('free_delivery') == 'on'){
            Setting::setConfig('free_delivery', 'true');
        }else{
            Setting::setConfig('free_delivery', 'false');
        }
    }

    public function show($id)
    {
        $order = OrderDelivery::find($id);
        return view('admin.orders.show',compact('order'));
    }
    public function rejected($id){
        $order = OrderDelivery::find($id);
        $order->status_id = 6;
        $order->save();
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new \Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('new-order', "order-$order->id", array('order_status' => 6));
        return redirect(route('admin-order-index'));

    }
    public function accepted($id){
        $order = OrderDelivery::find($id);
        $order->status_id = 3;
        $order->save();
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new \Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('new-order', "order-$order->id", array('order_status' => 3));
        return redirect(route('admin-order-index'));
    }
    public function sent($id){
        $order = OrderDelivery::find($id);
        $order->status_id = 4;
        $order->save();
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new \Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('new-order', "order-$order->id", array('order_status' => 4));
        return redirect(route('admin-order-index'));
    }
    public function delivered($id){
        $order = OrderDelivery::find($id);
        $order->status_id = 5;
        $order->save();
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new \Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('new-order', "order-$order->id", array('order_status' => 5));
        return redirect(route('admin-order-index'));
    }
}
