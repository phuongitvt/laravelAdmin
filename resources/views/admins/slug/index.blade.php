@extends('layouts.appAdmin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold row">
                    <div class="col-md-6">
                        Permissions
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('slug.create')}}" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create Permission</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($slugs as $slug)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$slug->name}}</td>
                                <td>
                                    @foreach ($slug->permissions as $permission)
                                        <span class="btn btn-outline-info">{{$permission->name}}</span>
                                    @endforeach

                                </td>
                                <td>{{$slug->created_at}}</td>
                                <td>
                                    <a href="{{route('slug.edit',['id'=>$slug->id])}}" class="d-inline-block">
                                        <button type="button" class="btn btn-primary rounded">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('slug.delete',['id'=>$slug->id])}}"
                                       onclick="return confirm('Are you sure?')" class="d-inline-block">
                                        <button type="button" class="btn btn-danger rounded">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{$slugs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
