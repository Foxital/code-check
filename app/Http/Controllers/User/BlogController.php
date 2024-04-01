<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Blog, Page, BlogCategory};

class BlogController extends Controller
{
    public function index(Request $request){
        $data = [
            'meta_title'=>'Blog – Reyo',
            'meta_descp'=>"Know more about Organic Sanitary Pads. Reyo provides answers to your questions that you’re hesitate about. Feel Free to Ask!",
            'meta_keyword'=>"Best Sanitary Pads, Organic Sanitary Pads, Sanitary Pads Online"
        ];
        
       
        $blogcatgs = BlogCategory::orderBy('id', 'asc')
                    ->where('status', '1')
                    ->get();
  
        $blogs = [];
        $catgid = 0;
        if(isset($request->category)){
            foreach($blogcatgs as $catg){
                if($catg->link_code==$request->category){
                    $catgid = $catg->id;
                }
            }
        }
        
        if($catgid!=0){
            $blogs = Blog::latest()
            ->where('status', '1')
            ->where('category_id',$catgid)
            ->get();
        }else{
            $blogs = Blog::latest()
            ->where('status', '1')
            ->get();
        }
        
        return view('User.blog',['data'=>$data, 'blogs'=>$blogs, 'blogcatgs'=>$blogcatgs, 'cid'=>$catgid]);
    }
    public function blogDetails($linkcode){
        
      $blog = Blog::where('link_code', $linkcode)->first();
      
      $blogcatgs = BlogCategory::orderBy('id', 'asc')
                    ->where('status', '1')
                    ->get();
      
       $catgid = 0;
        if(isset($request->category)){
            foreach($blogcatgs as $catg){
                if($catg->link_code==$request->category){
                    $catgid = $catg->id;
                }
            }
        }
        
        $blogcatgs = BlogCategory::orderBy('id', 'asc')
                    ->where('status', '1')
                    ->get();
                    
        if($catgid!=0){
            $blogs = Blog::latest()
            ->where('status', '1')
            ->where('category_id',$catgid)
            ->limit(3)
            ->get();
        }else{
            $blogs = Blog::latest()
            ->where('status', '1')
            ->limit(3)
            ->get();
        }            
        
      if(isset($blog['name'])){
        return view('User.bloginner',['data'=>$blog,'blogcatgs'=>$blogcatgs, 'blogs'=>$blogs]);
      }else{
          return abort(404);
      }
    }
    public function pageView($linkcode){
      $blog= Page::where('link_code', $linkcode)->first();
      if(isset($blog['name'])){
        return view('User.page',['data'=>$blog]);
      }else{
          return abort(404);
      }
    }
}
