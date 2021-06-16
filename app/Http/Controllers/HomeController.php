<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
class HomeController extends Controller
{
    function index(Request $request){
    	if($request->has('q')){
    		$q=$request->q;
    		$posts=Post::where('title','like','%'.$q.'%')->orderBy('id','desc')->paginate(1);
    	}else{
    		$posts=Post::orderBy('id','desc')->paginate(1);
    	}
        return view('home',['posts'=>$posts]);
    }

    //post
    function detail(Request $request,$slug,$postId){
        Post::find($postId)->increment('view');
    	$detail=Post::find($postId);
    	return view('detail',['detail'=>$detail]);
    }
	function save_comment(Request $request,$slug,$id){
        $request->validate([
            'comment'=>'required'
        ]);
        $data=new Comment;
        $data->user_id=$request->user()->id;
        $data->post_id=$id;
        $data->comment=$request->comment;
        $data->save();
        return redirect('detail/'.$slug.'/'.$id)->with('success','Comment has been submitted.');
    }

    function category(Request $request,$cat_slug,$cat_id){
        $category=Category::find($cat_id);
        $posts=Post::where('cat_id',$cat_id)->orderBy('id','desc')->paginate(1);
        return view('category',['posts'=>$posts,'category'=>$category]);
    }

    // All Categories
    function all_category(){
        $categories=Category::orderBy('id','desc')->paginate(5);
        return view('categories',['categories'=>$categories]);
    }
}
