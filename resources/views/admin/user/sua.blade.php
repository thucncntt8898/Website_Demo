@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                 {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thong bao'))
                        <div class="alert alert-success">
                            {{session('thong bao')}}
                        </div>
                        @endif
                        <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$user->name}}"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Đổi password</label>
                                <input class="form-control password" name="password" disabled />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại password</label>
                                <input class="form-control password" name="passwordAgain" disabled />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" disabled />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline"><input type="radio" name="quyen" value="0"
                                    @if($user->quyen==0) {{"checked"}}
                                    @endif
                                    >Thường</label>
                                 <label class="radio-inline"><input type="radio" name="quyen" value="1" @if($user->quyen==1) {{"checked"}}
                                    @endif>Admin</label>
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <br>
                                <img src="upload/avatar/{{$user->avatar}}" alt="Avatar" style="width:200px;height: 250px;">
                                <input type="file" name="avatar" class="form-control"
                                    >
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection
        @section('script')
        <script>
            $(document).ready(function(){
                $("#changePassword").change(function(){
                    if($(this).is(":checked"))
                    {
                        $('.password').removeAttr('disabled');
                    }
                    else
                    {
                        $(".password").attr('disabled','')
                    }
                });
            });

        </script>
        @endsection