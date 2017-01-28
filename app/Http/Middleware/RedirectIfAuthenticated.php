<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {


            $redirect = app('settings')->where('key', '=', 'logged_in_redirect')->first();

            if(!is_null($redirect))
                return redirect($redirect->value);

            dd($redirect);
            
            return redirect('/home');
        }

        return $next($request);
    }
}
