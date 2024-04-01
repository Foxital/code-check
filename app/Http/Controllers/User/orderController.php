<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\{userAddress, Product, Coupon, Courier, Orders, Setting};
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Mail\NotifyMail;
use Mail;

class orderController extends Controller
{
    public function index(Request $request){
       $data = [
          'meta_title'=>'Checkout | Reyo',
        ];
        $getdata2 = $request->cookie('addtocart');
        $getdata = $request->cookie('addcoupon');
        if($getdata2!=''&&$getdata2!=null&&(isset(Auth::user()->name))){
            $getval = json_decode($getdata,true);
            $getval2 = json_decode($getdata2,true);
            if(count($getval2)>0){
                return view('User.checkout',['data'=>$data]);
            }
        }
        return redirect('/');
    }
    
     

    public function payNow(Request $request){
        $getres = $request->all();
        $user_id = Auth::user()->id;
        

        $getcart = [];
        $getdata = $request->cookie('addtocart');
        $json = ['save'=>'0','key'=>""];

        if($getdata!=''&&$getdata!=null){
            
            $getval = json_decode($getdata,true);
            
            $notepay = $getres['note'];
            $final_amount = $getres['final_amount'];

            $ship_address = userAddress::select('fname', 'lname', 'address', 'optional_name', 'city', 'country', 'state', 'pin_code', 'mobile_num', 'primary_addrs')
            ->where('user_id',$user_id)
            ->where('id',$getres['addr_id'])->first();
            $amount_use=0;
            $getuse = Setting::whereIn('id',[6,7])->get();
            $overshipping = 1000;
            foreach ($getuse as $key => $val) {
              if($val['id']=='6'&&$getres['wallet_taken']=='1'){
                if($val['val']>0&&Auth::user()->wallet>0){
                  $amount_use = round(($val['val']/100)*Auth::user()->wallet);
                }
              }else if($val['id']=='7'){
                $overshipping = $val['val'];
              }
            }

            $ids = array_keys($getval);

            $prods = [];
            if($ids!=null&&$ids!=""){
                $prods = Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','product_varient.id as pvid')
                ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
                ->where('products.status', '1')
                ->where('product_varient.status', '1')
                ->whereIn('product_varient.id',$ids)
                ->orderBy('id')
                ->get();
            }

            $sub_total = 0;
            foreach($prods as $k=>$prod){
                if(isset($getval[$prod['pvid']])){
                    $prods[$k]['qty'] = $getval[$prod['pvid']];
                    if($prod['discount']>0){
                        $prod_price = $prod['price']-$prod['discount'];
                    }else{
                        $prod_price = $prod['price'];
                    }
                    $paid_price = $getval[$prod['pvid']]*$prod_price;
                    $prods[$k]['paid_price'] = $paid_price;
                    $sub_total += (float)$paid_price;
                }
            }

            $coupon = [];
            if($request->cookie('addcoupon')!=''&&$request->cookie('addcoupon')!=null){
                $coupon = json_decode($request->cookie('addcoupon'),true);
            }
            $couponlive = [];
            $coupon_price = 0;
            if(isset($coupon['id'])){
                $couponlive = Coupon::where('status', '1')
                ->where('name', $coupon['name'])
                ->first();
                if(isset($couponlive['id'])){
                    if($couponlive['offer_type']==1){
                        $coupon_price=($couponlive['offer_val']/100)*$sub_total;
                    }else if($couponlive['offer_type']==2){
                        $coupon_price=$couponlive['offer_val'];
                    }
                }
            }
            $total_amount = ($sub_total-$coupon_price);

            $delivery_fees=0;

            if($overshipping>$total_amount){
              $devCourier = Courier::select('id','price')->where('status', '1')
              ->where('name', $ship_address['state'])
              ->first();
              if(isset($devCourier['id'])){
                $delivery_fees=$devCourier['price'];
              }

            }

            $total_amount += $delivery_fees;

            if($amount_use>0){
              $total_amount = $total_amount - $amount_use;
            }

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $orgprice =(int)$final_amount*100;

            $last_order_id = time();
            $order = $api->order->create(array(
              'receipt' => $last_order_id,
              'amount' => $orgprice,
              'currency' => 'INR'
              )
            );

            $current_orderid=$order->id;

            $data = [
                "user_id"=>$user_id,
                "razorpay_order_id"=>$current_orderid,
                "total_amount"=>$final_amount,
                "sub_total_amount"=>$sub_total,
                "delivery_fees"=>$delivery_fees,
                "product_order_list"=>json_encode($prods),
                "ship_address"=>json_encode($ship_address),
                "coupon"=>$couponlive['name']??'',
                "coupon_price"=>$coupon_price,
                "wallet_taken"=>$amount_use,
                "notepay"=>$notepay
            ];

            $save = Orders::create($data);

            if(isset($save['id'])){
                $json['save']='1';
                $json['key']=env('RAZORPAY_KEY');
                $json['amount']=$orgprice;
                $json['name']=str_replace('_', ' ', env('RAZORPAY_name'));
                $json['order_id']=$current_orderid;
                $json['own_id']=$save['id'];
                $json['description']=str_replace('_', ' ', env('RAZORPAY_description'));
            }

        }
        return response()->json($json, 200);
    }

