<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\ItemAdditional;
use App\Models\ItemVariable;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\VariableOption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MenuItensController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name_'.$request->get('menu_category_id') => 'required',
            ],
            [
                'name_'.$request->get('menu_category_id').'.required' => 'É preciso definir um nome para o produto',
            ]
        );
        $latest = MenuItem::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $menu_item = new MenuItem();
        $menu_item->name = $request->get('name_'.$request->get('menu_category_id'));
        if(empty($request->get('price'))) {
            $this->changeVisibility($menu_item->id, false);
            $menu_item->price = null;
        }else{
            $menu_item->price = str_replace(',', '.', str_replace('.', '', $request->get('price')));
        }
        $menu_item->position = $latest_id;
        $menu_item->menu_category_id = $request->get('menu_category_id');
        $menu_item->save();
        return redirect(route('admin-menu'));
    }


    public function changeVisibility($id, $hidden = null){
        $item = MenuItem::find($id);
        if($hidden !== null){
            $visibible = $hidden;
        }else{
            $item = MenuItem::find($id);
            if(!empty($item->price)) {
                $visibible = $item->visible;
            }else{
                $visibible = true;
            }
        }
        if($visibible == true){
            $item->visible = false;
            $variable = ItemVariable::where('menu_item_id', $item->id)->get();
            foreach ($variable as $varia){
                $vari = ItemVariable::find($varia->id);
                $vari->visible = false;
                $vari->save();
                $variable_options = VariableOption::where('item_variable_id', $vari->id)->get();
                foreach ($variable_options as $variable_option){
                    $option = VariableOption::find($variable_option->id);
                    $option->visible = false;
                    $option->save();
                }
            }
            $additionals = ItemAdditional::where('menu_item_id', $item->id)->get();
            foreach ($additionals as $additional){
                $add = ItemAdditional::find($additional->id);
                $add->visible = false;
                $add->save();
            }
        }else{
            $item->visible = true;
            $variable = ItemVariable::where('menu_item_id', $item->id)->get();
            foreach ($variable as $varia){
                $vari = ItemVariable::find($varia->id);
                $vari->visible = true;
                $vari->save();
                $variable_options = VariableOption::where('item_variable_id', $vari->id)->get();
                foreach ($variable_options as $variable_option){
                    $option = VariableOption::find($variable_option->id);
                    $option->visible = true;
                    $option->save();
                }
            }
            $additionals = ItemAdditional::where('menu_item_id', $item->id)->get();
            foreach ($additionals as $additional){
                $add = ItemAdditional::find($additional->id);
                $add->visible = true;
                $add->save();
            }
        }
        $item->save();
        return redirect(route('admin-menu'));

    }

    public function changeComboLimit(Request $request, $id)
    {
        $item = MenuItem::find($id);
        $item->combo_limit = $request->get('combo_limit');
        $item->save();
        return redirect(route('admin-manage-menu-item', $id));
    }


    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = MenuItem::find($id);
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

    public function manage($id){
        $item = MenuItem::find($id);

        $menu_itens = MenuItem::all();
        $itens = array();
        foreach ($menu_itens as $menu_item){
            $combos = Combo::where('menu_item_id', '=', $menu_item->id)->count();
            if($combos == 0){
                $itens[] = $menu_item;
            }
        }

        $combo_itens = Combo::where('menu_item_id', $id)->get();
        $variables = ItemVariable::where('menu_item_id', $id)->get();
        $additionals = ItemAdditional::where('menu_item_id', $id)->get();
        $categories = MenuCategory::pluck('name', 'id');
        return view('admin.menu.item-manager', compact('combo_itens', 'item', 'variables', 'additionals', 'categories', 'itens'));
    }

    public function update(Request $request, $id){
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'É preciso definir um nome para o produto',
            ]
        );
        $item = MenuItem::find($id);
        $item->name = $request->get('name');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/itens/' . $name;
            Storage::disk(config('filesystems.default'))->put($filePath, file_get_contents($file));
            $url = Storage::disk(config('filesystems.default'))->url($filePath);
            $url = minio_url( $url);
            $item->photo = $url;
        }
        $item->description = $request->get('description');
        $item->observations = $request->get('observations');

        if($request->get('visibility') == 'on'){
            $this->changeVisibility($item->id, false);
        }else{
            $this->changeVisibility($item->id, true);
        }
        $item->price = $request->get('price');
        if($item->price == null) {
            $this->changeVisibility($item->id, true);
            $item->price = null;
        }else{
            $item->price = str_replace(',', '.', str_replace('.', '', $request->get('price')));
        }



        $item->menu_category_id = $request->get('menu_category_id');
        $item->save();
        return redirect(route('admin-menu'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        MenuItem::destroy($id);
        return redirect(route('admin-menu'));
    }
}
