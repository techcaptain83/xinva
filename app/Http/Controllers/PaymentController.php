<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PaymentController extends Controller
{
    // public function checkout(Request $request)
    // {
    //     $plan = Plan::find($request->id);
    //     if (!$plan) {
    //         return redirect()->back();
    //     }
    //     return $request->user()
    //     ->allowPromotionCodes()
    //         ->checkout([$plan->stripe_price_id => 1], [
    //         'success_url' => route('checkout-success', $plan->id) . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('checkout-cancel'),
    //     ]);

    // }

    // public function checkoutSuccess(Request $request)
    // {
    //     $plan = Plan::find($request->id);
    //     if (!$plan) {
    //         return redirect()->route('paddle.pricing-credit');
    //     }

    //     $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
    //     if ($checkoutSession->status == 'complete' && $checkoutSession->payment_status == 'paid') {
    //         Payment::create([
    //             'user_id' => auth()->user()->id,
    //             'plan_id' => $plan->id,
    //             'stripe_id' => $checkoutSession->id,
    //             'stripe_price_id' => $checkoutSession->payment_intent,
    //             'amount_total' => $checkoutSession->amount_total,
    //             'currency' => $checkoutSession->currency,
    //             'payment_status' => $checkoutSession->payment_status,
    //         ]);

    //         $request->user()->total_credits += $plan->credits;
    //         $request->user()->save();
    //     }

    //     return Inertia::render('Dashboard');

    // }

    public function checkoutPaddleSuccess(Request $request)
    {
        $plan = Plan::where('paddle_subscription_plan_id', $request->plan_id)->first();
        if (!$plan) {
            return redirect()->route('paddle.pricing-credit');
        }

        // $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        // if ($checkoutSession->status == 'complete' && $checkoutSession->payment_status == 'paid') {
        //     Payment::create([
        //         'user_id' => auth()->user()->id,
        //         'plan_id' => $plan->id,
        //         'stripe_id' => $checkoutSession->id,
        //         'stripe_price_id' => $checkoutSession->payment_intent,
        //         'amount_total' => $checkoutSession->amount_total,
        //         'currency' => $checkoutSession->currency,
        //         'payment_status' => $checkoutSession->payment_status,
        //     ]);

        //     $request->user()->total_credits += $plan->credits;
        //     $request->user()->save();
        // }

        return Inertia::render('Dashboard',
        [
            'paymentSuccessEmail' => auth()->user()->email
        ]);

    }

    // public function subscribe(Request $request)
    // {
    //     $plan = Plan::find($request->id);
    //     if (!$plan) {
    //         return redirect()->back();
    //     }
    //     return $request->user()
    //         ->newSubscription('default', $plan->stripe_price_id )
    //         ->allowPromotionCodes()
    //         ->checkout([
    //             'success_url' => route('subscription-success', $plan->id) . '?session_id={CHECKOUT_SESSION_ID}',
    //             'cancel_url' => route('checkout-cancel'),
    //         ]);

    // }

    // public function subscribePaddle(Request $request)
    // {
    //     $plan = Plan::find($request->id);
    //     if (!$plan) {
    //         return redirect()->back();
    //     }
    //     $payLink = $request->user()
    //         ->newSubscription('default', $plan->paddle_subscription_id)
    //         ->returnTo(route('paddle.subscription-success', $plan->id))
    //         ->create();

    //     return view('billing', ['payLink' => $payLink]);
    // }

    // public function subscribeSuccess(Request $request)
    // {

    //     $plan = Plan::find($request->id);
    //     if (!$plan) {
    //         return redirect()->route('pricing-premium');
    //     }

    //     $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));

    //     if($checkoutSession->status == 'complete' && $checkoutSession->payment_status == 'paid')
    //     {
    //         Payment::create([
    //             'user_id' => auth()->user()->id,
    //             'plan_id' => $plan->id,
    //             'stripe_id' => $checkoutSession->id,
    //             'stripe_price_id' => $checkoutSession->payment_intent,
    //             'amount_total' => $checkoutSession->amount_total,
    //             'currency' => $checkoutSession->currency,
    //             'payment_status' => $checkoutSession->payment_status,
    //         ]);

    //         $request->user()->total_credits = 0;
    //         $request->user()->credits_used = 0;
    //         $request->user()->save();
    //     }
    //     return Inertia::render('Dashboard');
    // }


    public function subscribePaddleSuccess(Request $request)
    {

        $plan = Plan::find($request->id);
        if (!$plan) {
            return redirect()->route('paddle.pricing-premium');
        }

        // $checkoutId = $request->checkout;

        // $apiEndpoint = env('PADDLE_SANDBOX') == true ? "https://sandbox-checkout.paddle.com/api/1.0/order" : "https://checkout.paddle.com/api/1.0/order";

        // $response = Http::get($apiEndpoint, [
        //     'checkout_id' => $checkoutId,
        //     'vendor_id' => env('PADDLE_VENDOR_ID'),
        //     'vendor_auth_code' => env('PADDLE_VENDOR_AUTH_CODE'),
        // ]);

        // if ($response->successful()) {
        //     $orderData = $response->json();
        //     // Process the order data as needed
        //     if ($orderData['state'] == 'processed' && $orderData['order']['is_subscription'] == true) {
        //         // $payment = Payment::where('paddle_checkout_id', $checkoutId)->first();
        //         // if(!$payment) {
        //             Payment::create([
        //                 'user_id' => auth()->user()->id,
        //                 'plan_id' => $plan->id,
        //                 'paddle_checkout_id' => $checkoutId,
        //                 'paddle_subscription_id' => $orderData['order']['subscription_id'],
        //                 'amount_total' => $orderData['order']['total'],
        //                 'currency' => $orderData['order']['currency'],
        //                 'payment_status' => 'success',
        //             ]);

        //             // $request->user()->total_credits = 0;
        //             // $request->user()->credits_used = 0;
        //             // $request->user()->save();
        //         // }
        //     }

        // } else {
        //     $errorMessage = $response->json();
        //     // Handle the error
        //     dd($errorMessage);
        // }

        return Inertia::render('Dashboard',
        [
            'paymentSuccessEmail' => auth()->user()->email
        ]);
    }
}
