<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SubCategory;
use App\Models\Category;
use DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::latest()
                ->select('sub_category.id','category.name as catg_name','sub_category.name','sub_category.updated_at','sub_category.created_at','sub_category.status')
                ->leftJoin('category', 'category.id', '=', 'sub_category.category_id')
                ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/sub-categorys/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.SubCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $catgs = Category::all();
        return view('Admin.SubCategory.create',['data'=>$data,'catgs'=>$catgs]);
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
            'name' => "required|unique:sub_category,name,NULL,id,deleted_at,NULL",
            'lineup' => 'required|integer',
            'status' => 'required',
            'link_code' => 'required|unique:sub_category',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->input('name'),
            'lineup' => $request->input('lineup'),
            'status' => $request->input('status'),
            'link_code' => $request->input('link_code'),
            'category_id' => $request->input('category_id')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Category'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        SubCategory::create($data);
        return redirect('/admin/sub-categorys');
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
        $data = SubCategory::where('id', $id)->first();
        $catgs = Category::all();
        return view('Admin.SubCategory.create',['data'=>$data,'catgs'=>$catgs]);
    }

    public function ajaxSubcat(Request $request){
        $cat_id = $request->input('cat_id');
        $data = SubCategory::where('category_id', $cat_id)->select('id','name')->get();
        return response()->json($data);
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
            'name' => "required|unique:sub_category,name,{$id},id,deleted_at,NULL",
            'lineup' => 'required|integer',
            'status' => 'required|integer',
            'link_code' => 'required|unique:sub_category,link_code,'.$id,
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->input('name'),
            'lineup' => $request->input('lineup'),
            'status' => $request->input('status'),
            'link_code' => $request->input('link_code')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Category'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $subcatg = SubCategory::where('id',$id)->update($data);
        return redirect('/admin/sub-categorys');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcatg = SubCategory::where('id',$id)->first();
        $subcatg->delete();
    }
}
