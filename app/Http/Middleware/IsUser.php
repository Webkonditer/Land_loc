<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
{

    public function handle($request, Closure $next, $guard = 'user_guard')
    {
        if (!Auth::guard($guard)->check()) {
                return redirect('/user/login');
        }

        return $next($request);
    }
}
