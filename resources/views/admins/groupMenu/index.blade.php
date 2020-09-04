@extends('layouts.appAdmin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold row">
                    <div class="col-md-6">
                        Groups
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create Group</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Fix</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <th scope="row">{{$group->id}}</th>
                                <td>{{$group->name}}</td>
                                <td>{{$group->description}}</td>
                                <td>{{$group->fix}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
