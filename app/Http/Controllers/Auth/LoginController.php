<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Transcribe\Http\Controllers\Auth\AuthenticatesUsers;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::drive('google')->redirect();
    }
   
    public function handleGoogleCallback()
    {
        $user =  Socialite::drive('google')->redirect();

        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::Where('email', '=', $data->email )->first();
        if (!$user) {
            $user = new User();
            $user->name();
            $user->email();
            $user->save();
        }

        Auth::login($user);
    }


}
