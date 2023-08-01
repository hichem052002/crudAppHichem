<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Role;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function check(Request $request)
    {

        $input = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (!$request->session()->has('loginAgain')) {
            if (Auth::attempt($input)) {
                $request->session()->pull('attempts');
                $request->session()->pull('loginAgain');
                $request->session()->pull('credentials');
                return redirect(route('tasks.indexUser', ['user' => Auth::user(), 'role' => Auth::user()->roles->first()->name]))->with('message', 'Logged in successfully!');
            }
        }
        if ($request->session()->has('attempts')) {
            $attempts = $request->session()->get('attempts');
            if ($attempts < 2) {
                $request->session()->put('attempts', $attempts + 1);
            } else if ($attempts == 2) {
                $request->session()->put('loginAgain', now()->addSecond(50));
                $request->session()->put('attempts', $attempts + 1);
                return back();
            } else if (now()->greaterThan($request->session()->get('loginAgain'))) {
                $request->session()->pull('loginAgain');
                $request->session()->put('attempts', 1);
            } else if ($attempts > 2) {
                return back();
            }
        } else {
            $request->session()->put('attempts', 1);
            $request->session()->put('credentials','Wrong credentials !');
        }
        return back();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('error', 'Logged Out');
    }
    public function sign_up()
    {
        return view('login.signup')->with('roles', Role::all());
    }
}
