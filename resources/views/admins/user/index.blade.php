@extends('layouts.appAdmin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold row">
                    <div class="col-md-6">
                        Users
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('user.create')}}" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create User</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$user->user_name}}</td>
                                <th scope="col">
                                    @php
                                    $temp = $user->role;
                                    echo($temp?$temp->name:"");
                                    @endphp
                                </th>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>
                                    <a href="{{route('user.edit',['id'=>$user->id])}}" class="d-inline-block">
                                        <button type="button" class="btn btn-primary rounded">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('user.control',['id'=>$user->id])}}" class="d-inline-block">
                                        <button type="button" class="btn btn-primary rounded">
                                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
