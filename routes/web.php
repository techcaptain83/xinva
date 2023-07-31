<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\BackgroundController;
use App\Http\Controllers\CreditUsageController;
use App\Http\Controllers\CustomImageModelController;
use App\Http\Controllers\ScalingController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PromptGeneratorController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VariantMakerController;
// use App\Http\Controllers\Auth\LoginController;
use App\Models\BgRemovedPrediction;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Customer;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\Prediction;
use App\Models\User;
use App\Models\PredictionResult;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Models\Page;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    if (auth()->user()) {
        return redirect()->to('/dashboard');
    }
    return redirect()->to('/login');
});

Route::middleware('guest')->group(function () {
    // Socialite //
    Route::controller(App\Http\Controllers\Auth\GoogleController::class)->group(function () {
        Route::get('social/google', 'redirect')->name('auth.google');
        Route::get('social/google/callback', 'googleCallback');
    });

    Route::controller(FacebookController::class)->group(function () {
        Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
        Route::get('auth/facebook/callback', 'handleFacebookCallback');
    });

    Route::get('/index', function () {
        return Inertia::render('Index');
    })->name('index');
});



Route::middleware(['auth', 'shareData'])->group(function () {

    Route::middleware('paid')->group(function () {

        Route::get('/credit-usage', [CreditUsageController::class, 'creditUsage'])->name('credit-usage');

        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // Route::prefix('prompt-generator')->name('prompt-generator.')->group(function () {
        //     Route::get('/', function () {
        //         return Inertia::render('Prompt-Generator');
        //     })->name('index');
        //     Route::post('/store', [PromptGeneratorController::class, 'getPrompt'])->name('store');
        //     Route::get('/prediction/{id}', [PromptGeneratorController::class, 'prediction'])->name('prediction');
        // });

        Route::prefix('variant-maker')->name('variant-maker.')->group(function () {
            Route::get('/store/{id}', [VariantMakerController::class, 'prediction'])->name('store');
            Route::get('/prediction/{id}', [VariantMakerController::class, 'predictionResults'])->name('prediction');
        });

        Route::prefix('custom')->name('custom.')->group(function () {
            Route::get('/upscaler', [CustomImageModelController::class, 'upscaler'])->name('upscaler');
            Route::post('/upscaler', [CustomImageModelController::class, 'storeUpscaler'])->name('upscaler.store');
            Route::get('/variant-maker', [CustomImageModelController::class, 'variantMaker'])->name('variant-maker');
            Route::post('/variant-maker', [CustomImageModelController::class, 'storeVariantMaker'])->name('variant-maker.store');
        });

        Route::post('/prediction', [PredictionController::class, 'prediction'])->name('predict');
        Route::get('/prediction/{id}', [PredictionController::class, 'result'])->name('prediction-response');
        Route::get('/prediction-result/{id}/download', [DownloadController::class, 'download'])->name('download');
        Route::get('/bgremoved-prediction-result/{id}/download', [DownloadController::class, 'downloadBGRemoved'])->name('downloadBGRemoved');
        Route::get('/bgremoved-scaled-prediction-result/{id}/download', [DownloadController::class, 'downloadBGRemovedScaled'])->name('downloadBGRemovedScaled');
        Route::get('/scale-prediction-result/{id}/download', [DownloadController::class, 'downloadscale'])->name('downloadscale');
        Route::get('/variant-maker-prediction/{id}/download', [DownloadController::class, 'variantMakerPredictionDownload'])->name('variantMakerPredictionDownload');

        Route::get('/prediction-results/{id}/remove-bg', [BackgroundController::class, 'removeBackground'])->name('remove-background');
        Route::get('/bg-removed-prediction/{id}', [BackgroundController::class, 'remove_bg'])->name('background-response');

        Route::get('/prediction-results/{id}/remove-bg/scale', [ScalingController::class, 'scaleBGRemoved'])->name('remove-background-and-scale');
        Route::get('/prediction-results/{id}/variant-maker/scale', [ScalingController::class, 'scaleVariantMaker'])->name('variant-maker-and-scale');

        Route::get('/bg-removed-prediction/{id}/scale', [ScalingController::class, 'removeBackgroundAndScaleDownload'])->name('background-removed-scaled-response');

        Route::get('/prediction-results/{id}/scaling_image', [ScalingController::class, 'scaling'])->name('scale');
        Route::get('/scaling-image/{id}', [ScalingController::class, 'scaling_image'])->name('scale-image');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/image', [ProfileController::class, 'store'])->name('profile.store');


    Route::get('/how-it-works', function () {
        return Inertia::render('HowItWorks');
    })->name('how_it_works');

    Route::get('/settings', function () {
        return Inertia::render(
            'Settings',
            [
                'user' => auth()->user(),
                'hasGoogleProfile' => auth()->user()->socialProfiles()->where('provider_type', 'google')->first() ? true : false,
                'hasFacebookProfile' => auth()->user()->socialProfiles()->where('provider_type', 'facebook')->first() ? true : false,
            ]
        );
    })->name('settings');


    Route::post('/change_image', [ProfileController::class, 'change_image'])->name('image_change');


    // Route::get('/subscription', function () {
    //     return Inertia::render('Subscription',[
    //         'payment' => Payment::with('plan')->where('user_id', auth()->user()->id)->get(),
    //         'user' => auth()->user(),
    //     ]);
    // })->name('Subscription');
    Route::get('/cancel/subscription', [SubscriptionController::class, 'cancelSubscription'])->name('cancel-subscription');

    Route::get('/subscription/paddle', function () {
        $activeSubscription = request()->user()->subscribed('default');//activeSubscription();
        $lastPayment = Payment::with('plan')->where('user_id', auth()->user()->id)->latest()->first();
        if(!$activeSubscription && $lastPayment && $lastPayment->plan->type == 'recurring') {
            $payment = [];
        }
        else {
            $payment = Payment::with('plan')->where('user_id', auth()->user()->id)->latest()->take(1)->get();
        }


        return Inertia::render('Subscription', [
            'payment' => $payment,
            'user' => auth()->user(),
            'activeSubscription' => $activeSubscription
        ]);
    })->name('Subscription');


    Route::get('/history', [HistoryController::class, 'get'])->name('history');


    Route::get('/history/bg-removed', function () {
        $predictions = User::find(auth()->user()->id)->predictions()->with('bgRemovedResults')->has('bgRemovedResults')->get();
        return Inertia::render('BgRemovedHistory', [
            'predictions' => $predictions,
        ]);
    })->name('bg_removed_history');


    Route::get('/history/scaled', function () {
        $predictions = User::find(auth()->user()->id)->predictions()->with('scaledResults')->has('scaledResults')->get();
        return Inertia::render('ScaledHistory', [
            'predictions' => $predictions,
        ]);
    })->name('scaled_history');


    // Route::get('/pricing/credit-plans/{emptyCredit?}', function (Request $request) {
    //     $emptyCredit = isset($request->emptyCredit) ? $request->emptyCredit : false;
    //     return Inertia::render(
    //         'Pricing',
    //         [
    //             'plans' => Plan::where('type', 'onetime')->get(),
    //             'emptyCredit' => $emptyCredit
    //         ]
    //     );
    // })->name('pricing-credit');

    // Route::get('/pricing/premium-plans', function () {
    //     return Inertia::render(
    //         'Pricing',
    //         [
    //             'plans' => Plan::where('type', 'recurring')->get(),
    //         ]
    //     );
    // })->name('pricing-premium');


    Route::get('/paddle/pricing/credit-plans/{emptyCredit?}', function (Request $request) {

        $emptyCredit = isset($request->emptyCredit) ? $request->emptyCredit : false;
        $plans = Plan::where('type', 'onetime')->get();
        foreach ($plans as $plan) {
            $plan->payLink = $request->user()
            ->chargeProduct($plan->paddle_subscription_plan_id);
        }

        return Inertia::render(
            'Pricing',
            [
                'plans' => $plans,
                'vendor' => intval(env('PADDLE_VENDOR_ID')),
                'emptyCredit' => $emptyCredit
            ]
        );
    })->name('paddle.pricing-credit');

    Route::get('/paddle/pricing/premium-plans', function (Request $request) {

        $paddlePlanId = optional(activeSubscription())->paddle_plan;
        $plans = Plan::where('type', 'recurring')->get();
        foreach ($plans as $plan) {
            $plan->payLink = $request->user()
            ->newSubscription('default', $plan->paddle_subscription_plan_id)
            ->returnTo(route('paddle.subscription-success', $plan->id))
            ->create();
        }

        return Inertia::render(
            'Pricing',
            [
                'plans' => $plans,
                'vendor' => intval(env('PADDLE_VENDOR_ID')),
                'activePlanId' => $paddlePlanId
            ]
        );
    })->name('paddle.pricing-premium');

    Route::get('/payment_history', function () {
        return Inertia::render('Payment_History', [
            'payment' => Payment::with('plan')->where('user_id', auth()->user()->id)->get(),
            'user' => auth()->user(),
        ]);
    })->name('payment_history');

    Route::get('/credits', function () {
        return Inertia::render('Credits', [
            'users' => User::where('id', auth()->user()->id)->get(),
            'user' => auth()->user(),
            'subscription' => request()->user()->subscribed('default')
        ]);
    })->name('credits');

    // Route::get('/plans/{id}/checkout', [PaymentController::class, 'checkout'])->name('checkout-plan');

    // Route::get('/plans/{id}/subscribe', [PaymentController::class, 'subscribe'])->name('subscribe-plan');

    Route::get('/checkout-cancel', function (Request $request) {
        return redirect()->to('/');
    })->name('checkout-cancel');

    Route::get('/paddle/plans/{plan_id}/checkout-success', [PaymentController::class, 'checkoutPaddleSuccess'])->name('paddle.checkout-success');

    // Route::get('/plans/{id}/subscription-success', [PaymentController::class, 'subscribeSuccess'])->name('subscription-success');

    Route::get('/paddle/plans/{id}/subscription-success', [PaymentController::class, 'subscribePaddleSuccess'])->name('paddle.subscription-success');
});

Route::get('/privacy-policy', function () {
    return Inertia::render(
        'PrivacyPolicy',
        [
            'page' => Page::find(1)
        ]
    );
})->name('privacy_policy');


require __DIR__ . '/auth.php';
