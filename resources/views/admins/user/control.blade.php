@extends('layouts.appAdmin')

@section('content')
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
                                       placeholder="Enter user name" required
                                       value="{{ old('user_name',$user->user_name) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Role</label>
                                <select class="form-control" name="group">
                                    @foreach ($roles as $role)
                                        <option value="{{$role['name']}}">{{$role['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="overflow: hidden">
                                <h4 style="margin: 5px 0">Menus show</h4>
                                <div class="border-primary table-bordered rounded col-md-12" style="padding: 10px">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect2">Example multiple select</label>
                                        <select multiple class="form-control" id="exampleFormControlSelect2">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect2">Example multiple select</label>
                                        <select multiple class="form-control" id="exampleFormControlSelect2">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 10px"></div>
                            <button type="submit" class="btn btn-primary d-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
