<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class SpeakerMiddleware
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
        
        if (Auth::check() && Auth::User()->type=='Speaker' || Auth::User()->type=='Admin') {
            return $next($request);
        }
        return redirect(url('/'));
      
    }
}
