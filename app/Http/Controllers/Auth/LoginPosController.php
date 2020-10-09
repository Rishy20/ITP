<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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


        if($user){
            foreach($user as $u){
                $uid = $u->id;
            }
            $user = User::find($uid);
            Auth::guard('pos')->login($user);
            return redirect()->intended(route('pos'));
        }


        return redirect()->back();
    }
}
