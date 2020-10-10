<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryPayment;
use Illuminate\Support\Facades\Session;
use PDF;

class SalaryPaymentController extends Controller
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
        $salaryPayment = SalaryPayment::all()->toArray();
        return view('StaffPayment.allStaffPayment',compact('salaryPayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('StaffPayment.addStaffPayment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SalaryPayment::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/salaryPayment');
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
        $salaryPayment = SalaryPayment::find($id);
        return view('staffPayment.editStaffPayment', compact('salaryPayment', 'id'));
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
        $salaryPayment = SalaryPayment::findOrFail($id);

        $input = $request->all();
        $salaryPayment->update($input);
        Session::put('message', 'Success!');
        return redirect('/salaryPayment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salaryPayment = SalaryPayment::findOrFail($id);
        $salaryPayment->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }

    public function createReport(Request $request){

        $salaryPayment =  SalaryPayment::all()->toArray();

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('salaryPayment',$salaryPayment);


        $pdf =  PDF::loadView('StaffPayment.staffPaymentReport',$salaryPayment);

        // // download PDF file with download method
        return $pdf->stream('StaffPayment.pdf');
        return view('StaffPayment.staffPaymentReport',compact('salaryPayment'));
    }
}
