@extends('layout.index')
@section('content')

<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    <a href="#">By Admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $tintuc->NoiDung !!}</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
                    @if(session('thong bao'))
                        {{session('thong bao')}}
                    @endif
                    <!-- input type="hidden" name="idTinTuc" value="{{$tintuc->id}}"> -->
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="comment/{{$tintuc->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Gửi</button>
                    </form>
                </div>
                @endif
                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
                <div class="media">
                    <a class="pull-left" href="information">
                        <img class="media-object" src="upload/avatar/{{$cm->user->avatar}}" alt="Avatar" style="width:50px;height:50px;">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        </h4>
                        {{$cm->NoiDung}}
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinlienquan as $tintuc)
                        <div class="row" style="margin-top: 10px;padding: 10px;">
                            <div class="col-md-5">
                                <a>
                                    <img src="upload/tintuc/{{$tintuc->Hinh}}" alt="" style="width:80px;height:80px;">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html"><b>{{$tintuc->TieuDe}}</b></a>
                            </div>
                            <p style="font-weight: normal;">{{$tintuc->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->

                        <!-- item -->

                        <!-- end item -->
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinnoibat as $tintuc)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="">
                                    <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html"><b>{{$tintuc->TieuDe}}</b></a>
                            </div>
                            <p>{{$tintuc->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->

                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    @endsection
    