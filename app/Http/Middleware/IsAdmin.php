<?php
    namespace App\Http\Middleware;
    use Closure;
    use Auth;

    class IsAdmin
    {
        public function handle($request, Closure $next,$guard = 'admin_guard')
        {
            if (!Auth::guard($guard)->check()) {
                return redirect('/dashboard/login');
            }
            return $next($request);
        }
    }
