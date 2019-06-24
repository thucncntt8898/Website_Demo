<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Auth;
class PageController extends Controller
{
    //
    function __construct()
    {
    	$theloai=TheLoai::all();
    	$slide=Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);
    }
    function trangchu()
    {
    	return view('pages.trangchu');
    }
    function lienhe()
    {

    	return view('pages.lienhe');
    }
    function loaitin($id)
    {
    	$loaitin=LoaiTin::find($id);
    	$tintuc=TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function tintuc($id){
        $tintuc=TinTuc::find($id);
        $tinnoibat=TinTuc::where('NoiBat',1)->where('active',1)->take(4)->get();
        $tinlienquan=TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->where('active',1)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    function getDangnhap()
    {
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32'
        ],[
            'email.required'=>'Ban chua nhap email',
            'password.required'=>'Ban chua nhap password',
            'password.min'=>'Password khong duoc nho hon 3 ky tu',
            'password.max'=>'Password khong duoc lon hon 32 ky tu'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            return redirect('trangchu');
        else
        {
            return redirect('dangnhap')->with('thong bao','Dang nhap khong thanh cong!');
        }
    }
    function getDangXuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    function getthembaiviet()
    {
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();
        $tintuc=TinTuc::all();
        return view('pages.thembaiviet',['theloai'=>$theloai,'loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function postthembaiviet(Request $request)
    {
        $tintuc=new TinTuc;
        $this->validate($request,[
            'TieuDe'=>'required|min:3|unique:tintuc,TieuDe',
            'TomTat'=>'required|min:3',
            'NoiDung'=>'required'
        ],[
            'TieuDe.required'=>'Ban chua nhap tieu de',
            'TieuDe.min'=>'Tieu de phai nhieu hon 3 ky tu',
            'TieuDe.unique'=>'Tieu de da ton tai',
            'TomTat.required'=>'Ban chua nhap tom tat',
            'TomTat.min'=>'Tom tat phai nhieu hon 3 ky tu',
            'NoiDung.required'=>'Ban chua nhap noi dung'
        ]);
        $tintuc->TieuDe=$request->TieuDe;
        $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
        $tintuc->idLoaiTin=$request->LoaiTin;
        $tintuc->TomTat=$request->TomTat;
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->NoiBat=$request->NoiBat;
        $tintuc->active=0;
        $tintuc->DaXem=0;
        $tintuc->SoLuotXem=0;
         if($request->hasFile('Hinh'))
        {
            $file=$request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                // alert('Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
                return redirect('thembaiviet')->with('thong bao','Loi! Ban chi duoc chon file co duoi la jpg, png va jpeg.');
            }
            $name=$file->getClientOriginalName();
            $Hinh=str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh));
            {
                $Hinh=str_random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $tintuc->Hinh=$Hinh;
            // echo $Hinh;
        }
        else
        {
            $tintuc->Hinh="";
        }

        $tintuc->save();
        return redirect('trangchu')->with('thong bao','Success!');

    }
    function ajaxController($idTheLoai)
    {
        $loaitin=LoaiTin::where('idTheLoai',$idTheLoai)->get();
        foreach($loaitin as $lt)
        {
            echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
    }
    function getDangKy()
    {
        return view('pages.dangky');
    }
    function postDangKy(Request $request)
    {
        $user=new User;
        $this->validate($request,[
            'name'=>'required|min:3|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:16',
            'againPassword'=>'required|same:password'
        ],[
            'name.required'=>'Ban chua nhap ten',
            'name.min'=>'Ten phai nhieu hon 2 ky tu',
            'name.unique'=>'Ten da ton tai',
            'email.required'=>'Ban chua nhap email',
            'email.unique'=>'Email da ton tai',
            'password.required'=>'Ban chua nhap password',
            'password.min'=>'Password phai co do dai 3-16 ki tu',
            'password.max'=>'Password phai co do dai 3-16 ki tu',
            'againPassword.required'=>'Ban chua nhap lai password',
            'againPassword.same'=>'Nhap lai mat khau sai'
        ]);
        if($request->hasFile('avatar'))
        {
            $file=$request->file('avatar');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                // alert('Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
                return redirect('dangky')->with('thong bao','Loi! Ban chi duoc chon file co duoi la jpg, png va jpeg.');
            }
            $name=$file->getClientOriginalName();
            $avatar=str_random(4)."_".$name;
            while(file_exists("upload/avatar/".$avatar));
            {
                $avatar=str_random(4)."_".$name;
            }
            $file->move('upload/avatar',$avatar);
            // dd("upload/avatar/".$user->avatar);
            $user->avatar=$avatar;
        }
        else
        {
            $user->avatar="default";
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->quyen=0;
        $user->save();
        return redirect('dangnhap')->with('thong bao','Dang ky thanh cong. Mời bạn đăng nhập!');
    }
    function getTimKiem(Request $request)
    {
        $tintuc=$request->search();
        return redirect('pages/timkiem');
    }
}
