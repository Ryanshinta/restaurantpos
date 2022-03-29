<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Chef
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
        if(Auth::check() && Auth::user()->role == 'Chef'){
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'Waiter') {
            return redirect('/Waiter');
        }
        elseif (Auth::check() && Auth::user()->role == 'Admin'){
            return redirect('/Admin');
        }
        else{
            return redirect('/Manager');
        }
    }
}
