<?php

namespace App\Http\Controllers;

use App\Models\ItemAdditional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ItemAdditionalsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $item_additional = new ItemAdditional();
        $item_additional->name = $request->get('name');
        if($request->get('increase_decrease') == 'on'){
            if(!empty($request->get('increase_decrease_value'))){
                $item_additional->increase_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
            }
        }else{
            if(!empty($request->get('increase_decrease_value'))){
                $item_additional->decrease_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
            }
        }
        $latest = ItemAdditional::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $item_additional->position = $latest_id;
        $item_additional->menu_item_id = $request->get('menu_item_id');
        $item_additional->save();
        return redirect(route('admin-manage-menu-item', $request->get('menu_item_id')));
    }

    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = ItemAdditional::find($id);
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
        $item = ItemAdditional::find($id);
        if($item->visible == true){
            $item->visible = false;
        }else{
            $item->visible = true;
        }
        $item->save();
        return redirect(route('admin-manage-menu-item', $item->menu_item_id));

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
        $item_additional = ItemAdditional::find($request->get('id'));
        $item_additional->name = $request->get('name');
        if($request->get('increase_decrease') == 'on'){
            if(!empty($request->get('increase_decrease_value'))){
                $item_additional->increase_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
                $item_additional->decrease_value = null;
            }
        }else{
            if(!empty($request->get('increase_decrease_value'))){
                $item_additional->increase_value = null;
                $item_additional->decrease_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
            }
        }
        $item_additional->save();
        return redirect(route('admin-manage-menu-item', $item_additional->menu_item_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id = null)
    {
        $item_additional = ItemAdditional::find($id);
        ItemAdditional::destroy($id);
        return redirect(route('admin-manage-menu-item', $item_additional->menu_item_id));
    }
}
