<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasCreditsOrSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user() && $request->user()->subscribed('default')) {
            // This user is subscribed customer...
            return $next($request);
        }

        if ($request->user() && ($request->user()->total_credits - $request->user()->credits_used > 0)) {
            // This user is subscribed customer...
            return $next($request);
        } else {
            if($request->ajax() && in_array($request->route()->getName(), ['predict','custom.upscaler.store','custom.variant-maker.store'])) {
                return response()->json(['success' => false, 'error' => 'credit_out']);
            }
            else {
                return $next($request);
            }
        }

        return redirect()->route('paddle.pricing-credit',['emptyCredit' => true]);

    }
}
