<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login</title>
  <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    .invalid-feedback{
      margin-top:-20px;
      margin-bottom:3px;
    }
    #pwd{
      margin-bottom:4px;
    }
    #submissionButton{
      margin-top:5px;
    }
    </style>
</head>
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{session()->get('error')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session()->get('message')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<body class="bg-secondary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <form action="{{ route('login.check') }}" method="post">
                    @csrf
                    @method('post')
                    @if(session()->has('loginAgain')||session()->has('credentials'))
                    <label>Enter your Email</label></br>
                    <input type="email" name="email" class="form-control is-invalid " placeholder="your@email.com" required></br>
                    <label>Enter your Password</label></br>
                    <input type="password" name="password" class="form-control is-invalid" placeholder="password" required></br>
                    @if(session()->has('loginAgain'))
                    <div class="invalid-feedback">too many failed attempts to login please try again after {{session()->get('loginAgain')->diffInSeconds(now())}} seconds</div>
                    @elseif(session()->has('credentials'))
                    <div class="invalid-feedback">{{session()->get('credentials')}}</div>
                    @endif
                    @else
                    <label>Enter your Email</label></br>
                    <input type="email" name="email" class="form-control" placeholder="your@email.com" required></br>
                    <label>Enter your Password</label></br>
                    <input type="password" id="pwd" name="password" class="form-control" placeholder="password" required></br>
                    @endif
                    <button type="submit" id="submissionButton" class="btn btn-success">Login</button>
                    <a href="{{ route('signup') }}" class="btn btn-outline-success   mr-auto" title="Add a New User">Sign up</a>
                    </br></br>
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