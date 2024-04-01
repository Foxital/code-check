<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{userReview,Product, Wishlist, Category, SubCategory};
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(){
        $data = [
          'meta_title'=>'Shop – Reyo',
          'meta_descp'=>"Know more about Organic Sanitary Pads. Reyo provides answers to your questions that you’re hesitate about. Feel Free to Ask!",
          'meta_keyword'=>"Best Sanitary Pads, Organic Sanitary Pads, Sanitary Pads Online"
        ];
        return view('User.shop',['data'=>$data]);
    }
    public function productDetails($linkcode, Request $request){
        $prod = Product::where('link_code',$linkcode)->where('status','1')->first();
        
        $review = userReview::where('link_code',$linkcode)->where('status','1')->get();
        $count = $review->count();
        
        $totalRate = $review->sum('rate');
        $average = $count > 0 ? $totalRate / $count : 0;
        $averageRateFormatted = number_format($average, 1);

        $wiselist=[];
        if(isset(Auth::user()->id)){
          $wiselist = Wishlist::where('product_id',$prod['id'])->where('user_id',Auth::user()->id)->first();
        }

        $getval=[];
        $getdata = $request->cookie('addtocart');
        if($getdata!=''&&$getdata!=null){
            $getval = json_decode($getdata,true);
        }

        $data = [
          'meta_title'=>$prod['meta_title'],
          'meta_descp'=>$prod['meta_descp'],
          'meta_keyword'=>$prod['meta_keyword']
        ];

        return view('User.product',['data'=>$data,'prod'=>$prod,'review'=>$review,'count'=>$count,'average'=>$averageRateFormatted, 'cookies'=>$getval, 'wise'=>$wiselist]);
    }
    public function productList(request $request){
        return view('User.parts.list',['data'=>$request]);
    }
    public function shopList(request $request){
        return view('User.parts.prodshop',['data'=>$request]);
    }
    public function categoryShop($linkcode){

        $catg = Category::where('link_code',$linkcode)->where('status','1')->first();

        $data = [
          'meta_title'=>'Shop '.$catg['name'].' – Reyo',
          'meta_descp'=>"Know more about Organic Sanitary Pads. Reyo provides answers to your questions that you’re hesitate about. Feel Free to Ask!",
          'meta_keyword'=>"Best Sanitary Pads, Organic Sanitary Pads, Sanitary Pads Online"
        ];

        return view('User.category',['data'=>$data,'catg'=>$catg]);
    }
    public function subCategoryShop($linkcode,$sublink){

        $subcatg = SubCategory::where('link_code',$sublink)->where('status','1')->first();

        $data = [
          'meta_title'=>'Shop '.str_replace('-',' ', $linkcode).' '.$subcatg['name'].' – Reyo',
          'meta_descp'=>"Know more about Organic Sanitary Pads. Reyo provides answers to your questions that you’re hesitate about. Feel Free to Ask!",
          'meta_keyword'=>"Best Sanitary Pads, Organic Sanitary Pads, Sanitary Pads Online"
        ];

        return view('User.category',['data'=>$data,'subcatg'=>$subcatg]);
    }


    public function OfferProd(){
      $data = [
        'meta_title'=>'Festival Offers – Reyo',
        'meta_descp'=>"Know more about Organic Sanitary Pads. Reyo provides answers to your questions that you’re hesitate about. Feel Free to Ask!",
        'meta_keyword'=>"Best Sanitary Pads, Organic Sanitary Pads, Sanitary Pads Online"
      ];

      return view('User.offerpage',['data'=>$data]);
    }
    
    public function saveReview(Request $request){
        $getres = $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'rate' => 'required',
            'message' => 'required',
        ]);
        $status = 0;
        $date = "2024-03-02 01:28:52";
        $json = ['success'=>'0'];
        
        //start of avatar generation
        $name = $getres['name'];
        
        $words = explode(' ', $name);
        $initials = strtoupper($name[0]).strtoupper($name[1]);
    
        // Define a background color and text color for the avatar
        $bgColor = '#'.substr(md5($name), 0, 6); // Use a unique color based on the name
        $textColor = '#ffffff'; // White text color
    
        // Create an image with the initials and colors
        $image = imagecreate(200, 200);
        $bg = imagecolorallocate($image, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        $text = imagecolorallocate($image, hexdec(substr($textColor, 1, 2)), hexdec(substr($textColor, 3, 2)), hexdec(substr($textColor, 5, 2)));
        
        // Get the dimensions of the text
        $text_box = imagettfbbox(75, 0, public_path('fonts/arial.ttf'), $initials);
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[3] - $text_box[5];
        
        // Calculate the position to center the text horizontally
        $x = (200 - $text_width) / 2;
        
        imagefill($image, 0, 0, $bg);
        imagettftext($image, 75, 0, $x, 130, $text, public_path('fonts/arial.ttf'), $initials);
    
        // Save the image to a file
        $avatarPath = 'assets/images/avatar/'.$name.'_avatar.png';
        imagepng($image, public_path($avatarPath));
        imagedestroy($image);
        //End of avatar generation

        $data=[
            "link_code"=>$getres['linkcode'],
            "name"=>$getres['name'],
            "email"=>$getres['email'],
            "rate"=>$getres['rate'],
            "message"=>$getres['message'],
            "image"=>$name.'_avatar.png',
            "status"=>$status
        ];

        $useradrss = userReview::create($data);
          if($useradrss){
              $json['success']='1';
          }

        return response()->json($json, 200);
    }
}
