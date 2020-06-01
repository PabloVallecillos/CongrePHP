<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\PayCongress;

class PayMiddleware
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
        $id = Auth::User()->id;
        // $presentation = $request->route()->parameter('id');
        // $congress =  \DB::table('pay_congresses')->where('id', $id)->first();
        
        if (Auth::check() ) {
            return $next($request);
        }
    
        
        return redirect(url('/'));
        
    }
}
