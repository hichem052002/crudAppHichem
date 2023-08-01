<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $array = explode('/', url()->current());
            $id = $array[6];
            $role = $array[5];
            if (!str_contains(url()->current(), Auth::user()->roles->first()->name . '/' . Auth::user()->id)) {
                if (DB::table('users')->where('id', '=', $id)->where('deleted_at', '=', NULL)->exists()) {
                    $user = User::where('id', '=', $id)->first();
                    if ($user->roles[0]->name == $role) {
                        return back()->with('error', 'You are not logged in with that Account');
                    }
                    return back()->with('error', 'That Account doesn\'t exist');
                }
                return back()->with('error', 'That Account doesn\'t exist');
            }
            return $next($request);
        }
        return back()->with('error', 'You are not Logged in!');
    }
}
