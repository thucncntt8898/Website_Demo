 @extends('admin.layout.index')
@section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Danh sách</small>
                        </h1>
                    </div>
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
                                <td>Hiển thị</td>
                                <td>Delete</td>
                                <td>Edit</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}
                                    <a href="admin/doc/{{$tt->id}}" target="_blank">Xem chi tiết</a>
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
                                <td>@if($tt->active===0)
                                    {{"Khong"}}
                                    @else
                                    {{"Co"}}
                                @endif</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Edit</a></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection