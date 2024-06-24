<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DisabledCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->disabled) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is disabled.');
        }

        return $next($request);
    }
}
