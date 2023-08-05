<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\AdminPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this -> middleware('guest:admin')->except('logout');
    }


    //login view return
    public function loginView(){
        return view('backend.auth.login');
    }



    // Admin Login Method
    public function adminLogin(Request $request){

        $data = $request -> validate([
            'email'  => 'required|email',
            'password' => 'required'
        ]);


        $remember = $request -> remember == 'on' ? true : false;

        if(auth()->guard('admin')->attempt($data, $remember)){
            return redirect()->route('admin.home')->with('success','Login Successful');
        }
        return redirect()->route('admin.login')->with('error','Invalid Credentials');



    }


    // return forget password eamil view
    public function emailView(){
        return view('backend.auth.email');
    }



    // forget password email verification
    public function codeSend(Request $request){
        $request -> validate([
            'email'  => 'required|email|exists:admins,email',
        ]);

        $user = Admin::where('email' , $request -> email)->first();

        $code = verificationCode(6);

        AdminPasswordReset::updateOrCreate(['email' => $request -> email],[
            'email' => $request -> email,
            'token' => $code,
            'status' => 0,
        ]);

        $request->session()->put('email_token', [
            'email' => $request -> email,
            'token' => $code,
        ]);

        $data = [
            'name' => $user -> name,
            'subject' => 'Password Reset Verification Code',
            'message' => 'Hello '.$user -> name.' Here is you password reset code: ' . $code,
            'email' => $request -> email,
        ];

        $general = Settings::find(1);

        phpMailer($data,$general);

        return redirect() -> route('admin.code.view')->with('success' , 'Email set to youe email');
    }

    public function codeView(){
        return view('backend.auth.code');
    }

    public function codeVerify(Request $request){
        $request -> validate([
            'code' => 'required',
        ]);

        $session = Session::get('email_token');

        $email = $session['email'];
        $code = $session['token'];

        $user =  AdminPasswordReset::where('email' , $email)->where('token' , $code)->first();


        if($code == $request -> code){
            $user->delete();
            return redirect() -> route('admin.reset.view');
        }else{
            $notify[] = ['error', 'Invalid Code'];
            return redirect()->back()->withNotify($notify);
        }

    }

    public function resetView(){
        return view('backend.auth.reset');
    }


    public function resetPassword(Request $request){
        $request->validate([
            'password' => 'required|min:3|max:6|confirmed'
        ]);

        $session = Session::get('email_token');

        $email = $session['email'];
        $code = $session['token'];

        $user = Admin::where('email' , $email)->first();

        $user -> password = bcrypt($request -> password);
        $user -> save();

        session()->forget('email_token');
        session()->flush();

        $notify[] = ['success', 'Your Password Successfully Updated'];
        return redirect()->route('admin.login')->withNotify($notify);


    }


    // logout admin
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success' , 'Logout Successfully');
    }
}
