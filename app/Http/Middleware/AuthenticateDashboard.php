<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateDashboard
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // If the user is not authenticated, redirect to the login page
            return redirect('/login');
        }

        return $next($request);
    }
}
