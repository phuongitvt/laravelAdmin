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
                    <form action="{{route('user.updateControl',['id'=>$user->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="user_name" type="text" class="form-control" disabled
                                   placeholder="Enter user name" required
                                   value="{{ old('user_name',$user->user_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{$role['id']}}" @if ($roleNow && $roleNow['id'] == $role['id']) selected @endif >{{$role['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row" style="overflow: hidden">
                            <h4 style="margin: 5px 0;" class="col-md-12">Menus</h4>
                            <div class="form-group col-sm-5">
                                <select multiple class="form-control" style="height: 300px" id="menuNotShow">
                                    @foreach ($menus as $menu)
                                        <option value="{{$menu['id']}}">{{$menu['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2" style="margin: auto">
                                <button type="button" class="btn btn-block btn-outline-info"
                                        onclick="getMenu(this,'{{route("user.addMenu",["id"=>$user["id"]])}}')" style="margin: 5px">Add</button>
                                <button type="button" class="btn btn-block btn-outline-danger" style="margin: 5px"
                                        onclick="destroyMenu(this,'{{route("user.removeMenu",["id"=>$user["id"]])}}')">Remove</button>
                            </div>
                            <div class="form-group col-sm-5">
                                <select multiple class="form-control border-info" style="height: 300px" id="menuShow">
                                    @foreach ($menuNows as $menuNow)
                                        <option value="{{$menuNow['id']}}">{{$menuNow['name']}}</option>
                                    @endforeach
                                </select>
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

@push('scripts')
    <script>
        function getMenu(e,link) {
            const arrSelect = $('#menuNotShow').val();

            if(arrSelect.length>0){
                arrSelect.forEach(function (item) {
                    const selectNow = $("#menuNotShow").find("option[value='"+item+"']");
                    selectNow.remove();
                    if(selectNow.length>0){
                        let str = '<option value="'+item+'">'+selectNow.text()+'</option>';
                        $('#menuShow').append(str);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: link,
                    headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
                    data: {
                        list: arrSelect,
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success == true) {
                        } else {
                        }
                    }
                });
            }
        };

        function destroyMenu(e,link) {
            const arrSelect = $('#menuShow').val();

            if (arrSelect.length > 0) {
                arrSelect.forEach(function (item) {
                    const selectNow = $("#menuShow").find("option[value='" + item + "']");
                    selectNow.remove();
                    if (selectNow.length > 0) {
                        let str = '<option value="' + item + '">' + selectNow.text() + '</option>';
                        $('#menuNotShow').append(str);
                    }
                })

                $.ajax({
                    type: 'POST',
                    url: link,
                    headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
                    data: {
                        list: arrSelect,
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success == true) {
                        } else {
                        }
                    }
                });
            }
        }
    </script>
@endpush
