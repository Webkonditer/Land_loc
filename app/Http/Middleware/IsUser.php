<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Request;

class IsUser
{

    public function handle($request, Closure $next, $guard = 'user_guard')
    {


        if (!Auth::guard($guard)->check()) {

//dump($request);dd(Request::path());
                session(['next_url' => Request::path()]);

                return redirect('/login');
        }

        return $next($request);
    }
}
