<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\{Product, userSubscribe, ContactUser, Orders};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\NotifyMail;
use Mail;

class HomeController extends Controller
{
    public function index(Request $request){
        $data = [
          'meta_title'=>'Reyo | Top-Quality Sanitary Napkins for Women Hygiene',
          'meta_descp'=>"Reyo is the First 5 in 1 Features Premium Anion Sanitary Napkins in India. We’re Providing Organic Sanitary Pads at an Affordable Price.",
          'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
        ];
        return view('User.home',['data'=>$data]);
    }
    
    public function cart(Request $request){
       $data = [
          'meta_title'=>'Cart | Reyo',
        ];
        $getdata2 = $request->cookie('addtocart');
        $getdata = $request->cookie('addcoupon');
        if($getdata2!=''&&$getdata2!=null){
            $getval = json_decode($getdata,true);
            $getval2 = json_decode($getdata2,true);
            if(count($getval2)>0){
                return view('User.cart',['data'=>$data]);
            }
        }
        return redirect('/');
    }
  
    
    public function terms(Request $request){
        $data = [
          'meta_title'=>'Reyo | Top-Quality Sanitary Napkins for Women Hygiene',
          'meta_descp'=>"Reyo is the First 5 in 1 Features Premium Anion Sanitary Napkins in India. We’re Providing Organic Sanitary Pads at an Affordable Price.",
          'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
        ];
        return view('User.terms',['data'=>$data]);
    }
    
    public function privacy(Request $request){
        $data = [
          'meta_title'=>'Reyo | Top-Quality Sanitary Napkins for Women Hygiene',
          'meta_descp'=>"Reyo is the First 5 in 1 Features Premium Anion Sanitary Napkins in India. We’re Providing Organic Sanitary Pads at an Affordable Price.",
          'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
        ];
        return view('User.privacy',['data'=>$data]);
    }
    
    public function setreferalid(Request $request){
        
        $getres = $request->all();
        
        if(isset($getres['referral_id'])){
            $response = new Response();
            return $response->withCookie(cookie()->forever('referral_id', $getres['referral_id']));
        }
    }

    public function about(){
      $data = [
        'meta_title'=>'Reyo | Top-Quality Sanitary Napkins for Women Hygiene',
          'meta_descp'=>"Reyo is the First 5 in 1 Features Premium Anion Sanitary Napkins in India. We’re Providing Organic Sanitary Pads at an Affordable Price.",
          'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.about',['data'=>$data]);
    }
    
    public function wff(){
      $data = [
        'meta_title'=>'Reyo | Top-Quality Sanitary Napkins for Women Hygiene',
          'meta_descp'=>"Reyo is the First 5 in 1 Features Premium Anion Sanitary Napkins in India. We’re Providing Organic Sanitary Pads at an Affordable Price.",
          'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.wff',['data'=>$data]);
    }
    
