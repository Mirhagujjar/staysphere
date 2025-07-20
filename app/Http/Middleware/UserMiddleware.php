<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }
        return redirect()->route('admin.dashboard')->with('error', 'Admins must use the admin interface');
    }
}
    // public function handle(Request $request, Closure $next) {
    //     if (!Auth::check() || Auth::user()->role !== 'user') {
    //         return redirect('/login')->with('error', 'Unauthorized access.');
    //     }
    //     return $next($request);
    // }



