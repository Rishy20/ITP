<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginPosController extends Controller
{
    public function index(){

        return view('POS.poslogin');
    }

    public function login(Request $request){


        $this->validate($request,[
            'pin'=>'required',
        ]);

        $user =  DB::table('users')
                ->where('pin','=',$request->pin)
                ->get();
            // dd($user);

        if(sizeof($user)>0){
            foreach($user as $u){
                $uid = $u->id;
            }
            $user = User::find($uid);
            Auth::guard('pos')->login($user);
            return redirect()->intended(route('pos'));
        }

        Session::put('fail', 'Invalid Credentials');

        return redirect()->back();
    }
    public function logout(Request $request){

        auth()->guard()->logout();

        $request->session()->flush();

        return  redirect('/pos/login');

    }
}
