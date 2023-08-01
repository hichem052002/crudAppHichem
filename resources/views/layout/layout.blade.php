<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>To Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .fa-trash,.fa-pencil,.fa-plus {
            margin-right: 5px;
        }
        #edit{
            margin-right:5px;
        }
    </style>
</head>


<body class="sb-nav-fixed" id="bout">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" id="refreshButton" href="">To Do App</a>
        <!-- Sidebar Toggle-->
        @if(Auth::user()->roles->first()->name=='Admin')
        <button type="button" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!" onclick="getElementById('bout').className=='sb-nav-fixed sb-sidenav-toggled'?getElementById('bout').className='sb-nav-fixed':getElementById('bout').className='sb-nav-fixed sb-sidenav-toggled';"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        @endif
        <ul class="navbar-nav form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('users.edit',['role'=>Auth::user()->roles->first()->name,'user'=>Auth::user()])}}">Edit Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                @if(Auth::user()->roles->first()->name=='Admin')
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link collapsed" href="{{route('projects.index')}}" data-bs-toggle="collapse" data-bs-target="#collapseProjects" aria-expanded="false" aria-controls="collapseProjects">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Projects
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        @if(Route::currentRouteName()=='projects.index')
                        <div class="collapse show" id="collapseProjects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('projects.index')}}">View Table</a>
                                <a class="nav-link" href="{{route('projects.create')}}"><span class="fa fa-plus"></span>Add Project</a>
                            </nav>
                        </div>
                        @else
                        <div class="collapse" id="collapseProjects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('projects.index')}}">View Table</a>
                                <a class="nav-link" href="{{route('projects.create')}}"><span class="fa fa-plus"></span>Add Project</a>
                            </nav>
                        </div>
                        @endif
                        <a class="nav-link collapsed" href="{{route('tasks.indexUser',['role'=>Auth::user()->roles->first()->name,'user'=>Auth::user()])}}" data-bs-toggle="collapse" data-bs-target="#collapseTasks" aria-expanded="false" aria-controls="collapseTasks">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Tasks
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        @if(Route::currentRouteName()=='tasks.indexUser')
                        <div class="collapse show" id="collapseTasks" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('tasks.indexUser',['role'=>Auth::user()->roles->first()->name,'user'=>Auth::user()])}}">View Table</a>
                                <a class="nav-link" href="{{route('tasks.create',['admin'=>Auth::user()])}}"><span class="fa fa-plus"></span>Add Task</a>
                            </nav>
                        </div>
                        @else
                        <div class="collapse" id="collapseTasks" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('tasks.indexUser',['role'=>Auth::user()->roles->first()->name,'user'=>Auth::user()])}}">View Table</a>
                                <a class="nav-link" href="{{route('tasks.create',['admin'=>Auth::user()])}}"><span class="fa fa-plus"></span>Add Task</a>
                            </nav>
                        </div>
                        @endif
                        <a class="nav-link collapsed" href="{{route('users.index')}}" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        @if(Route::currentRouteName()=='users.index')
                        <div class="collapse show" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('users.index')}}">View Table</a>
                                <a class="nav-link" href="{{route('users.register')}}"><span class="fa fa-plus"></span>Add User</a>
                            </nav>
                        </div>
                        @else
                        <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('users.index')}}">View Table</a>
                                <a class="nav-link" href="{{route('users.register')}}"><span class="fa fa-plus"></span>Add User</a>
                            </nav>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{Auth::user()->name}}
                </div>
            </nav>
        </div>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/datatables-simple-demo.js')}}"></script>
</body>

</html>