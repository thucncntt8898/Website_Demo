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
                        <form action="information/sua/{{$user['id']}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$user['name']}}"/>
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
                                <input type="email" class="form-control" name="email" value="{{$user['email']}}" disabled />
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <br>
                                <img src="upload/avatar/{{$user['avatar']}}" alt="Avatar" style="width:200px;height: 250px;">
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Sửa</button>
                            </div>
                        </form>
                        <hr>
                            <div class="form-group">
                                <label>Comment</label>
                                @foreach($comment as $cm)
                                <ul name="comment" style="list-style-type: none;font-size:14px;" id="comment">
                                    <li value="{{$cm->id}}" id="{{$cm->id}}">
                                        <label for="TinTuc">Tiêu đề : </label>
                                        <a >{{$cm->tintuc->TieuDe}} &nbsp;=> <a href="tintuc/{{$cm->tintuc->id}}/{{$cm->tintuc->TieuDeKhongDau}}.html" style="font-size:16px;font-style: italic">Xem bài viết</a></a><br>
                                        <label for="Comment">Comment : </label>
                                        <p>{{$cm->NoiDung}}</p>
                                        <button type="button" class="btn btn-warning deleteRecord" data-id="{{$cm->id}}" >Xóa comment</button>
                                        <hr>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                    </div>
                </div>

            </div>

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
            $('.deleteRecord').click(function(){
                 var id=$(this).data("id");
                 var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                {
                    url:"information/comment/xoa/"+id,
                    type:"GET",
                    dataType:"JSON",
                    data:{"id":id,"_token": token,},
                    success:function(data){
                        var el=document.getElementById(data);
                        el.remove();
                    }
                });

            });



        </script>
        @endsection