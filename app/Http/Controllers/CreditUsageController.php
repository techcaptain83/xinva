<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditUsageController extends Controller
{
    public function creditUsage() {
        $user = auth()->user();
        if($user) {
            $credit_usage = $user->total_credits > 0 ? round(($user->credits_used/$user->total_credits)*100) : 0;
            if($user->subscribed('default'))
                $credit_usage = 'Unlimited';
            return response()->json(['success' => true, 'output' => $credit_usage]);
        }
        return response()->json(['success' => false, 'output' => 0]);
    }
}
