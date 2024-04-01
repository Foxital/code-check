<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\{User, Setting};
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        return $this->_registerOrLoginUser($user, 2, $request);
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        return $this->_registerOrLoginUser($user, 3, $request);
    }

    public function loginUser(Request $request){
        //Validate inputs
        $validator = $request->validate(
            [
                'email'=>'required|email|exists:users,email',
                'password'=>'required|min:8|max:30'
            ],
            [
                'email.exists'=>'This email is not exists on users table'
            ]
        );
        $json = ['success'=>'0'];
        $creds = $request->only('email','password');
        if( Auth::guard('web')->attempt($creds) ){
            $json['success']='1';
        }
        return response()->json($json);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('user.home');
    }

    public function signupUser(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        $json = ['success'=>'0'];

        $getval = Setting::whereIn('id',[4,5])->get();
        $login_bonus = 0;
        $referral_bonus = 0;
        foreach ($getval as $key => $val) {
          if($val['id']==5){
            $login_bonus = $val['val'];
          }else if($val['id']==4){
            $referral_bonus = $val['val'];
          }
        }

        $referralid = str_replace('reyo','',$request->input('referralid'));
        
        $data = [
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'signup_type' => 1,
            'wallet' => $login_bonus
        ];

        $user = User::create($data);

        if(isset($user['id'])){
            if($referral_bonus>0&&$referralid!=''&&$referralid!=null){
              DB::update("UPDATE users SET wallet = wallet+$referral_bonus where id = ?",[$referralid]);
            }
            $creds = $request->only('email','password');
            if( Auth::guard('web')->attempt($creds) ){
                $json['success']='1';
            }
        }
        return response()->json($json);
    }

    protected function _registerOrLoginUser($data, $signup_type, $request)
    {
        $user = User::where('email', '=', $data->email)->first();
        $json = ['success'=>'1'];
        if (!$user) {
            
            $getval = Setting::whereIn('id',[4,5])->get();
            $login_bonus = 0;
            $referral_bonus = 0;
            foreach ($getval as $key => $val) {
              if($val['id']==5){
                $login_bonus = $val['val'];
              }else if($val['id']==4){
                $referral_bonus = $val['val'];
              }
            }
            
            $referralid = $request->cookie('referral_id');
            
            if($referralid!=''&&$referralid!=null){
                $referralid = str_replace('reyo','',$referralid);
            }
            
            $datasave = [
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->id),
                'provider_id' => $data->id,
                'signup_type' => $signup_type,
                'wallet' => $login_bonus
            ];
            
            User::create($datasave);
            
            if($referral_bonus>0&&$referralid!=''&&$referralid!=null){
              DB::update("UPDATE users SET wallet = wallet+$referral_bonus where id = ?",[$referralid]);
            }
            
            $json['success']='2';
        }
        $creds = ['email'=>$data->email,'password'=>$data->id];
        if( Auth::guard('web')->attempt($creds) ){
            $json['success']='1';
        }
        
        $response = new Response();
        
        return redirect()->intended('/')->withCookie(cookie()->forever('referral_id', ""));
    }
}
