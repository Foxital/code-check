<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{User, Orders, Wishlist};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $data = [
          'meta_title'=>'profile | Reyo',
        ];
        return view('User.profile',['data'=>$data]);
    }

    public function list(){
      $data = [
        'meta_title'=>'Orders | Reyo',
      ];
        return view('User.orders',['data'=>$data]);
    }

    public function getlist(Request $request){
      $data = [
        'meta_title'=>'Order List | Reyo',
      ];
        return view('User.parts.olist',['data'=>$data, 'res'=>$request]);
    }

    public function changePass(Request $request){
            $request->validate([
                'cpass' => 'required|min:8',
                'password' => 'required|min:8'
            ]);
            $json = ['success'=>'0'];

            $getres = $request->all();
            $userid = Auth::user()->id;
            $curtpass = Auth::user()->password;
            $oldpass = Hash::make($getres['cpass']);
            // dd($curtpass.'-----'.$oldpass);
            $newpass = Hash::make($getres['password']);
            if($curtpass==$oldpass){
                User::where('id',$userid)->update(['password'=>$newpass]);
                $json['success']='1';
            }else{
                $json['success']='2';
            }
            return response()->json($json);
    }

    public function changeMobile(Request $request){

      $validator = $request->validate(['mobile' => 'required|unique:users']);

      $getres = $request->all();
      $userid = Auth::user()->id;
      User::where('id',$userid)->update(['mobile'=>$getres['mobile']]);
      $json['success']='1';
      return response()->json($json);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'dob_date' => 'required',
            'anniversary_date' => 'required'
        ]);
        $json = ['success'=>'0'];

        $getres = $request->all();
        $userid = Auth::user()->id;

        $data = [
            "name"=>$getres['name'],
            "dob_date"=>$getres['dob_date'],
            "anniversary_date"=>$getres['anniversary_date']
        ];

        $save = User::where('id',$userid)->update($data);
        if($save){
            $json['success']='1';
        }

        return response()->json($json);
    }

    public function saveWishlist(Request $request){
      $id = $request->input('id');
      $userid = Auth::user()->id;
      $getrow = Wishlist::where('product_id',$id)->where('user_id',$userid)->first();
      $json = ['success'=>'0'];
      if(isset($getrow['id'])){
        $getrow->delete();
        $json['success']='2';
      }else{
        Wishlist::create(['user_id'=>$userid,'product_id'=>$id]);
        $json['success']='1';
      }
      return response()->json($json, 200);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }



}
