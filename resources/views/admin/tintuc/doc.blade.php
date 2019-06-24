<!DOCTYPE html>
<html>
<head>
	<title>{{$tintuc->TieuDe}}</title>
	<base href="{{asset('')}}" target="_blank, _self, _parent, _top">
</head>
<body>
	<h1>{{$tintuc->TieuDe}}</h1>
	<img src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDe}}">
	<h3>Thể loại : {{$tintuc->loaitin->theloai->Ten}}</h3>
	<h3>Loại tin : {{$tintuc->loaitin->Ten}}</h3>
	<h3>Ngày viết : {{$tintuc->created_at}}</h3>
	<h3>{!!$tintuc->NoiDung!!}</h3>
</body>
</html>