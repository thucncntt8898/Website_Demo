@extends('layout.index')
@section('content')
<div id="page-wrapper" style="margin-left: 600px;">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thông tin cá nhân</small>
                        </h1>
                    </div>
                   
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
                        <form>
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$user['name']}}" disabled />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control password" name="password" value="{{$user['password']}}" disabled />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user['email']}}" disabled />
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <br>
                                <img src="upload/avatar/{{$user['avatar']}}" alt="Avatar" style="width:200px;height: 250px;" disabled>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>

                                <ul name="comment" style="list-style-type: none;font-size:14px;">
                                    @foreach($comment as $cm)
                                    <li value="{{$cm->id}}" id={{$cm->id}}>
                                        <label for="TinTuc">Tiêu đề : </label>
                                        <a >{{$cm->tintuc->TieuDe}} &nbsp;=> <a href="tintuc/{{$cm->tintuc->id}}/{{$cm->tintuc->TieuDeKhongDau}}.html" style="font-size:16px;font-style: italic">Xem bài viết</a></a><br>
                                        <label for="Comment">Comment : </label>
                                        <p>{{$cm->NoiDung}}</p>
                                        <hr>
                                    </li>
                                     @endforeach
                                </ul>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
@endsection
@section('script')
@endsection