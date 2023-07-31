<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SocialProfile;
use \Mailjet\Resources;


class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::whereHas('socialProfiles' , function($query)  use ($user){
                $query->where([
                    ['provider_type', '=', 'facebook'],
                    ['provider_id', '=', $user->id]
                ]);
            })->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'password' => encrypt('123456dummy')
                ]);
                if($newUser->wasRecentlyCreated) {
                    $newUser->total_credits = 5;
                    $newUser->save();

                    // $apikey = env('MJ_APIKEY_PUBLIC');
                    // $apisecret = env('MJ_APIKEY_PRIVATE');

                    // $mj = new \Mailjet\Client($apikey, $apisecret);

                    // $body = [
                    //     'Email' => $user->email,
                    // ];
                    // $mj->post(Resources::$Contact, ['body' => $body]);
                }
                Auth::login($newUser);

                $facebook_profile = $newUser->socialProfiles()->where('provider_type', 'facebook')->first();
                if(!$facebook_profile) {
                    SocialProfile::create([
                        'user_id' => auth()->user()->id,
                        'provider_id'=> $user->id,
                        'provider_type' => 'facebook'
                    ]);
                }

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
