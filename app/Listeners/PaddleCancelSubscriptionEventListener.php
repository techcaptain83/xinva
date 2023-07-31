<?php

namespace App\Listeners;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaddleCancelSubscriptionEventListener
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
        if ($event->payload['alert_name'] === 'subscription_cancelled' && isset($event->payload['subscription_id']) && isset($event->payload['user_id']) ) {
            // Handle the incoming event...
            $user = User::find($event->payload['user_id']);
            if($user)
                $user->subscription('default')->cancel();
        }
    }
}
