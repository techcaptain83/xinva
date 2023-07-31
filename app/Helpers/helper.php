<?php

function activeSubscription() {
    return auth()->user()->subscriptions()->where('paddle_status', 'active')->first();
}

function deductCredit($count = 1) {
    $user = auth()->user();
    if(!$user->subscribed('default')) {
        $user->credits_used += $count;
        $user->save();
    }
}
