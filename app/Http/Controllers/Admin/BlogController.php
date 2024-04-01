<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="/admin/blogs/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $catgs = BlogCategory::all();
        return view('Admin.Blog.create', ['data'=>$data,'catgs'=>$catgs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'link_code' => 'required|unique:blogs,link_code,NULL,id,deleted_at,NULL',
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'required',
            'meta_descp' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required',
            'featured' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'link_code' => $request->input('link_code'),
            'description' => $request->input('description'),
            'meta_title' => $request->input('meta_title'),
            'meta_descp' => $request->input('meta_descp'),
            'meta_keyword' => $request->input('meta_descp'),
            'featured' => $request->input('featured'),
            'status' => $request->input('status')
        ];

        if (isset($request->imagepv)&&$request->imagepv!='') {
            $data['image'] = $request->input('imagepv');
        } elseif (isset($request->image)) {
            $newImaegname = time() .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Blog'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $save = Blog::create($data);
        return redirect('/admin/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $Blog = Blog::find($id);
        // $Blogvarient = $Blog->BlogVarient();
        // dd($Blogvarient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Blog::where('id', $id)->first();
        $catgs = BlogCategory::all();
        return view('Admin.Blog.create', ['data'=>$data,'catgs'=>$catgs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'link_code' => "required|unique:blogs,link_code,{$id},id,deleted_at,NULL",
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'required',
            'meta_descp' => 'required',
            'meta_keyword' => 'required',
            'featured' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'link_code' => $request->input('link_code'),
            'description' => $request->input('description'),
            'meta_title' => $request->input('meta_title'),
            'meta_descp' => $request->input('meta_descp'),
            'meta_keyword' => $request->input('meta_descp'),
            'featured' => $request->input('featured'),
            'status' => $request->input('status')
        ];

        if (isset($request->imagepv)&&$request->imagepv!='') {
            $data['image'] = $request->input('imagepv');
        } elseif (isset($request->image)) {
            $newImaegname = time() .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Blog'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $save = Blog::where('id', $id)->update($data);
        return redirect('/admin/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catg = Blog::where('id',$id)->first();
        $catg->delete();
    }
}
