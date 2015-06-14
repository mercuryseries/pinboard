<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotOwner
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
        if($request->user()->id != $request->pins->owner->id){
            return redirect()->route('root_path');
        }

        return $next($request);
    }
}
