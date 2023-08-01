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
        @if($role=='Admin')
        <div class="container-fluid px-4">
            <h1 class="mt-4" style="text-align:center;">Tasks</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Assigned to</th>
                                <th>Project</th>
                                <th>operations </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index=>$tab)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$tab['name']}}</td>
                                <td>{{$tab['user_name']}}</td>
                                <td>{{$tab['project_name']}}</td>
                                <td>
                                    <div class="d-flex"><a href="{{route('tasks.edit',['id'=>$tab['id'],'admin'=>Auth::user()])}}" class="btn btn-primary btn-sm " id="edit"><span class="fa fa-pencil"></span>Edit</a>
                                        <form action="{{route('tasks.delete',['id'=>$tab['id'],'admin'=>Auth::user()])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('confirm deletion ?');"><span class="fa fa-trash"></span>Delete</button>
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
        @elseif($role=='Visitor')
        <div class="container-fluid px-4">
            <h1 class="mt-4" style="text-align:center;">Tasks</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Project</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index=>$tab)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$tab->name}}</td>
                                <td>{{$tab->project->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </main>
</div>
@endsection