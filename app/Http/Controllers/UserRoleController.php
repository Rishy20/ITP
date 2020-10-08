<?php

namespace App\Http\Controllers;

use App\userRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = userRole::all();

        return view ('User.allUserRole',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.addUserRole');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        userRole::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/role');
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
        $role = userRole::find($id);


        return view('User.editUserRole',compact('role'));
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
        // $user = User::findOrFail($id);
        // $user->username = $request->input('username');
        // $user->display_name = $request->input('display_name');
        // $user->roleId = $request->input('roleId');
        // $user->save();
        // return redirect('/user');
        Session::put('message', 'Success!');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $role = userRole::findOrFail($id);
         Session::put('message', 'Success!');

        $role->delete();
         return redirect()->back();
    }
}

