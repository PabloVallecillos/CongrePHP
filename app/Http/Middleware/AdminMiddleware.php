<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AdminMiddleware
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
        
        if (Auth::check() && Auth::User()->type=='Admin') {
            return $next($request);
        }
        return redirect(url('/'));
        
        // $var = false;
        // if (Auth::check() && Auth::User()->type=='Admin') {
        //     $var  = true;
        // }
        // $var1 = redirect(url('/'));
        
        // return $var ? $next($request) : $var1; 
    }
}
