@extends('layouts.appAdmin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <div class="col-md-6 no-padding">
                            Edit Menu ID {{$menu->id}}
                        </div>
                        <div class="col-md-6 no-padding">
                            <a href="{{route("menu.index")}}" class="pull-right text-primary">
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
                        @if(Session::get('status'))
                            <div class="alert alert-success">
                                {{Session::get('status')}}
                            </div>
                        @endif
                        <form action="{{route('menu.update',['id'=>$menu->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Enter name"
                                       value="{!! old("name",$menu->name) !!}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Group</label>
                                @php
                                    $groupTem = old('group',optional($menu)->group);
                                @endphp
                                <select class="form-control" name="group" value="{{$groupTem}}">
                                    @foreach ($groups as $group)
                                        <option value="{{$group['name']}}"
                                                @if($groupTem == $group['name']) selected @endif> {{$group["name"]}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                          rows="3">{!! old('description',$menu->description) !!}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
