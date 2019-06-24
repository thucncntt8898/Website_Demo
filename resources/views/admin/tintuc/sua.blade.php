@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select name="TheLoai" class="form-control" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option
                                @if($tintuc->loaitin->theloai->id==$tl->id)  {{"selected"}}
                                @endif
                                    value="{{$tl->id}}"   >{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select name="LoaiTin" class="form-control" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}" @if($tintuc->loaitin->id==$lt->id) {{"selected"}}
                                @endif >{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}"/>
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" class="form-control" value='{{$tintuc->TomTat}}'>{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" name="NoiDung" id="demo" value="{{$tintuc->NoiDung}}">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình</label>
                                <p><img src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->Hinh}}"></p>
                                <input type="file" name="Hinh">
                            </div>
                             <div class="form-group">
                                <label>Nổi bật</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name='NoiBat' value="0" @if($tintuc->NoiBat==0) {{"checked"}} @endif>Không</label>&nbsp;
                                <label><input type="radio" name='NoiBat' value="1" @if($tintuc->NoiBat==1) {{"checked"}} @endif>Có</label>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name='active' value="0" @if($tintuc->active==0) {{"checked"}} @endif>Không</label>&nbsp;
                                <label><input type="radio" name='active' value="1" @if($tintuc->active==1) {{"checked"}} @endif>Có</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>User</th>
                                <th>Nôi dung</th>
                                <th>Created at:</th>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->user->name}}
                                </td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td>
                                <a class="btn btn-primary" href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Xóa</button>
                            </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- /.container-fluid -->
        </div>
        @endsection
        @section('script')
        <script>
            $(document).ready(function(){
                $("#TheLoai").change(function(){
                    var idTheLoai=$(this).val();
                    $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                        $("#LoaiTin").html(data);
                    });
                });
            });
        </script>
        @endsection