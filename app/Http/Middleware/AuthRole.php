<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function handle($request, Closure $next, String $role)
     {
       if(!$request->user() || !$request->user()->hasRole($role)){
         Auth::logout();
         return redirect('/');
       }
         return $next($request);
     }
}
