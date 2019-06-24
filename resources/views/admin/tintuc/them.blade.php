@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm</small>
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
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select name="TheLoai" class="form-control" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select name="LoaiTin" class="form-control" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" name="NoiDung" id="demo"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình</label>
                                <input type="file" name="Hinh">
                            </div>
                             <div class="form-group">
                                <label>Nổi bật</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name='NoiBat' value="0" checked>Không</label>&nbsp;
                                <label><input type="radio" name='NoiBat' value="1">Có</label>
                            </div>
                             <div class="form-group">
                                <label>Hiển thị</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <label><input type="radio" name='active' value="0" checked>Không</label>&nbsp;
                                <label><input type="radio" name='active' value="1">Có</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
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
                $("#TheLoai").change(function(){
                    var idTheLoai=$(this).val();
                    $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                        $("#LoaiTin").html(data);
                    });
                });
            });
        </script>
        @endsection