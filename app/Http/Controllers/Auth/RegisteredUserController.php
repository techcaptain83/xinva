<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use \Mailjet\Resources;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255' ,
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'total_credits' => 5,
        ]);

        event(new Registered($user));

        // $apikey = env('MJ_APIKEY_PUBLIC');
        // $apisecret = env('MJ_APIKEY_PRIVATE');

        // $mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3']);

        // $body = [
        //     'Email' => $user->email,
        //     'Name' => $user->name
        // ];
        // $find_email = $mj->get(Resources::$Contact, ['id' => $user->email]);
        // $find_email_response_data = $find_email->getData();
        // if(isset($find_email_response_data['StatusCode']) && $find_email_response_data['StatusCode'] == 404){
        //     $create_email  = $mj->post(Resources::$Contact, ['body' => $body]);
        //     $create_email_response_data = $create_email->getData();
        //     $contact_id = $create_email_response_data[0]['ID'];
        // } else {
        //     $contact_id = $find_email_response_data[0]['ID'];
        // }

        // $body = [
        //     'ContactID' => $contact_id,
        //     'ListID' => '79638'
        // ];
        // $response  = $mj->post(Resources::$Listrecipient, ['body' => $body]);


        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
