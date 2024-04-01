<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Page::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/pages/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Page.create',['data'=>$data]);
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
            'link_code' => "required|unique:pages,link_code,NULL,id,deleted_at,NULL",
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'required',
            'meta_descp' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'link_code' => $request->input('link_code'),
            'description' => $request->input('description'),
            'meta_title' => $request->input('meta_title'),
            'meta_descp' => $request->input('meta_descp'),
            'meta_keyword' => $request->input('meta_descp'),
            'status' => $request->input('status')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Page'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $save = Page::create($data);
        return redirect('/admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $Page = Page::find($id);
        // $Pagevarient = $Page->PageVarient();
        // dd($Pagevarient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Page::where('id', $id)->first();
        return view('Admin.Page.create',['data'=>$data]);
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
            'link_code' => "required|unique:pages,link_code,{$id},id,deleted_at,NULL",
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'required',
            'meta_descp' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'link_code' => $request->input('link_code'),
            'description' => $request->input('description'),
            'meta_title' => $request->input('meta_title'),
            'meta_descp' => $request->input('meta_descp'),
            'meta_keyword' => $request->input('meta_descp'),
            'status' => $request->input('status')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Blog'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $save = Page::where('id',$id)->update($data);
        return redirect('/admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catg = Page::where('id',$id)->first();
        $catg->delete();
    }
}
