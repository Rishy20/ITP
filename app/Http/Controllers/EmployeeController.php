<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;

class EmployeeController extends Controller
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

        //$employee =  DB::select('select fname, lname, nic, address, mobile, home, joined_date, target, salary, salary_type, commission from employees emp');
        return view ('Employee.show',compact('employee'));


        //return Employee::all();
        //dd($request->all());
        //return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');

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
            'fname'=>'required|max:20',
            'lname'=>'required|max:20',
            'nic'=>'required|max:10',
            'address'=>'required|max:50',
            'mobile'=>'required|max:10',
            'home'=>'required|max:10',
            'birthday'=>'required',
            'joined_date'=>'required',
            'target'=>'required',
            'salary'=>'required',
            'salary_type'=>'required',
            'commission'=>'required'
        ]);

        Employee::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/employee');

        /* $employee = new employee;
        $employee->first_name = request('fname');
        $employee->last_name = request('lname');
        $employee->nic = request('nic');
        $employee->phone = request('phone');
        $employee->birthday = request('birthday');
        $employee->address = request('address');
        $employee->target = request('target');
        $employee->salary = request('salary');
        $employee->salary_type = request('salary_type');
        $employee->commission = request('commission');
        $employee->joined_date = request('joined_date');

        $employee->save();
        return redirect()->back(); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $employee = Employee::find($id);
        return view('Employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //$employee = Employee::findOrFail($emp_id);
        $employee->fname = $request->input('fname');
        $employee->lname = $request->input('lname');
        $employee->nic = $request->input('nic');
        $employee->address = $request->input('address');
        $employee->mobile = $request->input('mobile');
        $employee->home = $request->input('home');
        $employee->birthday = $request->input('birthday');
        $employee->joined_date = $request->input('joined_date');
        $employee->target = $request->input('target');
        $employee->salary = $request->input('salary');
        $employee->salary_type = $request->input('salary_type');
        $employee->commission = $request->input('commission');

        $employee->save();
        Session::put('message', 'Success!');
        return redirect('/employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }

    public function createReport(Request $request){

        $employee =  DB::select('select e.id,fname, lname, nic, address, mobile, home, joined_date, target, salary, salary_type, commission from employees e');

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('employee',$employee);


        $pdf =  PDF::loadView('Employee.employeeReport',$employee);

        // // download PDF file with download method
        return $pdf->stream('employee.pdf');
        return view('Employee.employeeReport',compact('employee'));
    }
}
