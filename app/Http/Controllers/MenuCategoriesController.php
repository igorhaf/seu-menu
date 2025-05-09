<?php

namespace App\Http\Controllers;

use App\Models\ItemAdditional;
use App\Models\ItemVariable;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\VariableOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MenuCategoriesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'É preciso definir um nome para a categoria',
            ]
        );
        $latest = MenuCategory::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $menu_category = new MenuCategory();
        $menu_category->name = $request->get('name');
        $menu_category->position = $latest_id;
        $menu_category->save();
        return redirect(route('admin-menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'É preciso definir um nome para a categoria',
            ]
        );
        $category = MenuCategory::find($request->get('id'));
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/categories/' . $name;
            Storage::disk(config('filesystems.default'))->put($filePath, file_get_contents($file));
            $url = minio_url(Storage::disk(config('filesystems.default'))->url($filePath));
            $category->photo = $url;
        }
        $category->name = $request->get('name');
        $category->save();
        return redirect(route('admin-menu'));
    }

    public function reposition(Request $request){
        if($request->has('item'))
        {
            $i = 0;
            foreach($request->get('item') as $id)
            {
                $i++;
                $item = MenuCategory::find($id);
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
        $category = MenuCategory::find($id);
        if($category->visible == true){
            $category->visible = false;
            $menu_itens = MenuItem::where('menu_category_id', $category->id)->get();
            foreach ($menu_itens as $menu_item){
                $item = MenuItem::find($menu_item->id);
                $item->visible = false;
                $item->save();
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
            }
        }else{
            $category->visible = true;
            $menu_itens = MenuItem::where('menu_category_id', $category->id)->get();
            foreach ($menu_itens as $menu_item){
                $item = MenuItem::find($menu_item->id);
                $item->visible = true;
                $item->save();
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
        }
        $category->save();
        return redirect(route('admin-menu'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        if(!empty($id)){
            MenuCategory::destroy($id);
        }
        return redirect(route('admin-menu'));
    }
}
