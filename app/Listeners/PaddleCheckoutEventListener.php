<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PaddleCheckoutEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Log::info('data => ' . json_encode($event));
        if ($event->payload['alert_name'] === 'payment_succeeded' && isset($event->payload['product_id']) ) {
            // Handle the incoming event...
            $product_id = $event->payload['product_id'];
            $passthrough = json_decode($event->payload['passthrough'], true);
            $user = User::find($passthrough['billable_id']);

            $plan = Plan::where('paddle_subscription_plan_id', $product_id)->first();
            if($plan)
            {
                Payment::create([
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'paddle_checkout_id' => $event->payload['checkout_id'],
                    'paddle_subscription_id' => $event->payload['order_id'],
                    'amount_total' => $event->payload['sale_gross'],
                    'currency' => $event->payload['currency'],
                    'payment_status' => 'success',
                ]);

                $user->total_credits += $plan->credits;
                $user->save();
            }
        }
        elseif ($event->payload['alert_name'] === 'subscription_payment_succeeded') {
            // Handle the incoming event...
            try {

                $publicKeyString = env('PADDLE_PUBLIC_KEY');
                $publicKey = openssl_get_publickey($publicKeyString);

                // Get the p_signature parameter & base64 decode it
                $signature = base64_decode($event->payload['p_signature']);

                // Get the fields sent in the request, and remove the p_signature parameter
                unset($event->payload['p_signature']);
                $fields = $event->payload;

                // Sort the fields alphabetically
                ksort($fields);

                foreach ($fields as $k => $v) {
                    if (!in_array(gettype($v), ['object', 'array'])) {
                        $fields[$k] = "$v";
                    }
                }

                // Serialize the fields
                $data = serialize($fields);

                // Verify the signature
                $verification = openssl_verify($data, $signature, $publicKey, OPENSSL_ALGO_SHA1);

                if ($verification === 1) {

                    $planId = $event->payload['subscription_plan_id'];
                    $passthrough = json_decode($event->payload['passthrough'], true);
                    $user = User::find($passthrough['billable_id']);

                    $plan = Plan::where('paddle_subscription_plan_id', $planId)->first();
                    if($plan && $user)
                    {
                        Payment::create([
                            'user_id' => $user->id,
                            'plan_id' => $plan->id,
                            'paddle_checkout_id' => $event->payload['checkout_id'],
                            'paddle_subscription_id' => $event->payload['subscription_id'],
                            'amount_total' => $event->payload['unit_price'],
                            'currency' => $event->payload['currency'],
                            'payment_status' => 'success',
                        ]);
                    }

                }
            } catch(\Exception $ex) {
                Log::info($ex->getMessage());
            }



        }
    }
}
