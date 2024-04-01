<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if(Auth::user()==null){
            return redirect('/login')->with('error_log', 'Login Again!');
        }else if(Auth::check() && Auth::user()->status != '1'){
            Auth::logout();
            return redirect('/login')->with('error_log', 'Account Deactivated!');
        }
        return $response;
    }
}
