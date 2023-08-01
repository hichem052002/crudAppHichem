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
            <h1 class="mt-4" style="text-align:center;">Users</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key=>$item)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>{{$item->roles[0]->name}}</td>
                                <td>
                                    <form method="POST" action="{{ url('/users/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete user" onclick="return confirm('&quot;Confirm delete?&quot;')">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
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