     public function check(){
      $data = [
        'meta_title'=>'Checkout Reyo Pads | Reyo',
        'meta_descp'=>"Reyo Satisfies the needs of the Customers by Providing Superior Quality Organic Sanitary Pads at an Affordable Price.",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.check',['data'=>$data]);
    }
    
     public function login(){
      $data = [
        'meta_title'=>'Login to Reyo Pads | Reyo',
        'meta_descp'=>"Reyo Satisfies the needs of the Customers by Providing Superior Quality Organic Sanitary Pads at an Affordable Price.",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.login',['data'=>$data]);
    }
    
   
    
     public function wishlist(){
      $data = [
        'meta_title'=>'Wishlist Reyo pads | Reyo',
        'meta_descp'=>"Reyo Satisfies the needs of the Customers by Providing Superior Quality Organic Sanitary Pads at an Affordable Price.",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.wish',['data'=>$data]);
    }
    
    public function mailto(){
//      $order = Orders::where('id','128')->first();
//        
//        $sdata = [
//            'email' => Auth::user()->email,
//            'status' => '1',
//            'name' => Auth::user()->name,
//            'id' => 'REYO'.sprintf("%06d", $order->id)
//        ]; 
//        
//       Mail::to(Auth::user()->email)->send(new NotifyMail($sdata));
//        $dd = DB::update("ALTER TABLE banners ADD image1 VARCHAR(255) NULL DEFAULT NULL AFTER image;");
//        dd($dd);
    }
    
    public function journey(){
      $data = [
        'meta_title'=>'Journey of Reyo Pads | Reyo',
        'meta_descp'=>"Reyo Satisfies the needs of the Customers by Providing Superior Quality Organic Sanitary Pads at an Affordable Price.",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.journey',['data'=>$data]);
    }
    public function whyus(){
      $data = [
        'meta_title'=>'Why Choosing Reyo Pads | Reyo',
        'meta_descp'=>"Reyo Satisfies the needs of the Customers by Providing Superior Quality Organic Sanitary Pads at an Affordable Price.",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
      return view('User.whyus',['data'=>$data]);
    }
    
    public function contact(){
      $data = [
        'meta_title'=>'Contact | Reyo',
        'meta_descp'=>"Contact Reyo for Super Hygiene Organic Sanitary Pads to be Delivered to your Doorstep. Looking forward to Hear from You!",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
        return view('User.contact',['data'=>$data]);
    }
    public function faq(){
      $data = [
        'meta_title'=>'faq | Reyo',
        'meta_descp'=>"Contact Reyo for Super Hygiene Organic Sanitary Pads to be Delivered to your Doorstep. Looking forward to Hear from You!",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
        return view('User.faq',['data'=>$data]);
    }

    public function pCalc(){
      $data = [
        'meta_title'=>'Period Calculator | Reyo',
        'meta_descp'=>"Not Sure about your Period Date! Use Reyo Period Calculator to keep track of your Menstrual Cycle.",
        'meta_keyword'=>"Heavy Flow Sanitary Napkins, Overnight Pads, Best Organic Pads, bio degradable sanitary napkins, Eco-friendly sanitary pads,Anion pads,cotton sanitary  napkins"
      ];
        return view('User.periodCal',['data'=>$data]);
    }

    public function blog(){
        return view('User.blog');
    }

    public function subscribe(Request $request){
      $request->validate([
          'email' => 'required|email|unique:user_subscribes',
      ]);
      $json = ['success'=>'0'];

      $getres = $request->all();

      $save = userSubscribe::create(["email"=>$getres['email']]);

      if($save){
          $json['success']='1';
      }

      return response()->json($json);
    }

    public function contactus(Request $request){
      $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'message' => 'required'
      ]);

      $json = ['success'=>'0'];

      $getres = $request->all();

      $save = ContactUser::create([
          "name"=>$getres['name'],
          "email"=>$getres['email'],
          "message"=>$getres['message']
      ]);

      if($save){
          $json['success']='1';
      }

      return response()->json($json);
    }

    public function addtocart(Request $request){
        $id = $request->input('id');
        $type = $request->input('type');
        $addval = $request->input('addval');
        $getval=[];
        $getdata = $request->cookie('addtocart');
        if($getdata!=''&&$getdata!=null){
            $getval = json_decode($getdata,true);
            if($type==1){
                if(isset($getval[$id])){
                    $getval[$id]+=$addval;
                }else{
                    $getval[$id]=1;
                }
            }else if($type==2){
                unset($getval[$id]);
            }else if($type==3){
                $getval[$id]=$addval;
            }
        }else{
            $getval[$id] = 1;
        }
        $response = new Response();
        return $response->withCookie(cookie()->forever('addtocart', json_encode($getval)));
    }

    public function removeallcart(){
      $response = new Response();
      return $response->withCookie(cookie()->forever('addtocart', json_encode([])));
    }

    public function getCartCount(Request $request){
        $getdata = $request->cookie('addtocart');
        $tot=0;
        if($getdata!=''&&$getdata!=null){
            $getval = json_decode($getdata,true);
            foreach($getval as $val){
                $tot+=$val;
            }
        }
        return $tot;
    }

    public function WiseList(){
      if(isset(Auth::user()->id)){
        $prods = \App\Models\Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','product_varient.id as pvid')
        ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
        ->leftJoin('wishlists', 'wishlists.product_id', '=', 'products.id')
        ->where('products.status', '1')
        ->where('product_varient.status', '1')
        ->where('wishlists.user_id',Auth::user()->id)
        ->orderBy('id')
        ->get();
        return view('User.parts.wishlist',['prods'=>$prods,'cart'=>[], 'layout'=>'2']);
      }else{
        return '';
      }
    }

    public function cartList(Request $request){

        $getcart = [];
        $getdata = $request->cookie('addtocart');
        if($getdata!=''&&$getdata!=null){
            $getval = json_decode($getdata,true);
            $ids = array_keys($getval);
            $prods = [];
            if($ids!=null&&$ids!=""){
                $prods = \App\Models\Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','product_varient.id as pvid')
                ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
                ->where('products.status', '1')
                ->where('product_varient.status', '1')
                ->whereIn('product_varient.id',$ids)
                ->orderBy('id')
                ->get();
            }
            return view('User.parts.cartlist',['prods'=>$prods,'cart'=>$getval, 'layout'=>'1']);
        }else{
            return '';
        }

    }
    
    public function addCartList(Request $request){

        $getcart = [];
        $getdata = $request->cookie('addtocart');
        if($getdata!=''&&$getdata!=null){
            $getval = json_decode($getdata,true);
            $ids = array_keys($getval);
            $prods = [];
            if($ids!=null&&$ids!=""){
                $prods = \App\Models\Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','product_varient.id as pvid')
                ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
                ->where('products.status', '1')
                ->where('product_varient.status', '1')
                ->whereIn('product_varient.id',$ids)
                ->orderBy('id')
                ->get();
            }
            return view('User.parts.addcart',['prods'=>$prods,'cart'=>$getval, 'layout'=>'1']);
        }else{
            return '';
        }

    }
    
    public function checkCartList(Request $request){

        $getcart = [];
        $getdata = $request->cookie('addtocart');
        if($getdata!=''&&$getdata!=null){
            $getval = json_decode($getdata,true);
            $ids = array_keys($getval);
            $prods = [];
            if($ids!=null&&$ids!=""){
                $prods = \App\Models\Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','product_varient.id as pvid')
                ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
                ->where('products.status', '1')
                ->where('product_varient.status', '1')
                ->whereIn('product_varient.id',$ids)
                ->orderBy('id')
                ->get();
            }
            return view('User.parts.checkcart',['prods'=>$prods,'cart'=>$getval, 'layout'=>'1']);
        }else{
            return '';
        }

    }
}
