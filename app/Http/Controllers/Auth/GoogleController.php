<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use \Mailjet\Resources;



class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $current_user = User::whereHas('socialProfiles', function ($query) use ($user) {
                $query->where([
                    ['provider_type', '=', 'google'],
                    ['provider_id', '=', $user->id]
                ]);
            })->first();
            if ($current_user) {

                Auth::login($current_user);

                return redirect()->intended('dashboard');

            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'password' => encrypt('123456dummy'),
                ]);
                if ($newUser->wasRecentlyCreated) {
                    $newUser->total_credits = 5;
                    $newUser->save();

                    // $apikey = env('MJ_APIKEY_PUBLIC');
                    // $apisecret = env('MJ_APIKEY_PRIVATE');

                    // $mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3']);

                    // $body = [
                    //     'Email' => $user->email,
                    // ];
                    // // $mj->post(Resources::$Contact, ['body' => $body]);
                    // $find_email = $mj->get(Resources::$Contact, ['id' => $user->email]);
                    // $find_email_response_data = $find_email->getData();
                    // if (isset($find_email_response_data['StatusCode']) && $find_email_response_data['StatusCode'] == 404) {
                    //     $create_email = $mj->post(Resources::$Contact, ['body' => $body]);
                    //     $create_email_response_data = $create_email->getData();
                    //     $contact_id = $create_email_response_data[0]['ID'];
                    // } else {
                    //     $contact_id = $find_email_response_data[0]['ID'];
                    // }

                    // $body = [
                    //     'ContactID' => $contact_id,
                    //     'ListID' => '79638'
                    // ];
                    // $response = $mj->post(Resources::$Listrecipient, ['body' => $body]);
                }
                Auth::login($newUser);

                $google_profile = $newUser->socialProfiles()->where('provider_type', 'google')->first();
                if (!$google_profile) {
                    SocialProfile::create([
                        'user_id' => auth()->user()->id,
                        'provider_id' => $user->id,
                        'provider_type' => 'google'
                    ]);
                }

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
