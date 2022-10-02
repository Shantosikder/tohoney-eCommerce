<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
        return view('admin.profile.index');
    }

    function profilepost(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $old_name = Auth::user()->name;
        User::find(Auth::id())->update([
            'name' => $request->name
        ]);

        return back()->with('success_message','Your Name Update form '. $old_name.' Successfully To '.$request->name);

    }

    function passwordpost(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'

        ]);
        if($request->old_password == $request->password){
            return back()->withErrors("Your Password Can Not Be Your Old Password");
        }

        $old_password_form_user = $request->old_password;
        $old_password_form_user_db = Auth::user()->password;

        if(HASH::check($old_password_form_user,$old_password_form_user_db)){
           User::find(Auth::id())->update([
            'password' => Hash::make($request->password)
           ]);
        }else{
            return back()->withErrors("Your Old Password dose not match Database Password");
        }

        return back()->with('password_change_status','Your Password Change Successfully!!');
    }
}
