<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Project;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        $tab = [];
        foreach ($tasks as $task) {
            $tab_tab = [];
            $tab_tab['name'] = $task->name;
            $tab_tab['id'] = $task->id;
            $project = DB::table('projects')->where('id', '=', $task->project_id)->where('deleted_at', '=', NULL)->get();
            if (!$project->isEmpty()) {
                $tab_tab['project_name'] = $project[0]->name;
            } else {
                $tab_tab['project_name'] = 'Project no longer exists';
            }
            $user = DB::table('users')->where('id', '=', $task->user_id)->where('deleted_at', '=', NULL)->get();
            if (!$user->isEmpty()) {
                $tab_tab['user_name'] = $user[0]->name;
            } else {
                $tab_tab['user_name'] = 'User no longer exists';
            }
            $tab[count($tab)] = $tab_tab;
        }
        return view('tasks.index')->with('items', $tab);
    }
    public function indexUser($role,User $user)
    {
        if ($role == 'Admin') {
            $tasks = Task::all();
            $tab = [];
            foreach ($tasks as $task) {
                $tab_tab = [];
                $tab_tab['name'] = $task->name;
                $tab_tab['id'] = $task->id;
                $project = DB::table('projects')->where('id', '=', $task->project_id)->where('deleted_at', '=', NULL)->get();
                if (!$project->isEmpty()) {
                    $tab_tab['project_name'] = $task->project->name;
                } else {
                    $tab_tab['project_name'] = 'Project no longer exists';
                }
                $viewer = DB::table('users')->where('id', '=', $task->user_id)->where('deleted_at', '=', NULL)->get();
                if (!$viewer->isEmpty()) {
                    $tab_tab['user_name'] = $task->user->name;
                } else {
                    $tab_tab['user_name'] = 'User no longer exists';
                }
                $tab[count($tab)] = $tab_tab;
            }
            return view('tasks.index')->with(['user' => $user, 'items' => $tab, 'role' => $role]);
        }
        return view('tasks.index')->with(['user' => $user, 'items' => Task::where('user_id', $user->id)->get(), 'role' => $role]);
    }
    public function paginate($items, $perPage, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentPage = $page;
        $offset = ($currentPage - 1) * $perPage;
        $finalItems = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($finalItems, $total, $perPage);
    }
    public function search(Request $request,User $user,$role)
    {
        if(!empty($_GET['task-search'])&&$role=='admin')
        {
            $taskSearch=$_GET['task-search'];
            $tasks=Task::where('name','LIKE','%'.$taskSearch.'%')->paginate(3);
            $tasks->appends($request->all());
            return view('tasks.index')->with(['user' => $user, 'items' => $tasks, 'role' => $role]);
        }
        else if(!empty($_GET['task-search'])&&$role=='visitor'){
            $taskSearch=$_GET['task-search'];
            $tasks=Task::where('user_id','=',$user->id)->where('name','LIKE','%'.$taskSearch.'%')->paginate(3);
            $tasks->appends($request->all());
            return view('tasks.index')->with(['user' => $user, 'items' => $tasks, 'role' => $role]);
        }
        return redirect()->back();
      
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(User $admin)
    {
        $projects = Project::all();
        $allUsers = User::all();
        $users = [];
        foreach ($allUsers as $user) {
            if ($user->roles->first()->name!='Admin') {
                $users[count($users)] = $user;
            }
        }
        $users = collect($users);
        return view('tasks.create')->with(['projects' => $projects, 'users' => $users, 'admin' => $admin]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, User $admin)
    {
        $input = $request->validate($request->rules());
        $tasks = Task::all();
        if ($tasks->isEmpty()) {
            DB::statement('ALTER TABLE tasks AUTO_INCREMENT=1');
        }
        Task::create($input);
        return redirect(route('tasks.indexUser', ['user' => $admin,'role'=>'Admin']))->with('message', 'Task added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, User $admin)
    {
        $task = Task::find($id);
        $projects = Project::all();
        $allUsers = User::all();
        $users = [];
        foreach ($allUsers as $user) {
            if ($user->roles->first()->name!='Admin') {
                $users[count($users)] = $user;
            }
        }
        $users = collect($users);
        return view('tasks.edit')->with(['users' => $users, 'task' => $task, 'projects' => $projects, 'admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, User $admin)
    {
        $input = $request->validate($request->rules());
        $task->update($input);
        return redirect(route('tasks.indexUser', ['user' => $admin,'role'=>'Admin']))->with('message', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, User $admin)
    {
        Task::destroy($id);
        return redirect(route('tasks.indexUser', ['user' => $admin,'role'=>'Admin']))->with('message', 'Task Deleted!');
    }
}
