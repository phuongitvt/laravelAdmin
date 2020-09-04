@extends('layouts.appAdmin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <div class="col-md-6 no-padding">
                            Create User
                        </div>
                        <div class="col-md-6 no-padding">
                            <a href="{{route("user.index")}}" class="pull-right text-primary">
                                Index
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @isset($status)
                            <div class="alert alert-danger">
                                {{$status}}
                            </div>
                        @endisset
                        <form action="{{route('user.update',['id'=>$user->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input name="user_name" type="text" class="form-control" disabled
                                       placeholder="Enter user name" required value="{{ old('user_name',$user->user_name) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input name="email" type="email" class="form-control" required aria-describedby="emailHelp"
                                       placeholder="Enter email" value="{{ old('email',$user->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input name="password" type="password" required class="form-control"
                                       placeholder="Enter pass">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input name="password_confirmation" type="password" required class="form-control"
                                       placeholder="Enter pass">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