    public function checkPay(Request $request){
        $getres = $request->all();
        $user_id = Auth::user()->id;

        $oid = $getres['oid'];
        $pid = $getres['pid'];
        $addr = $getres['addr_id'];
        $finalamount = $getres['final_amount'];
        
        
        //Start of order details collection for shiprocket
        $ship_address = userAddress::select('fname', 'lname', 'address', 'optional_name', 'city', 'country', 'state', 'pin_code', 'mobile_num', 'primary_addrs')
            ->where('user_id',$user_id)
            ->where('id',$getres['addr_id'])->first();
        
        
        $order_details = Orders::select('id','created_at')
            ->where('razorpay_order_id',$oid)->first();
            
        
        $getdata = $request->cookie('addtocart');
        $getval = json_decode($getdata,true);   
        
        $amount_use=0;
            $getuse = Setting::whereIn('id',[6,7])->get();
            $overshipping = 1000;
            
            $ids = array_keys($getval);

            $prods = [];
            if($ids!=null&&$ids!=""){
                $prods = Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','length','breadth','height','weight','product_varient.id as pvid')
                ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
                ->where('products.status', '1')
                ->where('product_varient.status', '1')
                ->whereIn('product_varient.id',$ids)
                ->orderBy('id')
                ->get();
            }

            $sub_total = 0;
            foreach($prods as $k=>$prod){
                if(isset($getval[$prod['pvid']])){
                    $prods[$k]['qty'] = $getval[$prod['pvid']];
                    $paid_price = $getval[$prod['pvid']]*$prod['price'];
                    $prods[$k]['paid_price'] = $paid_price;
                    $sub_total += (float)$paid_price;
                }
            }

            $coupon = [];
            if($request->cookie('addcoupon')!=''&&$request->cookie('addcoupon')!=null){
                $coupon = json_decode($request->cookie('addcoupon'),true);
            }
            $couponlive = [];
            $coupon_price = 0;
            if(isset($coupon['id'])){
                $couponlive = Coupon::where('status', '1')
                ->where('name', $coupon['name'])
                ->first();
                if(isset($couponlive['id'])){
                    if($couponlive['offer_type']==1){
                        $coupon_price=($couponlive['offer_val']/100)*$sub_total;
                    }else if($couponlive['offer_type']==2){
                        $coupon_price=$couponlive['offer_val'];
                    }
                }
            }
            $total_amount = ($sub_total-$coupon_price);

            $delivery_fees=0;

            if($overshipping>$total_amount){
              $devCourier = Courier::select('id','price')->where('status', '1')
              ->where('name', $ship_address['state'])
              ->first();
              if(isset($devCourier['id'])){
                $delivery_fees=$devCourier['price'];
              }

            }

            $total_amount += $delivery_fees;

            if($amount_use>0){
              $total_amount = $total_amount - $amount_use;
            }    
            
        //End of order details collection for shiprocket
        
        //Start of data preparation for shiprocket
        
        $orderItems = array();
            foreach ($prods as $k => $prod) {
                $orderItems[] = array(
                    "name" => $prod['name'],
                    "sku" => $prod['link_code'],
                    "units" => $getval[$prod['pvid']],
                    "selling_price" => $prod['price'],
                    "discount" => $prod['discount'],
                    "tax" => "0",
                    "hsn" => "14111"
                );
            }
        
        $orderData  = array(
                "order_id" => $order_details['id'],
                "order_date" => $order_details['created_at'],
                "pickup_location" => 'Primary',
                "comment" => "Shipment order for id"  .$order_details['id'],
                "billing_customer_name" => $ship_address['fname'],
                "billing_last_name" => $ship_address['lname'],
                "billing_address" => $ship_address['address'],
                "billing_address_2" => "",
                "billing_city" => $ship_address['city'],
                "billing_pincode" => $ship_address['pin_code'],
                "billing_state" => $ship_address['state'],
                "billing_country" => $ship_address['country'],
                "billing_email" => Auth::user()->email,
                "billing_phone" => $ship_address['mobile_num'],
                "shipping_is_billing" => true,
                "shipping_customer_name" => $ship_address['fname'],
                "shipping_last_name" => $ship_address['lname'],
                "shipping_address" => $ship_address['address'],
                "shipping_address_2" => "",
                "shipping_city" => $ship_address['city'],
                "shipping_pincode" => $ship_address['pin_code'],
                "shipping_state" => $ship_address['state'],
                "shipping_country" => $ship_address['country'],
                "shipping_email" => Auth::user()->email,
                "shipping_phone" => $ship_address['mobile_num'],
                "order_items" => $orderItems,
                "payment_method" => "Prepaid",
                "shipping_charges" => "",
                "giftwrap_charges" => "",
                "transaction_charges" => "",
                "total_discount" => "",
                "sub_total" => $finalamount,
                "length" => "1",
                "breadth" => "1.2",
                "height" => "3",
                "weight" => "0.5"  
            );
           
           $orderDetails = json_encode($orderData);
        //End of data preparation for shiprocket
        
        //Start of generating access token
            $c_start = curl_init();
            $c_url = "https://apiv2.shiprocket.in/v1/external/auth/login";
            $data = array(
                "email" => "abhikong1@gmail.com",
                "password" => "Abhinesh@2002"
            );
            $data_json = json_encode($data);
            
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
        //End of generating access token
        
        $json = ['save'=>'0','key'=>""];

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($pid);

        $getpayres = json_encode($payment->toArray());
        if(isset($payment->order_id)){
            if($payment->order_id==$oid){
                
                //Start of create order in shiprocket
                    $responseData = json_decode($server_output, true);
                    $token = $responseData['token'];
                    $c_url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc"; 
                    $c_start = curl_init($c_url);
                    curl_setopt($c_start, CURLOPT_POST, 1);
                    curl_setopt($c_start, CURLOPT_POSTFIELDS, $orderDetails);
                    curl_setopt($c_start, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($c_start, CURLOPT_HTTPHEADER,array('Content-Type:application/json','Authorization:Bearer' .$token.'' ));
                    $result = curl_exec($c_start);
                    curl_close($c_start);
                //End of create order in shiprocket*/
                
                $shiprocket = json_decode($result, true);
                $shipmentid = $shiprocket['shipment_id'];
                
                $data=['paid'=>1,'razorpay_payment_id'=>$total_amount,"pay_res"=>$getpayres,"is_pushed"=>1,"shipment_id"=>$shipmentid];
                Orders::where('razorpay_order_id',$oid)->update($data);

                $order = Orders::where('razorpay_order_id',$oid)->first();
                
                if($order['wallet_taken']>0){
                  $paidamtwallet = $order['wallet_taken'];
                  DB::update("UPDATE users SET wallet = wallet-$paidamtwallet where id = ?",[$user_id]);
                }

                $json['save']='1'; 
                
                $sdata = [
                    'email' => Auth::user()->email,
                    'status' => '1',
                    'name' => Auth::user()->name,
                    'id' => 'REYO'.sprintf("%06d", $order->id)
                ]; 
        
                //Mail::to(Auth::user()->email)->send(new NotifyMail($sdata));
                
                
            }
        }
        return response()->json($json, 200);
    }

    public function dismissPay(Request $request){
        $getres = $request->all();
        $oid = $getres['oid'];
        Orders::where('razorpay_order_id',$oid)->update(['status'=>'0']);
        $json = ['save'=>'1'];
        return response()->json($json, 200);
    }

    public function checkCoupon(Request $request){
        $getres = $request->all();
        $coupon = $getres['coupon'];
        $today = date('Y-m-d H:i:s');

        $check_coupon = Coupon::select('id', 'name', 'offer_val', 'offer_type')
                        ->where('status','1')
                        ->where('name',$coupon)
                        ->where('validity_from','<=', $today)
                        ->where('validity_to','>=', $today)
                        ->first();
        
        if(isset($check_coupon['id'])){
            $response = new Response();
            $val = json_encode($check_coupon,true);
            return $response->withCookie(cookie('addcoupon', $val, 300));
        }
        return response()->json(['success'=>'0'], 200);
    }

    public function removeCoupon(){
        $response = new Response();
        return $response->withCookie(cookie()->forget('addcoupon'));
    }

    public function removeCart(){
        $response = new Response();
        return $response->withCookie(cookie()->forget('addtocart'));
    }
    
    public function trackOrder(Request $request){
        $orderId = $request->input('id');
        return response()->json($orderId);
    }

    public function saveAddress(Request $request){
        $getres = $request->all();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'pin_code' => 'required|integer|digits:6',
            'mobile_num' => 'required|digits:10',
        ]);
        $user_id = Auth::user()->id;
        $json = ['success'=>'0'];

        $data=[
            "user_id"=>$user_id,
            "fname"=>$getres['first_name'],
            "lname"=>$getres['last_name'],
            "address"=>$getres['address'],
            "optional_name"=>$getres['optional_name'],
            "city"=>$getres['city'],
            "country"=>$getres['country'],
            "state"=>$getres['state'],
            "pin_code"=>$getres['pin_code'],
            "mobile_num"=>$getres['mobile_num']
        ];

        if($getres['addr_id']=='0'){
          $useradrss = userAddress::create($data);
          if($useradrss){
              $json['success']='1';
          }
        }else{
          $useradrss = userAddress::where('id',$getres['addr_id'])->update($data);
          if($useradrss){
              $json['success']='1';
          }
        }

        return response()->json($json, 200);
    }

}
