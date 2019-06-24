 @extends('admin.layout.index')
@section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Danh sách  chưa phê duyệt</small>
                        </h1>
                    </div>
                    @if(session('thong bao'))
                        <div class="alert alert-success">
                            {{session('thong bao')}}
                        </div>
                        @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th>Thể loại</th>
                                <th>Loại tin</th>
                                <td>Xem</td>
                                <td>Nổi bật</td>
                                <td>Phê duyệt</td>
                                <td>Đã xem</td>
                                <td>Xóa</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}<br>
                                    <a href="admin/doc/{{$tt->id}}">Xem chi tiết</a>
                                </td>
                                <td>{{$tt->TieuDe}}<br>
                                    <img src="upload/tintuc/{{$tt->Hinh}}" alt="{{$tt->tomtat}}" style="width: 100px;height: 100px;">
                                </td>
                                <td>{{$tt->TomTat}}</td>
                                <td>{{$tt->loaitin->theloai->Ten}}</td>
                                <td>{{$tt->loaitin->Ten}}</td>
                                <td>{{$tt->SoLuotXem}}</td>
                                <td>@if($tt->NoiBat===0)
                                    {{"Khong"}}
                                    @else
                                    {{"Co"}}
                                @endif</td>
                                <td class="center"></i><a href="admin/tintuc/listNotShow/pheduyet/{{$tt->id}}">Phê duyệt</a></td>
                                <td class="center"><a href="admin/tintuc/listNotShow/daxem/{{$tt->id}}">Đã xem</a></td>
                                <td class="center"><a href="admin/tintuc/listNotShow/xoa/{{$tt->id}}">Xóa</a></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection