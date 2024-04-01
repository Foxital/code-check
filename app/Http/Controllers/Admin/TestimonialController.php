<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use DataTables;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/testimonials/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Testimonial.create',['data'=>$data]);
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
            'type' => 'required',
            'description' => 'required',
            'designation' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'designation' => $request->input('designation'),
            'status' => $request->input('status')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Testimonial'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        Testimonial::create($data);
        return redirect('/admin/testimonials');
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

        $data = Testimonial::where('id', $id)->first();
        return view('Admin.Testimonial.create',['data'=>$data]);
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
            'type' => 'required',
            'description' => 'required',
            'designation' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'designation' => $request->input('designation'),
            'status' => $request->input('status')
        ];

        if(isset($request->imagepv)&&$request->imagepv!=''){
            $data['image'] = $request->input('imagepv');
        }else if(isset($request->image)){
            $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'.'. $request->image->extension();
            $dd = $request->image->move(public_path('uploads/Testimonial'), $newImaegname);
            $data['image'] = $newImaegname;
        }

        $catg = Testimonial::where('id',$id)->update($data);
        return redirect('/admin/testimonials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catg = Testimonial::where('id',$id)->first();
        $catg->delete();
    }
}
