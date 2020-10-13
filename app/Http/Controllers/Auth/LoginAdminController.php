<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginAdminController extends Controller
{
    public function index(){

        return view('login');
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
        ]);

        if(Auth::guard('admin')->attempt(['username'=>$request->username,'password'=>$request->password])) {
            // dd(Auth::user());
            return redirect()->intended(route('dashboard'));
        }
        Session::put('fail', 'Invalid Credentials');

        return redirect()->back();
    }
    public function logout(Request $request){

        auth()->guard()->logout();

        $request->session()->flush();

        return  redirect('/login');

    }
}
