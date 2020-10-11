<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryPayment;
use Illuminate\Support\Facades\Session;
use PDF;
use App\Employee;
use Illuminate\Support\Facades\DB;

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
        $employee = Employee::all();
        $salaryPayment = DB::select('select s.id, fname,lname,amount,date from salary_payment s,employees e where s.staffId = e.id');
        return view('StaffPayment.allStaffPayment',compact('salaryPayment','employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::all();
        return view('StaffPayment.addStaffPayment',compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->amount as $key=>$a){
            $sp = new SalaryPayment();
            $sp->staffID = $key;
            $sp->amount = $a;
            $sp->date = now();
            $sp->save();
        }

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
