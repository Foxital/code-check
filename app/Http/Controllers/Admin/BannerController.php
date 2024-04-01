<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/banners/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Banner.create',['data'=>$data]);
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
            'lineup' => 'required|integer',
            'status' => 'required',
            'link_code' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            $dd = $request->image->move(public_path('uploads/Banner'), $newImaegname);
            $data['image'] = $newImaegname;
        }
        
        if(isset($request->imagepv1)&&$request->imagepv1!=''){
            $data['image1'] = $request->input('imagepv1');
        }else if(isset($request->image1)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image1->extension();
            $dd = $request->image1->move(public_path('uploads/Banner'), $newImaegname);
            $data['image1'] = $newImaegname;
        }

        Banner::create($data);
        return redirect('/admin/banners');
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

        $data = Banner::where('id', $id)->first();
        return view('Admin.Banner.create',['data'=>$data]);
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
            'lineup' => 'required|integer',
            'status' => 'required|integer',
            'link_code' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            $dd = $request->image->move(public_path('uploads/Banner'), $newImaegname);
            $data['image'] = $newImaegname;
        }
        
        if(isset($request->imagepv1)&&$request->imagepv1!=''){
            $data['image1'] = $request->input('imagepv1');
        }else if(isset($request->image1)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image1->extension();
            $dd = $request->image1->move(public_path('uploads/Banner'), $newImaegname);
            $data['image1'] = $newImaegname;
        }

        Banner::where('id',$id)->update($data);
        return redirect('/admin/banners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Banner::where('id',$id)->first();
        $data->delete();
    }
}
