<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\TinTuc;

class CommentController extends Controller
{
    public function getXoa($id,$idTinTuc)
    {
    	$comment=Comment::find($id);
    	$comment->delete();
    	return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thong bao','Success!');
    }
    public function postComment($id,Request $request)
    {
    	$idTinTuc=$id;
    	$tintuc=TinTuc::find($id);
    	$comment=new Comment;
    	$comment->idTinTuc=$idTinTuc;
    	$comment->idUSer=Auth::user()->id;
    	$comment->NoiDung=$request->NoiDung;
    	$comment->save();
    	return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thong bao','Binh luan thanh cong');
        // return json_encode($comment);

    }
    public function getDeleteComment($id)
    {
        $comment=Comment::find($id);
        $comment->delete();
        echo $id;
    }

}
