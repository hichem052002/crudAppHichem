<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }
    public function create()
    {
        $roles = Role::all();
        return view('users.register')->with('roles', $roles);
    }
    public function store(StoreUserRequest $request)
    {
        $users = User::all();
        if ($users->isEmpty()) {
            DB::statement('ALTER TABLE users AUTO_INCREMENT=1');
        }
        $input = $request->validate($request->rules());
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'password' => Hash::make($input['password']),
        ]);
        $admin = DB::table('roles')->where('name', '=', 'Admin')->first();
        $viewer = DB::table('roles')->where('name', '=', 'Visitor')->first();
        if ($request['role'] == $admin->id) {
            $user->roles()->attach($admin->id);
        }
        $user->roles()->attach($viewer->id);
        if (Auth::check()) {
            return redirect(route('users.index'))->with('message', 'User registerd successfully !');
        }
        return redirect(route('login'))->with('message','Visitor Added successfully !');
    }
    public function edit($role, User $user)
    {
        return view('users.edit')->with(['user' => $user, 'role' => $role]);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->validate($request->rules());
        $input['password'] = Hash::make($request['password']);
        $user->update($input);
        return redirect(route('tasks.indexUser', ['user' => $user, 'role' => $user->roles->first()->name]))->with('message', "User Updated !");
    }
    public function search(Request $request)
    {
        if (!empty($_GET['user-search'])) {
            $userName = $_GET['user-search'];
            $users = User::where('name', 'LIKE', '%' . $userName . '%')->paginate(3);
            $users->appends($request->all());
            return view('users.index')->with('users', $users);
        }
        return redirect()->back();
    }
    public function delete(string $id)
    {
        User::destroy($id);
        return redirect('/users')->with('message', 'User Deleted !');
    }
}
