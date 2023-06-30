<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        // if (Auth::guard('seller')->check()) {
        //     if (Auth::guard('seller')->user()->confirm == "Yes" && Auth::guard('seller')->user()->status == '1' ) {

        //         return redirect()->route('seller.dashboard');
        //     }else{
        //         return redirect()->route('seller.all-personal-details');
        //     }
        // }

        if (Auth::guard('seller')->check() && Auth::guard('seller')->user()->confirm == "Yes" && Auth::guard('seller')->user()->status == '1') {


            return redirect()->route('seller.dashboard');
        }
        return $next($request);
    }
}
