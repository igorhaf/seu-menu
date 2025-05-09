<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function updateWhatsapp(Request $request){
        Setting::setConfig('whatsapp_number', $request->get('whatsapp_number'));
        return redirect(route('home'));
    }

    public function updatePrevision(Request $request){
        Setting::setConfig('delivery_prevision', $request->get('prevision'));
    }

    public function updateMinimalOrder(Request $request){
        $minimal_order = number_format(floatval($request->get('minimal_order')), 2, '.', ',');
        Setting::setConfig('minimal_order', $minimal_order);
    }

    public function updateInstagram(Request $request){
        Setting::setConfig('instagram', $request->get('instagram'));
        return redirect(route('home'));
    }

    public function updateGooglemaps(Request $request){
        Setting::setConfig('google_map', $request->get('google_map'));
        Setting::setConfig('address', $request->get('address'));
        Setting::setConfig('address_number', $request->get('address_number'));
        Setting::setConfig('district', $request->get('district'));
        Setting::setConfig('cep', $request->get('cep'));
        Setting::setConfig('city', $request->get('city'));
        Setting::setConfig('state', $request->get('state'));
        return redirect(route('home'));
    }

    public function updateFacebook(Request $request){
        Setting::setConfig('facebook', $request->get('facebook'));
        return redirect(route('home'));
    }
}
