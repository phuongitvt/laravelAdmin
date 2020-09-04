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
                        <form action="{{route('slug.update',['id'=>$slug->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input name="name" type="text" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Enter name" value="{{ old('name',$slug->name) }}">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="txtPermission" onchange="resetValue(this)"
                                       placeholder="Permission name"
                                       aria-label="Permission name" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"
                                            onclick="addPermission(this,'{{ $slug->id }}','{{route("slug.addPermission")}}')"
                                            type="button">Add
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12" id="moreSection">
                                    @foreach ($slug->permissions as $permission)
                                        <div class="form-check col-sm-3 form-group no-padding">
                                            <label class="form-check-label"
                                                   for="exampleCheck1">{{$permission->name}}</label>
                                            <button type="button" class="btn-sm btn-danger d-inline-block"
                                                    data-link="{{route('slug.removePermission')}}"
                                                    onclick="removeNow(this,'{{$permission->id}}')">X
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function addPermission(e, id_slug, link) {
                let value = $("#txtPermission").val();
                if (value) {
                    const temp = $("label[value^='" + value + "']");
                    if (temp.length > 0) {
                        return alert("Has exit!");
                    }
                    $.ajax({
                        type: 'POST',
                        url: link,
                        headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
                        data: {
                            name: value,
                            id_slug: id_slug,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.success == true) {
                                let str = '<div class="form-check col-sm-3 form-group no-padding">\n' +
                                    ' <label value ="' + value + '" class="form-check-label" for="exampleCheck1">' + value + '</label>\n' +
                                    ' <button type="button" class="btn-sm btn-danger d-inline-block" data-link="{{route('slug.removePermission')}}" onclick="removeNow(this,' + data.id + ')">X</button>\n' +
                                    ' </div>';
                                $('#moreSection').append(str);
                            } else {
                                alert("Fail!");
                            }
                        }
                    });

                }
            };

            function removeNow(event, id) {
                const link = $(event).data('link');
                $.ajax({
                    type: 'POST',
                    url: link,
                    headers: {'X-CSRF-TOKEN': $("input[name='_token']").val()},
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success == true) {
                            $(event).parent().remove();
                        } else {
                            alert("Fail!");
                        }
                    }
                });

            }

            function resetValue(event) {
                let value = $(event).val();
                value = value.replace(" ", "");
                $(event).val(value);
            }
        </script>
    @endpush
@endsection


