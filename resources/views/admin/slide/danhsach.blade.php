 @extends('admin.layout.index')
@section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                @if(session('thong bao'))
                        <div class="alert alert-success">
                            {{session('thong bao')}}
                        </div>
                        @endif
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Nôi dung</th>
                                <th>Hình</th>
                                <th>Link</th>
                                <td>Delete</td>
                                <td>Edit</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $sd)
                            <tr class="odd gradeX" align="center">
                                <td>{{$sd->id}}</td>
                                <td>{{$sd->Ten}}
                                </td>
                                <td>{{$sd->NoiDung}}</td>
                                <td><img src="upload/slide/{{$sd->Hinh}}" alt="" style="width: 300px;height: 100px;"></td>
                                <td><a href="{{$sd->link}}">{{$sd->link}}</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$sd->id}}">Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sd->id}}">Edit</a></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection