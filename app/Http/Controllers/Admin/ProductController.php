<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\Category;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/products/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a><button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm ml-2">
                        <i class="fa fa-trash"></i></button>
                        ';
                        
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Product.index');
    }

    public function lowstock(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()
                ->select('products.id','products.image','products.name','product_varient.quantity','product_varient.updated_at','product_varient.created_at','product_varient.status')
                ->leftJoin('product_varient', 'products.id', '=', 'product_varient.product_id')
                ->where('product_varient.quantity', '<=', 10)
                ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="/admin/products/'.$row['id'].'/edit" class="edit btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="del('.$row['id'].',\''.csrf_token().'\')" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.Product.lowstock');
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
        return view('Admin.Product.create',['data'=>$data,'catgs'=>$catgs]);
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
            'sub_category_id' => 'required',
            'how_to_use' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_descp' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required',
            'link_code' => "required|unique:products,link_code,NULL,id,deleted_at,NULL",
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured' => 'required',
            'bestseller' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'description' => $request->input('description'),
            'how_to_use' => $request->input('how_to_use'),
            'meta_title' => $request->input('meta_title'),
            'meta_descp' => $request->input('meta_descp'),
            'meta_keyword' => $request->input('meta_descp'),
            'status' => $request->input('status'),
            'featured' => $request->input('featured'),
            'bestseller' => $request->input('bestseller'),
            'link_code' => $request->input('link_code')
        ];

        for($i=0;$i<=3;$i++){

            $val = $i==0?'':$i;
            $setname = 'image'.$val;
            $setnamepv = 'image'.$val.'pv';

            if(isset($request->$setnamepv)&&$request->$setnamepv!=''){
                $data[$setname] = $request->input($setnamepv);
            }else if(isset($request->$setname)){
                $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'_'.$i.'.'. $request->$setname->extension();
                $dd = $request->$setname->move(public_path('uploads/Product'), $newImaegname);
                $data[$setname] = $newImaegname;
            }
        }

        $save = Product::create($data);

        if(isset($save->id)){
            $product_id = $save->id;
            $label = $request->input('label');
            $quantity = $request->input('quantity');
            $price = $request->input('price');
            $discount = $request->input('discount');
            $pstatus = $request->input('pstatus');
            $pvData = [];
            foreach($label as $k=>$val){
                $pvData[$k]['product_id']=$product_id;
                $pvData[$k]['label']=$val;
                $pvData[$k]['price']=$price[$k];
                $pvData[$k]['discount']=$discount[$k];
                $pvData[$k]['quantity']=$quantity[$k];
                $pvData[$k]['status']=$pstatus[$k];
            }
            $psave = ProductVarient::insert($pvData);
        }
        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::find($id);
        // $productvarient = $product->ProductVarient();
        // dd($productvarient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Product::where('id', $id)->first();
        $catgs = Category::all();
        return view('Admin.Product.edit',['data'=>$data,'catgs'=>$catgs]);
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
            'sub_category_id' => 'required',
            'how_to_use' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_descp' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required',
            'link_code' => "required|unique:products,link_code,{$id},id,deleted_at,NULL",
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured' => 'required',
            'bestseller' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'description' => $request->input('description'),
            'how_to_use' => $request->input('how_to_use'),
            'meta_title' => $request->input('meta_title'),
            'meta_descp' => $request->input('meta_descp'),
            'meta_keyword' => $request->input('meta_keyword'),
            'status' => $request->input('status'),
            'featured' => $request->input('featured'),
            'bestseller' => $request->input('bestseller'),
            'link_code' => $request->input('link_code')
        ];

        for($i=0;$i<=3;$i++){

            $val = $i==0?'':$i;
            $setname = 'image'.$val;
            $setnamepv = 'image'.$val.'pv';

            if(isset($request->$setnamepv)&&$request->$setnamepv!=''){
                $data[$setname] = $request->input($setnamepv);
            }else if(isset($request->$setname)){
                $newImaegname = time() .'-'. str_replace(' ','_',$request->name) .'_'.$i.'.'. $request->$setname->extension();
                $dd = $request->$setname->move(public_path('uploads/Product'), $newImaegname);
                $data[$setname] = $newImaegname;
            }
        }

        $save = Product::where('id',$id)->update($data);

        if($save){
            $label = $request->input('label');
            $quantity = $request->input('quantity');
            $price = $request->input('price');
            $discount = $request->input('discount');
            $pstatus = $request->input('pstatus');
            $prid = $request->input('prid');
            $pvData = [];

            foreach($label as $k=>$val){
                $pvData['product_id']=$id;
                $pvData['label']=$val;
                $pvData['price']=$price[$k];
                $pvData['discount']=$discount[$k];
                $pvData['quantity']=$quantity[$k];
                $pvData['status']=$pstatus[$k];
                if($prid[$k]=='0'){
                    ProductVarient::create($pvData);
                }else{
                    $getid = $prid[$k];
                    ProductVarient::where('id',$getid)->update($pvData);
                }
            }
        }
        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catg = Product::where('id',$id)->first();
        $catg->delete();
    }
}
