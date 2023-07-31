<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

class ShareCommonData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // pass google Adsense script to plan users.
        $adSenseScript = '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1174411654230796"
            crossorigin="anonymous"></script>';
        if(auth()->user() && auth()->user()->payments()->exists()) {
            $adSenseScript = '';
        }
        Inertia::share([
            'adSenseScript' => $adSenseScript
        ]);
        if(!in_array($request->route()->getName(), ['dashboard','history','payment_history','credits','profile.edit','Subscription']))
            $adSenseScript = '';
        View::share('adSenseScript', $adSenseScript);

        return $next($request);
    }
}
