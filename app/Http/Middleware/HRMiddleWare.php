<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HRMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $guard = null)
    {

        
        if(Auth::check() && Auth::user()->access_hr=='1'){
            
            return $next($request);
            
        }
            return redirect('/access_denied');
        
       
    }
}
