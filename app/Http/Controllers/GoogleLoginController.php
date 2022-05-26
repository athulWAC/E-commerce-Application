<?php

namespace App\Http\Controllers;

use App\Models\Socialite as ModelsSocialite;
use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use Socialite;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;


class GoogleLoginController extends Controller
{
    public function redirect($provider)
    {
        return FacadesSocialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $getInfo = FacadesSocialite::driver($provider)->user();


        $name = $getInfo->name;
        $email = $getInfo->email;
        $provider_id = $getInfo->id;
        // github uses nickname
        if ($name == null) {
            $name = $getInfo->nickname;
        }
        $user = $this->createUser($provider, $name, $email, $provider_id);
        auth()->login($user);
        return redirect()->to('product');
    }


    function createUser($provider, $name, $email, $provider_id)
    {

        $user = User::where('email', $email)->first();

        if ($user == null) {
            $user = User::create([
                'name'     => $name,
                'email'    => $email,
                'provider' => $provider,

            ]);

            $user_id = $user->id;

            $socialite = ModelsSocialite::create([
                'user_id' => $user_id,
                'name'     => $name,
                'provider' => $provider,
                'provider_id' => $provider_id
            ]);
        } else {

            $socialite = ModelsSocialite::create([
                'user_id' =>  $user->id,
                'name'     => $name,
                'provider' => $provider,
                'provider_id' => $provider_id
            ]);
        }

        // $user = User::where('provider_id', $provider_id)->first();

        // if (!$user) {
        //     $user = User::create([
        //         'name'     => $name,
        //         'email'    => $email,
        //         'provider' => $provider,
        //         'provider_id' => $provider_id
        //     ]);
        // }


        return $user;
    }
}
