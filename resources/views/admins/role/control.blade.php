@extends('layouts.appAdmin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    <div class="col-md-6 no-padding">
                        Add permissions for Role
                    </div>
                    <div class="col-md-6 no-padding">
                        <a href="{{route("role.index")}}" class="pull-right text-primary">
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
                    <form action="{{route('role.createProcess')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                   placeholder="Enter name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group row" style="overflow: hidden">
                            <h4 style="margin: 5px 0;" class="col-md-12">Permissions</h4>
                            <div class="form-group col-sm-5">
                                <select multiple class="form-control" style="height: 300px" id="permissionNotShow">
                                    @foreach ($permissions as $permission)
                                        <option value="{{$permission['id']}}">{{$permission['full_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2" style="margin: auto">
                                <button type="button" class="btn btn-block btn-outline-info"
                                        onclick="getPermission(this,'{{url("/role/addPermission/{$role["id"]}")}}')"
                                        style="margin: 5px">Add
                                </button>
                                <button type="button" class="btn btn-block btn-outline-danger" style="margin: 5px"
                                        onclick="destroyPermission(this,'{{url("/role/removePermission/{$role["id"]}")}}')">
                                    Remove
                                </button>
                            </div>
                            <div class="form-group col-sm-5">
                                <select multiple class="form-control border-info" style="height: 300px" id="permissionShow">
                                    @foreach ($permissionNows as $item1)
                                        <option value="{{$item1['id']}}">{{$item1['full_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="margin-top: 10px"></div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function getPermission(e,link) {
            const arrSelect = $('#permissionNotShow').val();

            if(arrSelect.length>0){
                arrSelect.forEach(function (item) {
                    const selectNow = $("#permissionNotShow").find("option[value='"+item+"']");
                    selectNow.remove();
                    if(selectNow.length>0){
                        let str = '<option value="'+item+'">'+selectNow.text()+'</option>';
                        $('#permissionShow').append(str);
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

        function destroyPermission(e,link) {
            const arrSelect = $('#permissionShow').val();

            if (arrSelect.length > 0) {
                arrSelect.forEach(function (item) {
                    const selectNow = $("#permissionShow").find("option[value='" + item + "']");
                    selectNow.remove();
                    if (selectNow.length > 0) {
                        let str = '<option value="' + item + '">' + selectNow.text() + '</option>';
                        $('#permissionNotShow').append(str);
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
