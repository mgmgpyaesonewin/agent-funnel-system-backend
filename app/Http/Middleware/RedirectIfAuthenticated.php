<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->hasCookie('access_token')) {
            Auth::setToken($request->cookie('access_token'));
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
