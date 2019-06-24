@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <label>Tên
                                </label>
                                <input type="text" name="Ten" class="form-control" value="{{$slide->Ten}}">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <input class="form-control" name="NoiDung"  value="{{$slide->NoiDung}}" />
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="url" class="form-control" name="link" value="{{$slide->link}}" />
                            </div>
                             <div class="form-group">
                                <label>Hình</label>
                                <p><img src="upload/slide/{{$slide->Hinh}}" alt="{{$slide->NoiDung}}" style="width:800;height: 300px;"></p>
                                <input type="file" class="form-control" name="Hinh"  />
                            </div>
                            <button type="submit" class="btn btn-default">Slide Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection