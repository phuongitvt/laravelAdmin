@extends('layouts.appAdmin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold row">
                    <div class="col-md-6">
                        Members
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="pull-right">
                            <button type="button" class="btn btn-primary rounded">Create Member</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$member->user_name}}</td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->created_at}}</td>
                                <td>{{$member->updated_at}}</td>
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
