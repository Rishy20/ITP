<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankAccount;
class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = BankAccount::all();
        return view('bankfolder.displayBankDetails',compact('banks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bankfolder.bankAccountPage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           
            'number'=>'required',
            'name'=>'required',
            'type'=>'required',
            'bankname'=>'required',
            'branchname'=>'required',

        ]);
        $banks = new BankAccount;
        $banks->number=$request->input('number');
        $banks->name=$request->input('name');
        $banks->type=$request->input('type');
        $banks->bankname=$request->input('bankname');
        $banks->branchname=$request->input('branchname');

       

        $banks->save();

        return redirect('/bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banks = BankAccount::find($id);
        return view ('bankfolder.bankEditPage',compact('banks','id'));
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
        $this->validate($request,[
           
            'number'=>'required',
            'name'=>'required',
            'type'=>'required',
            'bankname'=>'required',
            'branchname'=>'required',


        ]);
        $banks = BankAccount::find($id);


        $banks->number=$request->input('number');
        $banks->name=$request->input('name');
        $banks->type=$request->input('type');
        $banks->bankname=$request->input('bankname');
        $banks->branchname=$request->input('branchname');

          $banks->save();
          return redirect('/bank');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banks = BankAccount::find($id);
        $banks->delete();

        return redirect('/bank');
    }
}
