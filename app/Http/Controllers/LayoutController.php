<?php

namespace App\Http\Controllers;

use App\Models\ImagesTemp;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.layout.index', compact('user'));
    }

    public function updateLayout(Request $request){
        Setting::setConfig('header_image_transparency', $request->get('header_image_transparency'));
        Setting::setConfig('background_image_transparency', $request->get('background_image_transparency'));
        Setting::setConfig('header_color', $request->get('header_color'));
        Setting::setConfig('header_text_color', $request->get('header_text_color'));
        Setting::setConfig('top_color', $request->get('top_color'));
        Setting::setConfig('top_text_color', $request->get('top_text_color'));
        Setting::setConfig('background_color', $request->get('background_color'));
        Setting::setConfig('titles_text_color', $request->get('titles_text_color'));
        Setting::setConfig('content_text_color', $request->get('content_text_color'));
        Setting::setConfig('prices_text_color', $request->get('prices_text_color'));
        Setting::setConfig('logo_style', $request->get('logo_style'));
        Setting::setConfig('logo_border_color', $request->get('logo_border_color'));
        Setting::setConfig('logo_background_color', $request->get('logo_background_color'));
        Setting::setConfig('search_bar_background_color', $request->get('search_bar_background_color'));
        Setting::setConfig('search_bar_text_color', $request->get('search_bar_text_color'));
        Setting::setConfig('footer_background_color', $request->get('footer_background_color'));
        Setting::setConfig('payment_background_color', $request->get('payment_background_color'));
        Setting::setConfig('payment_text_color', $request->get('payment_text_color'));
        Setting::setConfig('schedule_background_color', $request->get('schedule_background_color'));
        Setting::setConfig('schedule_text_color', $request->get('schedule_text_color'));

        if ($request->hasFile('logo')) {
            $file_logo = $request->file('logo');
            $name_logo = time() . $file_logo->getClientOriginalName();
            $filePath_logo = '/logo/' . $name_logo;
            Storage::disk(config('filesystems.default'))->put($filePath_logo, file_get_contents($file_logo));
            $url_logo = minio_url(Storage::disk(config('filesystems.default'))->url($filePath_logo));
            Setting::setConfig('logo',$url_logo);
        }

        if($request->get('removeHeaderFileInput') == 'true'){
            Setting::setConfig('header',null);
        }else{
            if ($request->hasFile('header')) {
                $file_header = $request->file('header');
                $name_header = time() . $file_header->getClientOriginalName();
                $filePath_header = '/header/' . $name_header;
                Storage::disk(config('filesystems.default'))->put($filePath_header, file_get_contents($file_header));
                $url_header = minio_url(Storage::disk(config('filesystems.default'))->url($filePath_header));
                Setting::setConfig('header',$url_header);
            }
        }

        if($request->get('removeBackgroundFileInput') == 'true'){
            Setting::setConfig('background_image',null);
        }else {
            if ($request->hasFile('background_image')) {
                $file_background = $request->file('background_image');
                $name_background = time() . $file_background->getClientOriginalName();
                $filePath_background = '/background_image/' . $name_background;
                Storage::disk(config('filesystems.default'))->put($filePath_background, file_get_contents($file_background));
                $url_background = minio_url(Storage::disk(config('filesystems.default'))->url($filePath_background));
                Setting::setConfig('background_image',$url_background);
            }
        }

        return redirect(route('admin-layout-index'));
    }
    public function saveTempLogo(Request $request){
        $imageTemp = ImagesTemp::where('type', 'logo')->first();
        if($imageTemp){
            $imageTemp->image =  $request->get('logoImage');
            $imageTemp->save();
        }else{
            $imageTem = new ImagesTemp();
            $imageTem->type = 'logo';
            $imageTem->image =  $request->get('logoImage');
            $imageTem->save();
        }
    }

    public function saveTempBackground(Request $request){
        $imageTemp = ImagesTemp::where('type', 'background')->first();
        if($imageTemp){
            $imageTemp->image =  $request->get('backgroundImage');
            $imageTemp->save();
        }else{
            $imageTem = new ImagesTemp();
            $imageTem->type = 'background';
            $imageTem->image =  $request->get('backgroundImage');
            $imageTem->save();
        }
    }

    public function saveTempHeader(Request $request){
        $imageTemp = ImagesTemp::where('type', 'header')->first();
        if($imageTemp){
            $imageTemp->image =  $request->get('headerImage');
            $imageTemp->save();
        }else{
            $imageTem = new ImagesTemp();
            $imageTem->type = 'header';
            $imageTem->image =  $request->get('headerImage');
            $imageTem->save();
        }
    }
    public function grapesjs(){
        return view('admin.layout.grapesjs');
    }
}
