<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->roles->first()->name == 'Admin') {

                return $next($request);
            } else {
                return back()->with('error', 'You are not an logged in as an Admin to Access that page');
            }
        }
        return redirect('/')->with('error', 'You are not logged in!');
    }
}
