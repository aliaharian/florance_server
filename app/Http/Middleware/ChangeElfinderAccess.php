<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class ChangeElfinderAccess
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

        } else {
            $role = Auth::user()->role;
            $userId = Auth::user()->id;

            if ($role == 'admin') {
                Config::set('elfinder.dir', ["files"]);
            } else {
                if (!File::exists(public_path('files') . '/user' . $userId)) {
                    File::makeDirectory(public_path('files') . '/user' . $userId, 0777);
                }
                Config::set('elfinder.dir', ["files/user$userId"]);

            }
        }
        return $next($request);
    }

}
