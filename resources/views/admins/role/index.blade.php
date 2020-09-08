@extends('layouts.appAdmin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold row">
                    <div class="col-md-6">
                        Roles
                    </div>
                    <div class="col-md-6">
                        <a href="{{route("role.create")}}" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create Role</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(Session::get('status'))
                        <div class="alert alert-success">
                            {{Session::get('status')}}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td>{{$role->name}}</td>
                                <td>{{$role->created_at}}</td>
                                <td>
                                    <a href="{{route('role.delete',['id'=>$role->id])}}"
                                       onclick="return confirm('Are you sure?')" class="d-inline-block">
                                        <button type="button" class="btn btn-danger rounded">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('role.control',['id'=>$role->id])}}" class="d-inline-block">
                                        <button type="button" class="btn btn-primary rounded">
                                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{$roles->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
