<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function userProfile()
    {
        return view('admin.profile.user');
    }

    public function userProfileUpdate(Request $request, $id)
    {
        Setting::setConfig('slug', $request->get('slug'));
        Setting::setConfig('company_name', $request->get('company_name'));
        Setting::setConfig('cep', $request->get('cep'));
        Setting::setConfig('phone', $request->get('phone'));
        Setting::setConfig('address', $request->get('address'));
        Setting::setConfig('address_number', $request->get('address_number'));
        Setting::setConfig('address_complement', $request->get('address_complement'));
        Setting::setConfig('district', $request->get('district'));
        Setting::setConfig('city', $request->get('city'));
        Setting::setConfig('state', $request->get('state'));

        return redirect(route('home'));
    }

    public function paymentProfile()
    {
        return view('admin.profile.payment');
    }

    public function updatePaymentProfile()
    {

    }

    public function paymentStory()
    {

    }
}
