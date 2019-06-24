@extends('layout.index')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng ký</h3>
                    </div>
                    <div class="panel-body">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                 {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thong bao'))
                            {{session('thong bao')}}
                        @endif
                        <form role="form" action="dangky" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                	<label for="name">Tên</label>
                                    <input class="form-control" name="name" type="name">
                                </div>
                                <div class="form-group">
                                	<label for="email">
                                		Email
                                	</label>

                                    <input class="form-control" name="email" type="email">
                                </div>
                                <div class="form-group">
                                	<label for="password">Password</label>
                                    <input class="form-control" name="password" type="password">
                                </div>
                                <div class="form-group">
                                	<label for="againPassword">Nhập lại password</label>
                                    <input class="form-control" name="againPassword" type="password">
                                </div>
                                 <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input class="form-control" name="avatar" type="file">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đăng ký</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection