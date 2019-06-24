<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
    //
    public function getDanhSach(){
    	$slide=Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem(){
    	return view('admin.slide.them');
    }
    public function postThem(Request $request)
    {

        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',
        ],[
            'Ten.required'=>'Ban chua nhap ten slide',
            'NoiDung.required'=>'Ban chua nhap noi dung slide',
        ]);
        $slide=new Slide;
        $slide->Ten=$request->Ten;
        $slide->NoiDung=$request->NoiDung;
        if($request->has('link'))
            $slide->link=$request->link;
        if($request->hasFile('Hinh'))
        {
            $file=$request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                // alert('Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
                return redirect('admin/slide/them')->with('thong bao','Loi! Ban chi duoc chon file co duoi la jpg, png va jpeg.');
            }
            $name=$file->getClientOriginalName();
            $Hinh=str_random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh));
            {
                $Hinh=str_random(4)."_".$name;
            }
            $file->move('upload/slide',$Hinh);
            $slide->Hinh=$Hinh;
            // echo $Hinh;
        }
        else
        {
            $slide->Hinh="";
        }

        $slide->save();
        return redirect('admin/slide/them')->with('thong bao','Success!');
    }
    public function getSua($id){
        $slide=Slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required'
        ],[
            'Ten.required'=>'Ban chua nhap ten slide',
            'NoiDung.required'=>'Ban chua nhap noi dung slide!'
        ]);
        $slide=Slide::find($id);
        $slide->Ten=$request->Ten;
        $slide->NoiDung=$request->NoiDung;
        if($request->has('link'))
            $slide->link=$request->link;
        if($request->hasFile('Hinh'))
        {
            $file=$request->Hinh;
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                return redirect('admin/slide/sua/{{$id}}')->with('thong bao','Loi! Ban chi duoc chon file co duoi jpg, png hoac jpeg!');
            }
                $name=$file->getClientOriginalName();
                $Hinh=str_random(4)."".$name;
                while(file_exists("upload/slide/".$Hinh))
                {
                    $Hinh=str_random(4)."_".$Hinh;
                }
                unlink("upload/slide/".$slide->Hinh);
                $file->move('upload/slide');
                $slide->Hinh=$Hinh;

        }
        else
        {
            $request->Hinh="";
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thong bao','Success');
    }
    public function getXoa($id)
    {
       $slide=Slide::find($id);
       $slide->delete();
       return redirect('admin/slide/danhsach')->with('thong bao','success');
    }
}
