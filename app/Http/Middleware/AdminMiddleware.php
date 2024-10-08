<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if($request->user()->is_admin == 1){
        //     return $next($request);
        // }else{
        //     return redirect()->route('admin.login');
        // }
        if (!Auth::check()) {
            return redirect()->route('auth-login-basic');
        } else{
            if (auth()->user()->is_admin == 1) {
                return $next($request);
            }
            return redirect()->route('auth-login-basic');
        }
       
    }
}
