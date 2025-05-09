<?php

namespace App\Http\Controllers;

use App\Models\DeliveryPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DeliveryPointsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'district_'.$request->get('delivery_city_id') => 'required',
            ],
            [
                'district_'.$request->get('delivery_city_id').'.required' => 'É preciso definir um nome para o bairro',
            ]
        );
        $latest = DeliveryPoint::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $delivery_point = new DeliveryPoint();
        $delivery_point->district = $request->get('district_'.$request->get('delivery_city_id'));
        $delivery_point->delivery_city_id = $request->get('delivery_city_id');
        if(!empty($request->get('tax'))) {
            $delivery_point->tax = str_replace(',', '.', str_replace('.', '', $request->get('tax')));
        }
        $delivery_point->position = $latest_id;
        $delivery_point->delivery_city_id = $request->get('delivery_city_id');
        $delivery_point->save();
        return redirect(route('admin-delivery-points'));
    }

    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = DeliveryPoint::find($id);
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
        $item = DeliveryPoint::find($id);
        if($item->visible == true){
            $item->visible = false;
        }else{
            $item->visible = true;
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
        $delivery_point = DeliveryPoint::find($request->get('id'));
        $delivery_point->district = $request->get('district');
        if(!empty($request->get('tax'))) {
            $delivery_point->tax = str_replace(',', '.', str_replace('.', '', $request->get('tax')));
        }
        $delivery_point->save();
        return redirect(route('admin-delivery-points'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id = null)
    {
        DeliveryPoint::destroy($id);
        return redirect(route('admin-delivery-points'));
    }
}
