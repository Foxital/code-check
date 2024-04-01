<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/categorys/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Category.create',['data'=>$data]);
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
            'name' => "required|unique:category,name,NULL,id,deleted_at,NULL",
            'lineup' => 'required|integer',
            'status' => 'required',
            'featured' => 'required',
            'link_code' => "required|unique:category,link_code,NULL,id,deleted_at,NULL",
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->input('name'),
            'lineup' => $request->input('lineup'),
            'status' => $request->input('status'),
            'featured' => $request->input('featured'),
            'link_code' => $request->input('link_code')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Category'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        Category::create($data);
        return redirect('/admin/categorys');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Category::where('id', $id)->first();
        return view('Admin.Category.create',['data'=>$data]);
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
            'name' => "required|unique:category,name,{$id},id,deleted_at,NULL",
            'lineup' => 'required|integer',
            'status' => 'required|integer',
            'featured' => 'required',
            'link_code' => "required|unique:category,link_code,{$id},id,deleted_at,NULL",
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->input('name'),
            'lineup' => $request->input('lineup'),
            'status' => $request->input('status'),
            'featured' => $request->input('featured'),
            'link_code' => $request->input('link_code')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Category'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $catg = Category::where('id',$id)->update($data);
        return redirect('/admin/categorys');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catg = Category::where('id',$id)->first();
        $catg->delete();
    }
}
