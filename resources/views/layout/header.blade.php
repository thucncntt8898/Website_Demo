

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trangchu">Laravel Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="lienhe">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search" action="timkiem" method="GET">
                    @csrf
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Tìm kiếm" name="search">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm kiếm</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    @if(Auth::check())
                     <li>
                        <li class="dropdown" style="margin-top:-3.5px;width:160px">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <img src="upload/avatar/{{Auth::user()->avatar}}" alt="Avatar" style="width:30px;height:30px;border-radius: 20px;">&nbsp;{{Auth::user()->name}}</i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="information/{{Auth::user()->id}}"><i class="fa fa-user fa-fw"></i>Xem thông tin</a>
                            </li>
                            <li><a href="information/sua/{{Auth::user()->id}}"><i class="fa fa-gear fa-fw"></i>Sửa thông tin</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                            </li>
                        </ul>
                    <!-- /.dropdown-user -->
                        </li>
                    </li>
                        @if(Auth::user()->quyen==1)
                        <li>
                            <a href="admin">Quản trị</a>
                        </li>
                        @else
                        <li>
                            <a href="thembaiviet">Thêm bài viết</a>
                        </li>
                        @endif
                    <li>
                        <a href="logout">Đăng xuất</a>
                    </li>
                    @else
                    <li>
                        <a href="dangky">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap">Đăng nhập</a>
                    @endif
                </ul>
            </div>


            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
   