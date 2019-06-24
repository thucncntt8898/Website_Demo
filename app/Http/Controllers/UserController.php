<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Comment;

use Auth;
class UserController extends Controller
{
    //
    public function getHome()
    {
        return view('admin.layout.index');
    }
    public function getDanhSach(){
    	$user=User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
    	return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
        $user=new User;
        $this->validate($request,[
            'name'=>'required|min:3|max:32|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>"required|min:3|max:16",
            'passwordAgain'=>"required|same:password"
        ],[
            'name.required'=>"Ban chua nhap ten nguoi dung",
            'name.min'=>"Ten nguoi dung phai co do dai 3-32 ky tu",
            'name.max'=>"Ten nguoi dung phai co do dai 3-32 ky tu",
            'name.unique'=>'Ten da ton tai',
            'email.required'=>"Ban chua nhap email",
            'email.unique'=>"Email da ton tai",
            'password.required'=>"Ban chua nhap password",
            'password.min'=>'Password phai co do dai 3-16 ky tu',
            'password.max'=>'Password phai co do dai 3-16 ky tu',
            'passwordAgain.required'=>'Nhap lai mat khau thieu',
            'passwordAgain.same'=>'Nhap lai mat khau khong khop'
        ]);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->quyen=$request->quyen;
        if($request->hasFile('avatar'))
        {
            $file=$request->file('avatar');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                // alert('Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
                return redirect('admin/avatar/them')->with('thong bao','Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
            }
            $name=$file->getClientOriginalName();
            $avatar=str_random(4)."_".$name;
            while(file_exists("upload/avatar/".$avatar));
            {
                $avatar=str_random(4)."_".$name;
            }
            $file->move('upload/avatar',$avatar);
            $user->avatar=$avatar;
            // echo $Hinh;
        }
        else
        {
            $avatar->avatar="default";
        }

        $user->save();
        return redirect('admin/user/danhsach')->with('thong bao','success');
    }
    public function getSua($id){
    	$user=User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
    	$user=User::find($id);
        $this->validate($request,[
            'name'=>'required|min:3|max:32',
        ],[
            'name.required'=>"Ban chua nhap ten nguoi dung",
            'name.min'=>"Ten nguoi dung phai co do dai 3-32 ky tu",
            'name.max'=>"Ten nguoi dung phai co do dai 3-32 ky tu"
        ]);
        $user->name=$request->name;
        $user->quyen=$request->quyen;
        if($request->changePassword=="on")
        {
            $this->validate($request,[
            'password'=>"required|min:3|max:16",
            'passwordAgain'=>"required|same:password"
        ],[
            'password.required'=>"Ban chua nhap password",
            'password.min'=>'Password phai co do dai 3-16 ky tu',
            'password.max'=>'Password phai co do dai 3-16 ky tu',
            'passwordAgain.required'=>'Nhap lai mat khau thieu',
            'passwordAgain.same'=>'Nhap lai mat khau khong khop'
        ]);
            $user->password=bcrypt($request->password);
        }
        if($request->hasFile('avatar'))
        {
            $file=$request->file('avatar');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                // alert('Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
                return redirect('admin/user/them')->with('thong bao','Loi! Ban chi duoc chon file co duoi la jpg, png va jpeg.');
            }
            $name=$file->getClientOriginalName();
            $avatar=str_random(4)."_".$name;
            while(file_exists("upload/avatar/".$avatar));
            {
                $avatar=str_random(4)."_".$name;
            }
            $file->move('upload/avatar',$avatar);
            // dd("upload/avatar/".$user->avatar);
            unlink("upload/avatar/".$user->avatar);
            $user->avatar=$avatar;
        }
        else
        {
            $user->avatar="default";
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thong bao','success');
    }
    public function getXoa($id)
    {
        $user=User::find($id);
        $comment=Comment::where('idUser',$id);
        $comment->delete();
        $user->delete();
        return redirect('admin/user/danhsach')->with('thong bao','Success');
    }
    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request)
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
            return redirect('admin/theloai/danhsach')->with('thong bao','Dang nhap thanh cong!');
        else
        {
            return redirect('admin/dangnhap')->with('thong bao','Dang nhap khong thanh cong!');
        }
    }
     public function getInformation($id)
    {
        $user=User::find($id);
         $comment=Comment::where('idUser',$id)->get(
        );
        return view('pages.information',['user'=>$user,'comment'=>$comment]);
    }
    public function getSuaInformation($id)
    {
        $user=User::find($id);
         $comment=Comment::where('idUser',$id)->get(
        );
        return view('pages.suaInformation',['user'=>$user,'comment'=>$comment]);
    }
    public function postSuaInformation($id,Request $request)
    {
        $user=User::find($id);
        $this->validate($request,[
            'name'=>'required|min:3|max:32',
        ],[
            'name.required'=>"Ban chua nhap ten nguoi dung",
            'name.min'=>"Ten nguoi dung phai co do dai 3-32 ky tu",
            'name.max'=>"Ten nguoi dung phai co do dai 3-32 ky tu"
        ]);
        $user->name=$request->name;
        if($request->changePassword=="on")
        {
            $this->validate($request,[
            'password'=>"required|min:3|max:16",
            'passwordAgain'=>"required|same:password"
        ],[
            'password.required'=>"Ban chua nhap password",
            'password.min'=>'Password phai co do dai 3-16 ky tu',
            'password.max'=>'Password phai co do dai 3-16 ky tu',
            'passwordAgain.required'=>'Nhap lai mat khau thieu',
            'passwordAgain.same'=>'Nhap lai mat khau khong khop'
        ]);
            $user->password=bcrypt($request->password);
        }
        if($request->hasFile('avatar'))
        {
            $file=$request->file('avatar');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg')
            {
                // alert('Loi! Ban chi duoc chon file co duoi la jpg, png vaf jpeg.');
                return redirect('admin/user/them')->with('thong bao','Loi! Ban chi duoc chon file co duoi la jpg, png va jpeg.');
            }
            $name=$file->getClientOriginalName();
            $avatar=str_random(4)."_".$name;
            while(file_exists("upload/avatar/".$avatar));
            {
                $avatar=str_random(4)."_".$name;
            }
            $file->move('upload/avatar',$avatar);
            // dd("upload/avatar/".$user->avatar);
            // unlink("upload/avatar/".$user->avatar);
            $user->avatar=$avatar;
        }
        else
        {
            $user->avatar="default.png";
        }
        $user->save();
        return redirect('trangchu')->with('thong bao','Success');

    }
    public function getDangxuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
