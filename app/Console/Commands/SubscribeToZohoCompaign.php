<?php

namespace App\Console\Commands;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubscribeToZohoCompaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscribe-to-zoho-compaign';
    private $tokenKey = 'zoho_access_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Add user to Zoho list
        $users = User::where('email', '!=', 'admin@xinva.ai')->where('subscriber', 0)->get();

        if($users->isNotEmpty()) {

            $accessToken = Cache::get($this->tokenKey);

            if(!$accessToken) {

                // fetch access token
                $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
                    'grant_type' => 'refresh_token',
                    'client_id' => env('ZOHO_CLIENT_ID'),
                    'client_secret' => env('ZOHO_CLIENT_SECRET'),
                    'refresh_token' => env('ZOHO_REFRESH_TOKEN'),
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    // Process the response data
                    $accessToken = $data['access_token'];
                    Cache::put($this->tokenKey, $data['access_token'], $data['expires_in'] - 60 );
                } else {
                    Log::info('Error while fetching token from Zoho');
                    return;
                }
            }

            foreach($users as $user) {

                $client = new Client();
                $headers = [
                'Authorization' => 'Zoho-oauthtoken '.$accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Cookie' => 'stk=04259f9d9a36dbe6e1b57b6730dbff8c; 805f8c68aa=abe68fd053952458658ee926e8815e1a; JSESSIONID=DA3EEE1ACB662AADF29A3BEA8157834A; ZCAMPAIGN_CSRF_TOKEN=f3572d30-b45c-434d-8717-902819c65f4f; _zcsr_tmp=f3572d30-b45c-434d-8717-902819c65f4f'
                ];
                $options = [
                'form_params' => [
                'contactinfo' => '{"First Name": "'.$user->name.'", "Last Name": " ", "Contact Email": "'.$user->email.'"}'
                ]];
                $request = new Request('POST', 'https://campaigns.zoho.com/api/v1.1/json/listsubscribe?resfmt=JSON&topic_id='.env('ZOHO_TOPIC_ID').'&listkey=' .env('ZOHO_CONTACT_LIST_KEY'), $headers);
                $res = $client->sendAsync($request, $options)->wait();
                $statusCode = $res->getStatusCode();

                if($statusCode == 200) {
                    $user->subscriber = 1;
                    $user->save();
                }

            }
        }

    }
}
