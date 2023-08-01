<!-- @extends('layout.layout')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Project Editing</div>
    <div class="card-body">

      <form action="{{ route('projects.update',['project'=>$project]) }}" method="post">
        @csrf
        @method("put")
        <input type="hidden" name="id" value="{{$project->id}}" id="id" />
        <label>New Project Name</label></br>
        <input type="text" name="name" value="{{$project->name}}" class="form-control @error('name') is-invalid @enderror"></br>
        @error('name')
        <div class="invalid-feedback" style="margin-top:-20px;margin-bottom:1px;">{{$message}}</div>
        @enderror
        <input type="submit" value="Update" class="btn btn-success"></br></br>
        <a href="{{route('projects.index')}}"><button type="button" class="btn btn-warning">Return</button></a>
      </form>

    </div>
  </div>
</div>
@endsection -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Edit Project</title>
  <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                  <h3 class="text-center font-weight-light my-4">Create Project</h3>
                </div>
                <div class="card-body">
                  <form action="{{route('projects.update',['project'=>$project])}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                    </div>
                    <div class="form-floating mb-3">
                      <input type="hidden" value="{{$project->id}}">
                      <input class="form-control @error('name') is-invalid @enderror" id="projectName" name="name" type="text" placeholder="Name" value="{{$project->name}}" required />
                      <label for="projectName">New Project's Name</label>
                      @error('name')
                      <div class="invalid-feedback" style="margin-bottom:-25px;">{{$message}}</div>
                      @enderror
                    </div>
                    <div class="row mb-3">
                    </div>
                    <div class="mt-4 mb-0">

                      <div class="d-flex "><a href="{{route('projects.index')}}"><button type="button" class="btn btn-warning ">Back</button></a><button type="submit" class="btn btn-success " style="margin-left:auto;">Update Project</button></div>
                    </div>
                    <hr>
                  </form>
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