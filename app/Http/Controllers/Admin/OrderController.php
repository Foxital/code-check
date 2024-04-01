<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use DataTables;
use PDF;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $getres = $request->all();
            
            $qry = '';
            if(isset($getres['form_date'])&&isset($getres['to_date'])&&$getres['form_date']!=''&&$getres['to_date']!=''){
                $qry.=" AND orders.created_at BETWEEN '".$getres['form_date']."' AND '".$getres['to_date']."' ";
            }
            if(isset($getres['location'])&&$getres['location']!=''){
                $qry.=" AND orders.ship_address LIKE '%".$getres['location']."%' ";
            }
            if(isset($getres['status'])&&$getres['status']!=''){
                $qry.=" AND orders.status='".$getres['status']."' ";
            }
            if(isset($getres['coupon'])&&$getres['coupon']!=''){
                $qry.=" AND orders.coupon LIKE '%".$getres['coupon']."%' ";
            }
            $qry = trim($qry,' AND ');
            
            if($qry==''){
                $qry = ' users.deleted_at IS NULL';
            }
            
            //whereRaw
            
            $data = Orders::select('users.name as username', 'users.email as useremail', 'orders.*')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->whereRaw($qry)
            ->orderBy('orders.created_at', 'DESC')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('oid', function ($row) {
                    return 'REYO'.sprintf("%06d", $row['id']);
                })
                ->addColumn('userdetails', function ($row) {
                    return $row['username'].'<br>'.$row['useremail'];
                })
                ->addColumn('product_order_list_details', function ($row) {
                  $prods = json_decode($row['product_order_list'],true);
                  $retnval ='';
                  if(is_array($prods)){
                    foreach($prods as $k=>$prod){
                      $retnval .='<div class="row m-0 border-bottom mb-1">
                                      <div class="col-3 p-0 ">
                                          <img src="'. asset('uploads/Product/' . $prod['image']).'" class="img-fluid" alt="" />
                                      </div>
                                      <div class="col-9 position-relative">
                                          <a href="'.url('/product/' . $prod['link_code']).'">
                                              <span class="f15 card-title mb-1">'.$prod['name'].'</span>
                                          </a><br>
                                          <small>₹ '.$prod['price'].' x '.$prod['qty'].' = ₹ '.$prod['paid_price'].'</small>
                                      </div>
                                  </div>';
                    }
                  }
                  return $retnval.'<div class="row m-0 border-bottom">
                  <div class="col-12 text-right">Sub Total: '.$row['sub_total_amount'].'</div>
                  <div class="col-12 text-right">Delivery Fees: '.$row['delivery_fees'].'</div>
                  <div class="col-12 text-right">Total: '.$row['total_amount'].'</div>
                  </div>';
                })
                ->addColumn('ship_address_details', function ($row) {
                    return '<span class="smallspan"> '.$row['coupon'].'</span>';
                })
                ->addColumn('paid_details', function ($row) {
                    return $row['paid'] == '1' ? '<span class="badge badge-success">Paided</span><br><small>'.date_format(date_create($row['created_at']),"d-m-Y H:i:s").'</small>' : '<span class="badge badge-danger">Payment Failed</span><br>'.date_format(date_create($row['created_at']),"d-m-Y H:i:s");
                })
                ->addColumn('status_details', function ($row) {
                    if($row['paid'] == '1'){
                      if($row['status']=='1'){
                          return '<span class="badge badge-success">Order Accepted</span>';
                      }else if ($row['status']=='2'){
                          return '<span class="badge badge-war">Shipped</span>';
                      }else if ($row['status']=='3'){
                          return '<span class="badge badge-success">Delivery</span>';
                      }
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/admin/orders/'.$row['id'].'" class="edit btn btn-success btn-sm">Update</a><br/><a target="_blank" href="'.env('APP_URL').'admin/generate-pdf?id='.$row['id'].'" class="mt-2 btn btn-info btn-sm">Invoice</a>';
                    return $btn;
                })
                ->rawColumns(['oid','status_details','coupon_details','paid_details','userdetails','product_order_list_details','ship_address_details','action'])
                ->make(true);
        }

        return view('Admin.Order.index');
    }

    public function show($id)
    {
        $data = Orders::where('id', $id)->first();
        return view('Admin.Order.show', ['data'=>$data]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $data = [
          'status' => $request->input('status')
        ];
        
        
        if($request->input('status')==2){
            $orderdetails =  Orders::select('shipment_id')
            ->where('id',$id)->first();
            //start of Creating AWB in shiprocket
           
            if($orderdetails['shipment_id']!=NULL){
                
                
                //start of curl of generate token
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/auth/login";
                $curl_data = array(
                    "email" => "abhikong1@gmail.com",
                    "password" => "Abhinesh@2002"
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json'
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $server_output = curl_exec($c_start);
                
                if ($server_output === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                
                //end of curl of generate token
                
                //start of curl of generate pickup
                $responseData = json_decode($server_output, true);
                $token = $responseData['token'];
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/courier/assign/awb";
                $curl_data = array(
                    "shipment_id" => $orderdetails['shipment_id'],
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization:Bearer' .$token.''
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $result = curl_exec($c_start);
                
                if ($result === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                //end of curl of generate pickup
                
                $awbdetails = json_decode($result, true);
                $awb = $awbdetails['response']['data']['awb_code'];
                
                $awbdetails=["awb"=>$awb];
                Orders::where('id',$id)->update($awbdetails);
                Orders::where('id', $id)->update($data);
                $json = ['success'=>1];
                return response()->json($json);
            }
            else{
                 $json = ['failure'=>0,'message'=>'No shipment Id available,check with shiprocket'];
                 return response()->json($json);
            }
             //end of Creating AWB in shiprocket
             
              //start of requesting pickup in shiprocket
              }
            else if($request->input('status')==3){
                $orderdetails =  Orders::select('shipment_id','awb')
                ->where('id',$id)->first();
                
                if($orderdetails['awb']!=NULL){
                
                
                //start of curl of generate token
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/auth/login";
                $curl_data = array(
                    "email" => "abhikong1@gmail.com",
                    "password" => "Abhinesh@2002"
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json'
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $server_output = curl_exec($c_start);
                
                if ($server_output === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                
                //end of curl of generate token
                
                //start of curl of generate pickup
                $responseData = json_decode($server_output, true);
                $token = $responseData['token'];
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/courier/generate/pickup";
                $curl_data = array(
                    "shipment_id" => $orderdetails['shipment_id'],
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization:Bearer' .$token.''
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $result = curl_exec($c_start);
                
                if ($result === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                //end of curl of generate pickup
                Orders::where('id', $id)->update($data);
                $pickup = [
                  'is_pickup' => 1
                ];
                Orders::where('id', $id)->update($pickup);
                $json = ['success'=>1];
                return response()->json($json);
                
                
            }
                else{
                     $json = ['failure'=>0,'message'=>'No AWB Id available,check with shiprocket'];
                     return response()->json($json);
                }
            }
        else{
           Orders::where('id', $id)->update($data);
           $json = ['success'=>1];
           return response()->json($json); 
        }
        //end of requesting pickup in shiprocket
    }
    

    public function generatePDF(Request $request)
    {
        $getres = $request->all();
        $data = Orders::where('id', $getres['id'])->first();

        $pdf = PDF::loadView('Admin.invoice', ["data"=>$data]);
        // // return $pdf->download('itsolutionstuff.pdf');
        $pdfname = 'REYO'.sprintf("%06d", $getres['id']);
        return $pdf->stream($pdfname.'.pdf', array("Attachment" => false, 'enable_remote' => true));
    }
    
    public function generateManifest(Request $request)
    {
        $getres = $request->all();
        $id = $getres['id'];
        
        $orderdetails =  Orders::select('shipment_id','is_pickup','awb')
            ->where('id',$id)->first();
            
        if($orderdetails['awb']!=NULL){
            if($orderdetails['is_pickup']==1){
                //start of curl of generate token
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/auth/login";
                $curl_data = array(
                    "email" => "abhikong1@gmail.com",
                    "password" => "Abhinesh@2002"
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json'
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $server_output = curl_exec($c_start);
                
                if ($server_output === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                //end of curl of generate token
                
                
                //start of generating Manifest
                $responseData = json_decode($server_output, true);
                $token = $responseData['token'];
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/manifests/generate";
                $curl_data = array(
                    "shipment_id" => $orderdetails['shipment_id'],
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization:Bearer' .$token.''
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $result = curl_exec($c_start);
                
                if ($result === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                //end of generating Manifest
                $manifested = [
                  'is_manifested' => 1
                ];
                Orders::where('id', $id)->update($manifested);
                $json = ['success'=>1];
                return response()->json($json); 
            }else{
                $json = ['success'=>0,'message'=>"Pickup is not scheduled"];
                return response()->json($json);
            }
        }else{
              $json = ['success'=>0,'message'=>"AWB is not assigned. Check shiprocket"];
              return response()->json($json);
        }    
    }
    
    public function printManifest(Request $request)
    {
        $getres = $request->all();
        $id = $getres['id'];
        
        $orderdetails =  Orders::select('shipment_id','is_manifested','awb')
            ->where('id',$id)->first();
            
        if($orderdetails['awb']!=NULL){
            if($orderdetails['is_manifested']==1){
                //start of curl of generate token
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/auth/login";
                $curl_data = array(
                    "email" => "abhikong1@gmail.com",
                    "password" => "Abhinesh@2002"
                );
                $data_json = json_encode($curl_data);
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json'
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $server_output = curl_exec($c_start);
                
                if ($server_output === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                //end of curl of generate token
                
                
                //start of printing Manifest
                $responseData = json_decode($server_output, true);
                $token = $responseData['token'];
                $c_start = curl_init();
                $c_url = "https://apiv2.shiprocket.in/v1/external/manifests/print";
                $curl_data = array(
                    "order_ids" => $id,
                );
                
                curl_setopt($c_start, CURLOPT_URL, $c_url);
                curl_setopt($c_start, CURLOPT_POST, 1);
                curl_setopt($c_start, CURLOPT_POSTFIELDS, $curl_data);
                curl_setopt($c_start, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization:Bearer' .$token.''
                ));
                curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                
                $result = curl_exec($c_start);
                
                $responseArray = json_decode($result, true);
                $manifestUrl = $responseArray['manifest_url'];
                
                if ($result === false) {
                    die("cURL error: " . curl_error($c_start));
                }
                
                $http_code = curl_getinfo($c_start, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    die("HTTP error: $http_code");
                }
                curl_close($c_start);
                //end of printing Manifest
                $json = ['success'=>1,'url'=>$manifestUrl];
                return response()->json($json); 
            }else{
                $json = ['success'=>0,'message'=>"manifest is not generated"];
                return response()->json($json);
            }
        }else{
              $json = ['success'=>0,'message'=>"AWB is not assigned. Check shiprocket"];
              return response()->json($json);
        }    
    }
    
    
}
