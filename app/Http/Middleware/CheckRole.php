<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        if(Auth::user()->role_type == '2'){
            // Auth::logout();
            return redirect('/home')->with('error_log', 'You Not Have Rights Access!!');
        }
        return $response;
    }
}
