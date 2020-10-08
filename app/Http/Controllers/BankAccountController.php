<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankAccount;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\DB;

class BankAccountController extends Controller
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
        $request->validate([

            'number'=>'required|max:8',
            'name'=>'required',
            'type'=>'required',
            'bankname'=>'required',
            'branchname'=>'required',

        ]);
        BankAccount::create($request->all());
        Session::put('message', 'Success!');

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
        $request->validate([

            'number'=>'required|max:8',
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
        //   BankAccount::create($request->all());
        Session::put('message', 'Success!');
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
        Session::put('message', 'Success!');
        return redirect('/bank');
    }
    
    public function createReport(Request $request){

        $banks =  DB::select('select number,name,type,bankname,branchname from bank_accounts');

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('banks',$banks);


        $pdf =  PDF::loadView('bankfolder.bankAccountReport',$banks);

        // // download PDF file with download method
        return $pdf->stream('banks.pdf');
        return view('bankfolder.bankAccountReport',compact('banks'));
    }

}
