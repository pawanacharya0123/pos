<?php

namespace App\Http\Middleware;

use Closure, Auth;

class Admin
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
        if(!Auth::check() || Auth::user()->is_admin != '1'){
            return redirect()->back();
        }
        return $next($request);
    }
}
