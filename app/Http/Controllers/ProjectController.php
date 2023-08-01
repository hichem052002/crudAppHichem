<?php


namespace App\Http\Controllers;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $projects=Project::all();
        return view('projects/index')->with('projects',$projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('projects/create')->with('projects',Project::all()); 
    }
    public function search(Request $request)
    {
        if(!empty($_GET['project-search'])){
        $projectName=$_GET['project-search'];
        $projects=Project::where('name','LIKE','%'.$projectName.'%')->paginate(3);
        $projects->appends($request->all());
        return view('projects.index')->with('projects',$projects);}
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $input=$request->validate($request->rules());   
        $projects=Project::all();
        if($projects->isEmpty())
        {
            DB::statement("ALTER TABLE projects AUTO_INCREMENT=1");
        }
        Project::create([
            'name'=>$input['name'],
        ]);
        return redirect('/projects')->with('message','New Project Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project=Project::find($id);
        return view('projects.edit')->with('project',$project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $input=$request->validate($request->rules());
        $project->update($input);
        return redirect('projects')->with('message','Project Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);
        return redirect('projects')->with('message','Project Deleted!');
    }
}
