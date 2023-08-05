<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;

class AdminPasswordController extends Controller
{
    //passowrd change method
    public function passwordChangeView(){
        $pageTitle = 'Password Change';
        return view('backend.pages.profile.password',compact('pageTitle'));
    }

    // password change
    public function passwordChange(PasswordRequest $request){
        $user = Auth::guard('admin')->user();
        if(Hash::check($request -> old_password, $user->password) == false){
            return redirect()->back()->with('error','Old Password Not Match');
        }else{
            $admin =  Admin::findOrFail(Auth::guard('admin')->user()->id);
            // dd($admin);
            $admin -> password = bcrypt($request->password);
            $admin -> update();
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('success','Password Successfully Changed');
        }
    }

     //profile view retutn
     public function profile(){
        $pageTitle = 'Profile View';
        return view('backend.pages.profile.profile',compact('pageTitle'));
    }

    // admin profile update
    public function profileUpdate(Request $request){
        $user = Auth::guard('admin')->user();
        $id = Auth::guard('admin')->user()->id;
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'. $id,
            'profile' => 'mimes:png,jpg'
        ]);

       $profile =  uploadSingleImg($request -> profile, 'backend/uploads/admin' , $user -> profile , '150x150');

        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> profile = $profile;
        $user -> update();

        return redirect() -> back() -> with('success' , 'Profile Updated Successfully');
    }




}
