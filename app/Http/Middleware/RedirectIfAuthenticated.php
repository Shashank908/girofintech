<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        // return $next($request);
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        if ($guard == "marketing" && Auth::guard($guard)->check()) {
            return redirect('/marketing');
        }
        if ($guard == "support" && Auth::guard($guard)->check()) {
            return redirect('/support');
        }
        if ($guard == "customer" && Auth::guard($guard)->check()) {
            // $cart = session()->get('cart');
            // if(!empty($cart))
            // {
            //     return redirect('/payment'); 
            // }
            return redirect('/customer');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
