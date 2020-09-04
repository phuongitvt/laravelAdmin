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
                        <a href="{{route("menu.create")}}" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create Menu</button>
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
                            <th scope="col">Group</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <th scope="row">{{$menu->id}}</th>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->group}}</td>
                                <td>{{$menu->description}}</td>
                                <td>{{$menu->created_at}}</td>
                                <td>
                                    <a href="{{route('menu.edit',['id'=>$menu->id])}}" class="d-inline-block">
                                        <button type="button" class="btn btn-primary rounded">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('menu.delete',['id'=>$menu->id])}}"
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
                        {{$menus->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
