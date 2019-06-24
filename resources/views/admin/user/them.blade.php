@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                            @csrf
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
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name"/>
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="file" class="form-control" name="avatar"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password"/>
                            </div>
                            <div class="form-group">
                                <label>Nhập lại password</label>
                                <input class="form-control" name="passwordAgain"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"/>
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline"><input type="radio" name="quyen" value="0">Thường</label>
                                 <label class="radio-inline"><input type="radio" name="quyen" value="1">Admin</label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection