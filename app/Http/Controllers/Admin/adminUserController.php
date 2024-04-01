<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\adminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DataTables;

class adminUserController extends Controller
{

    function usercheck(Request $request){
        //Validate inputs
        $request->validate(
            [
                'email'=>'required|email|exists:admin_users,email',
                'password'=>'required|min:8|max:30'
            ],
            [
                'email.exists'=>'This email is not exists on users table'
            ]
        );
        $creds = $request->only('email','password');
        if( Auth::guard('admin')->attempt($creds) ){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
