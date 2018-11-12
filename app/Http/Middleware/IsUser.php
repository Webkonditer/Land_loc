<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
{

    public function handle($request, Closure $next, $guard = 'user_guard')
    {
        if (!Auth::guard($guard)->check()) {

                $next_url = session('_previous')['url'];
//dump($request);dd($request->REQUEST_URI);
                session(['next_url' => $next_url]);

                return redirect('/user/login');
        }

        return $next($request);
    }
}
