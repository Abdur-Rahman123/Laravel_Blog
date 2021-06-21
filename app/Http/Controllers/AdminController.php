<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;


class AdminController extends Controller
{
    function login(){
        return view('Backend.login');
    }
    //submit login
    function submit_login(Request $request){
    $request->validate([
        'username'=>'required',
        'password'=>'required'
    ]);
    $userCheck=Admin::where(['username'=> $request->username,'password'=>$request->password])->count();
    if($userCheck>0){
        //$adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->get();
            $adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->first();
            session(['adminData'=>$adminData]);
        return redirect('admin/dashbord');
    }else{
        return redirect('admin/login')->with('errors','Invalid Username or password');
    }
    }
    //dashbord
    function dashbord(){
        $posts=Post::orderBy('id','desc')->get();
    	return view('Backend.dashbord',['posts'=>$posts]);
    }

    // Show all users
    function users(){
        $data=User::orderBy('id','desc')->get();
        return view('Backend.user.index',['data'=>$data]);
    }

    public function delete_user($id)
    {
        User::where('id',$id)->delete();
        return redirect('admin/user');
    }

    // Show all comments
    function comments(){
        $data=Comment::orderBy('id','desc')->get();
        return view('Backend.comment.index',['data'=>$data]);
    }

    public function delete_comment($id)
    {
        Comment::where('id',$id)->delete();
        return redirect('admin/comment');
    }

    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
