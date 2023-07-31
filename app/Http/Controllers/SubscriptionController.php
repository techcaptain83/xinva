<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    public function cancelSubscription() {
        $user = request()->user();
        if($user) {
            try {
                $activeSubscription = activeSubscription();
                if($activeSubscription) {

                    $apiEndpoint = env('PADDLE_SANDBOX') == true ? 'https://sandbox-vendors.paddle.com/api/2.0/subscription/users_cancel' : 'https://vendors.paddle.com/api/2.0/subscription/users_cancel';

                    $response = Http::post($apiEndpoint, [
                        'vendor_id' => env('PADDLE_VENDOR_ID'),
                        'vendor_auth_code' => env('PADDLE_VENDOR_AUTH_CODE'),
                        'subscription_id' => $activeSubscription->paddle_id,
                    ]);
                    if ($response->successful()) {

                    }else {
                        return response()->json(['success' => false, 'message' => 'Something went wrong on cancel subscription']);
                    }

                }
                return response()->json(['success' => true, 'message' => 'Subscription cancelled!']);
            } catch(\Exception $ex) {
                return response()->json(['success' => false, 'message' => $ex->getMessage()]);
            }
        }
        else {
            return response()->json(['success' => false, 'message' => 'Something went wrong on cancel subscription']);
        }
    }
}
