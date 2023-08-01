            @extends('layout.layout')
            @section('content')

            <div id="layoutSidenav_content">
                <main>
                    @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{session()->get('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{session()->get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                    @endif
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style="text-align:center;">Projects</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $index=>$project)
                                        <tr>
                                            <td>{{++$index}}</td>
                                            <td>{{$project->name}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('projects.edit',['id'=>$project->id])}}" id="edit"><button class="btn btn-primary btn-sm "><span class="fa fa-pencil" ></span>Edit</button></a>
                                                    <form action="{{route('projects.delete',['id'=>$project->id])}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('confirm deletion');"><span class="fa fa-trash"></span>Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            @endsection