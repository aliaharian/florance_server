<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()) {
            abort(403);
        } elseif (Auth::user()->phone_verified_at == null) {
            return redirect('/verifyPhone');
        } elseif (Auth::user()->role != 'admin') {
            abort(403);
        }
        return $next($request);
    }
}
