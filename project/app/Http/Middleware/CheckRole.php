<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role == "Admin") {
                return $next($request);
            } elseif (Auth::user()->role == "Member") {
                return redirect('/user/dashboard');
            } elseif (Auth::user()->role == "Platinum") {
                return redirect('/user/dashboard');
            } else if (Auth::user()->role == "Gold") {
                return redirect('/user/dashboard');
            }
        }        
    }
}
