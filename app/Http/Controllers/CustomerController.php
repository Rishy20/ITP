<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;

class CustomerController extends Controller
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
        $cust = Customer::all();
        return view('customer.customerAllForm',compact('cust'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.addCustomer');
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

            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'streetaddress' => 'required',
            'city' => 'required',

        ]);
        Customer::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/customer');


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
        $cust = Customer::find($id);
        return view('customer.editCustomer',compact('cust','id'));
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

            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'streetaddress' => 'required',
            'city' => 'required',

        ]);

        $cust = Customer::find($id);

        $cust->firstname = $request->input('firstname');
        $cust->lastname = $request->input('lastname');
        $cust->gender = $request->input('gender');
        $cust->dob = $request->input('dob');
        $cust->email = $request->input('email');
        $cust->phone = $request->input('phone');
        $cust->streetaddress = $request->input('streetaddress');
        $cust->city = $request->input('city');

        $cust->save();
        Session::put('message', 'Success!');
        return redirect('/customer');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cust = Customer::find($id);
        $cust->delete();
        Session::put('message', 'Success!');
        return redirect('/customer');
    }




    public function createReport(Request $request){

        $customer =  DB::select('select ID, firstname,lastname,gender,dob,email,phone,streetaddress,city from customers');
    
        // // return view ('Barcode.printBarcode',compact('product'));
    
        view()->share('customer',$customer);
    
    
        $pdf =  PDF::loadView('customer.customerReport',$customer);
    
        // // download PDF file with download method
        return $pdf->stream('customer.pdf');
        return view('customer.customerReport',compact('customer'));
    }
}

