<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

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
        return view('Backend.dashbord');
    }

    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
