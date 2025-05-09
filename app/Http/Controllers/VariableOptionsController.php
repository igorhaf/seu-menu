<?php

namespace App\Http\Controllers;

use App\Models\ItemVariable;
use App\Models\VariableOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class VariableOptionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $variable_option = new VariableOption();
        $variable_option->option = $request->get('option');
        if($request->get('increase_decrease') == 'on'){
            if(!empty($request->get('increase_decrease_value'))){
                $variable_option->increase_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
            }
        }else{
            if(!empty($request->get('increase_decrease_value'))){
                $variable_option->decrease_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
            }
        }
        $latest = VariableOption::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $variable_option->position = $latest_id;
        $variable_option->item_variable_id = $request->get('item_variable_id');
        $variable_option->save();
        return redirect(route('admin-manage-menu-item', $request->get('menu_item_id')));
    }

    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = \App\VariableOption::find($id);
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
        $variable_option = VariableOption::find($id);
        if($variable_option->visible == true){
            $variable_option->visible = false;
        }else{
            $variable_option->visible = true;
        }
        $variable_option->save();
        $item_variable = ItemVariable::find($variable_option->item_variable_id);
        return redirect(route('admin-manage-menu-item', $item_variable->menu_item_id));

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
        $variable_option = VariableOption::find($request->get('id'));
        $variable_option->option = $request->get('option');
        if($request->get('increase_decrease') == 'on'){
            if(!empty($request->get('increase_decrease_value'))){
                $variable_option->increase_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
                $variable_option->decrease_value = null;
            }
        }else{
            if(!empty($request->get('increase_decrease_value'))){
                $variable_option->increase_value = null;
                $variable_option->decrease_value = str_replace(',', '.', str_replace('.', '', $request->get('increase_decrease_value')));
            }
        }
        $variable_option->save();
        return redirect(route('admin-manage-menu-item', $variable_option->item_variable->menu_item_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id = null){
        $variable_option = VariableOption::find($id);
        VariableOption::destroy($id);
        return redirect(route('admin-manage-menu-item', $variable_option->item_variable->menu_item_id));
    }
}
