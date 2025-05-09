<?php
namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialController extends Controller
{


    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        $getInfo = Socialite::driver('facebook')->user();
        $user = $this->createUser($getInfo,'facebook');
        auth()->login($user);
        return redirect()->to('/home');
    }


    /**
     * Create a redirect method to google api.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Return a callback method from google api.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callbackGoogle()
    {
        $getInfo = Socialite::driver('google')->user();
        $user = $this->createUser($getInfo,'google');
        auth()->login($user);
        return redirect()->to('/home');
    }

    public function createUser($getInfo,$provider){
        $user = User::where('email', $getInfo->email)->first();
        if(!empty($user)){
            $user->name = $getInfo->name;
            $user->provider = $provider;
            $user->provider_id = $getInfo->id;
        }else{
            $user = new User();
            $user->name = $getInfo->name;
            $user->email = $getInfo->email;
            $user->password = crypt('seumenuSenhaPadrao123456321654');
            $user->provider = $provider;
            $user->provider_id = $getInfo->id;
        }
        $user->save();
        return $user;
    }



}
