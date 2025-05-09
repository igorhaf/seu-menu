<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCity;
use App\Models\DeliveryPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DeliveryCitiesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'city' => 'required',
            ],
            [
                'city.required' => 'É preciso definir um nome para a cidade',
            ]
        );
        $latest = DeliveryCity::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $delivery_city = new DeliveryCity();
        $delivery_city->city = $request->get('city');
        $delivery_city->position = $latest_id;
        $delivery_city->save();
        return redirect(route('admin-delivery-points'));
    }

    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = \App\DeliveryCity::find($id);
                $item->position = $i;
                $item->save();
            }
            return Response::json(array('success' => true));
        }
        else
        {
            return Response::json(array('success' => false));
        }
    }

    public function changeVisibility($id){
        $item = DeliveryCity::find($id);
        if($item->visible == true){
            $item->visible = false;
            $delivery_points = DeliveryPoint::where('delivery_city_id', $item->id)->get();
            foreach ($delivery_points as $dp){
                $delivery_point = DeliveryPoint::find($dp->id);
                $delivery_point->visible = false;
                $delivery_point->save();
            }
        }else{
            $item->visible = true;
            $delivery_points = DeliveryPoint::where('delivery_city_id', $item->id)->get();
            foreach ($delivery_points as $dp){
                $delivery_point = DeliveryPoint::find($dp->id);
                $delivery_point->visible = true;
                $delivery_point->save();
            }
        }
        $item->save();
        return redirect(route('admin-delivery-points'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $delivery_point = DeliveryCity::find($request->get('id'));
        $delivery_point->city = $request->get('city');
        $delivery_point->save();
        return redirect(route('admin-delivery-points'));
    }


    public function delete($id = null){
        $delivery_point = DeliveryCity::where('id', $id)->first();
        $delivery_point->delete();
        return redirect(route('admin-delivery-points'));
    }
}
