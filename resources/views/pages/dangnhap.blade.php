@extends('layout.index')
@section('content')
<div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">
				  		@if(count($errors)>0)
				  			<div class="alert alert-danger">
				  				@foreach($errors->all as $error)
				  				{{$error}}<br>
				  				@endforeach
				  			</div>
				  		@endif
				  		@if(session('thong bao'))
				  			 <div class="alert alert-success">
                            {{session('thong bao')}}
                        </div>
				  		@endif
				    	<form action="dangnhap" method="POST">
				    		@csrf
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="email" name="email"
							  	>
							</div>
							<br>
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="password">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    @endsection