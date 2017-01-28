<?php

namespace Medusa\App\Http\Middleware;

use Closure;

class CharacterCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(user() !== null && cid() !== null)
            return $next($request);

        if(cid() === null)
            return redirect()->route('characters.index');
        
        return redirect()->route('home');
    }
}
