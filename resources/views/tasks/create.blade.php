<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Create Task</title>
  <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    #submissionButton {
      margin-left: auto;
    }
    .invalid-feedback{
      margin-bottom:-25px;
    }
  </style>
</head>

<body class="bg-secondary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Create Task</h3>
                </div>
                <div class="card-body">
                  @if(!$projects->isEmpty()&&!$users->isEmpty())
                  <form action="{{route('tasks.store',['admin'=>Auth::user()])}}" method="post">
                    @csrf
                    @method('post')
                    <div class="row mb-3">
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('name') is-invalid @enderror" id="taskName" name="name" type="text" placeholder="Name" value="{{old('name')}}" required />
                      <label for="projectName">Task's Name</label>
                      @error('name')
                      <div class="invalid-feedback" >{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <select class="form-control @error('project_id') is-invalid @enderror" id="projectId" name="project_id" required />
                      <option selected disabled value="">Select a Project</option>
                      @foreach($projects as $project)
                      <option value="{{$project->id}}" {{old('project_id')==$project->id?'selected':''}}>{{$project->name}}</option>
                      @endforeach
                      </select>
                      <label for="projectId">Projects</label>
                      @error('project_id')
                      <div class="invalid-feedback" >{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <select class="form-control @error('user_id') is-invalid @enderror" id="userId" name="user_id" required />
                      <option selected disabled value="">Select a User</option>
                      @foreach($users as $user)
                      <option value="{{$user->id}}" {{old('user_id')==$user->id?'selected':''}}>{{$user->name}}</option>
                      @endforeach
                      </select>
                      <label for="projectId">Users</label>
                      @error('user_id')
                      <div class="invalid-feedback" >{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="row mb-3">
                    </div>
                    <div class="mt-4 mb-0">
                      <div class="d-flex "><a href="{{route('tasks.indexUser',['role'=>'Admin','user'=>Auth::user()])}}"><button type="button" class="btn btn-warning ">Back</button></a><button id="submissionButton" type="submit" class="btn btn-success">Create Task</button></div>
                    </div>
                    <hr>
                  </form>
                  @else
                  @if($projects->isEmpty()&&$users->isEmpty())
                  <label name="nothing">No Projects Nor Users are in Store ..Cannot Create a Task!!</label></br>
                  @elseif($users->isEmpty())
                  <label name="no projects">No Users Registered..Cannot Create a Task!</label></br>
                  @elseif($projects->isEmpty())
                  <label name="no users">No Projects in Store..Cannot Create a Task!!</label></br>
                  @endif
                  <hr>
                  <a href="{{route('tasks.indexUser',['role'=>'Admin','user'=>Auth::user()])}}"><button type="button" class="btn btn-warning ">Back</button></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{asset('assets/js/scripts.js')}}"></script>
</body>

</html>