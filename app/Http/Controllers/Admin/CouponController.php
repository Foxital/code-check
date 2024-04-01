<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Coupon::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/coupons/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Coupon.create',['data'=>$data]);
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
            'name' => "required|unique:coupons,name,NULL,id,deleted_at,NULL",
            'offer_val' => 'required',
            'offer_type' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'offer_val' => $request->input('offer_val'),
            'offer_type' => $request->input('offer_type'),
            'validity_from' => $request->input('validity_from'),
            'validity_to' => $request->input('validity_to'),
            'status' => $request->input('status')
        ];

        Coupon::create($data);
        return redirect('/admin/coupons');
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

        $data = Coupon::where('id', $id)->first();
        return view('Admin.Coupon.create',['data'=>$data]);
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
            'name' => "required|unique:coupons,name,{$id},id,deleted_at,NULL",
            'offer_val' => 'required',
            'offer_type' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'offer_val' => $request->input('offer_val'),
            'offer_type' => $request->input('offer_type'),
            'validity_from' => $request->input('validity_from'),
            'validity_to' => $request->input('validity_to'),
            'status' => $request->input('status')
        ];

        Coupon::where('id',$id)->update($data);
        return redirect('/admin/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Coupon::where('id',$id)->first();
        $data->delete();
    }
}
