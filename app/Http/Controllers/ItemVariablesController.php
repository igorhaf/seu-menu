<?php

namespace App\Http\Controllers;

use App\Models\ItemVariable;
use App\Models\VariableOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ItemVariablesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $item_variable = new ItemVariable();
        $item_variable->variable = $request->get('variable');
        $latest = ItemVariable::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $item_variable->position = $latest_id;
        $item_variable->menu_item_id = $request->get('menu_item_id');
        $item_variable->save();
        return redirect(route('admin-manage-menu-item', $request->get('menu_item_id')));
    }

    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = ItemVariable::find($id);
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
        $item_variable = ItemVariable::find($id);
        if($item_variable->visible == true){
            $item_variable->visible = false;
            $variable_options = VariableOption::where('item_variable_id', $item->id)->get();
            foreach ($variable_options as $variable_option){
                $menu_it = VariableOption::find($variable_options->id);
                $menu_it->visible = false;
                $menu_it->save();
            }
        }else{
            $item_variable->visible = true;
            $variable_options = VariableOption::where('item_variable_id', $item_variable->id)->get();
            foreach ($variable_options as $variable_option){
                $menu_it = VariableOption::find($variable_option->id);
                $menu_it->visible = true;
                $menu_it->save();
            }
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
        $item_variable = ItemVariable::find($request->get('id'));
        $item_variable->variable = $request->get('variable');
        $item_variable->save();
        return redirect(route('admin-manage-menu-item', $item_variable->menu_item_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id = null){
        $item_variable = ItemVariable::find($id);
        ItemVariable::destroy($id);

        return redirect(route('admin-manage-menu-item', $item_variable->menu_item_id));
    }
}
