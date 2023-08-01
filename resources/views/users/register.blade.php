<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Add User</title>
  <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    #submissionButton {
      margin-left: auto;
    }

    .invalid-feedback {
      margin-bottom: -25px;
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
                  <h3 class="text-center font-weight-light my-4">Add User</h3>
                </div>
                <div class="card-body">
                  <form action="{{route('users.store')}}" method="post">
                    @csrf
                    @method('post')
                    <div class="row mb-3">
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('name') is-invalid @enderror" id="userName" name="name" type="text" placeholder="Name" value="{{old('name')}}" required />
                      <label for="userName">Name</label>
                      @error('name')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('email') is-invalid @enderror" id="userEmail" name="email" type="email" placeholder="Email" value="{{old('email')}}" required />
                      <label for="userEmail">Email</label>
                      @error('email')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('phone_number') is-invalid @enderror" id="userPhone" name="phone_number" " type=" number" value="{{old('phone_number')}}" required placeholder="Phone Number" />
                      <label for="userPhone">Phone Number</label>
                      @error('phone_number')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <select id="userRole" class="form-control @error('role') is-invalid @enderror" name="role" placeholder="Role" required>
                        <option disabled selected value="">User</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{$role->id==old('role')?'selected':''}}>{{$role->name}}</option>
                        @endforeach
                      </select>
                      <label for="userRole">Role</label>
                      @error('role')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('password') is-invalid @enderror" id="userPwd" name="password" type="password" placeholder="Password" value="{{old('password')}}" required />
                      <label for="userPwd">Password</label>
                      @error('password')
                      @if($message!='the confirmation field doesn\'t match')
                      <div class="invalid-feedback">{{$message}}</div>
                      @endif
                      @enderror
                    </div>
                    <br>
                    <div class="form-floating mb-3">
                      <input class="form-control @error('password') is-invalid @enderror" id="userPwdConfirmation" name="password_confirmation" type="password" placeholder="Confirm Password" value="{{old('password_confirmation')}}" required />
                      <label for="userPwdConfirmation">Password Confirmation</label>
                      @error('password')
                      @if($message=='the confirmation field doesn\'t match')
                      <div class="invalid-feedback">{{$message}}</div>
                      @endif
                      @enderror
                    </div>
                    <br>
                    <div class="row mb-3">
                    </div>
                    <div class="mt-4 mb-0">
                      <div class="d-flex "><a href="{{route('users.index')}}"><button type="button" class="btn btn-warning ">Back</button></a><button id="submissionButton" type="submit" class="btn btn-success">Create User</button></div>
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