@extends('layouts.appAdmin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <div class="col-md-6 no-padding">
                            Create Permission
                        </div>
                        <div class="col-md-6 no-padding">
                            <a href="{{route("slug.index")}}" class="pull-right text-primary">
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
                        <form action="{{route('slug.createProcess')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Enter name" value="{{ old('name') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
