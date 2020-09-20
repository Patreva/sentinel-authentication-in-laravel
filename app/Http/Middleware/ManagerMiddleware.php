<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class ManagerMiddleware
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
        //user should be authenicated
        //authenicated user should have role admin
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'manager')
            return $next($request);
        else
            return redirect('/');
    }
}
