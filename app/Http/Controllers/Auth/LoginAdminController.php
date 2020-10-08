<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->back();
    }
}
