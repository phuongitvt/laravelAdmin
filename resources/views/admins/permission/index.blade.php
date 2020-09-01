@extends('layouts.appAdmin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold row">
                    <div class="col-md-6">
                        Menu
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create Menu</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Group</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$oermission->name}}</td>
                                <td>{{$oermission->slug}}</td>
                                <td>{{$oermission->description}}</td>
                                <td>{{$oermission->created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary rounded">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
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
