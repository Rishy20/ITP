<?php

namespace App\Http\Controllers;

use App\User;
use App\userRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Session::has('status1'));
        $user = DB::select('select u.id, username,display_name,password,pin,status,roleId,Role_name from users u, user_roles ur where u.roleId = ur.id');
        return view ('User.allUsers',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = userRole::all();
        return view('User.addUser',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required|max:50',
            'password'=>'required|max:20',
            'display_name'=>'required|max:50'
        ]);
        User::create($request->all());
        Session::put('message', 'Success!');

        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = userRole::all();
        return view('User.editUser',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->input('username');
        $user->display_name = $request->input('display_name');
        $user->roleId = $request->input('roleId');
        $user->save();
        Session::put('message', 'Success!');
        return redirect('/user');

    }

    public function updatePassword(Request $request, $id){
        $user = User::findOrFail($id);
        $user->password = $request->input('newpass');
        $user->save();
        Session::put('message', 'Success!');
        return redirect('/user');
    }
    public function updatePin(Request $request, $id){
        $user = User::findOrFail($id);
        $user->pin = $request->input('newpin');
        $user->save();
        Session::put('message', 'Success!');
        return redirect('/user');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }
}
