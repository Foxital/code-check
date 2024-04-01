<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Product;
use DataTables;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Offer::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/offers/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Offer.index');
    }


    public function searchProd(Request $request)
    {
        $query = $request->q;
        $page = isset($request->page)?$request->page*10:0;
        $data['items'] = Product::where('name','LIKE','%'.$query.'%')
                ->select('id','name as text')
                ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('Admin.Offer.create',['data'=>$data]);
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
            'name' => "required|unique:offers,name,NULL,id,deleted_at,NULL",
            'product_id' => 'required',
            'offer_val' => 'required',
            'offer_type' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'offer_val' => $request->input('offer_val'),
            'offer_type' => $request->input('offer_type'),
            'validity_from' => $request->input('validity_from'),
            'validity_to' => $request->input('validity_to'),
            'status' => $request->input('status')
        ];

        Offer::create($data);
        return redirect('/admin/offers');
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

        $data = Offer::where('id', $id)->first();
        return view('Admin.Offer.create',['data'=>$data]);
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
            'name' => "required|unique:offers,name,{$id},id,deleted_at,NULL",
            'product_id' => 'required',
            'offer_val' => 'required',
            'offer_type' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'offer_val' => $request->input('offer_val'),
            'offer_type' => $request->input('offer_type'),
            'validity_from' => $request->input('validity_from'),
            'validity_to' => $request->input('validity_to'),
            'status' => $request->input('status')
        ];

        Offer::where('id',$id)->update($data);
        return redirect('/admin/offers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Offer::where('id',$id)->first();
        $data->delete();
    }
}
