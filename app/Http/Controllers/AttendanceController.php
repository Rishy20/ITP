<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class AttendanceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = DB::select('select a.id,a.created_at,a.in,a.out,a.e_id,e.id as eid,e.fname,e.lname from employees e LEFT JOIN attendances a ON e.id = a.e_id' );
        $employee = Employee::all();
        return view ('Attendance.show',compact('attendance','employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendance.create');
        return redirect('/attendance');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Colombo');
        $date = date_create(date("Y-m-d")) ;
        $diff1Day = new DateInterval('P1D');
        $size = sizeof($request->emp);
        $count = 0;
        foreach($request->emp as $key=>$e){
            $temp = DB::table('attendances')
                ->where('e_id','=',$key)
                ->where('created_at', '>=', date("Y-m-d"))
                ->where('created_at', '<', date_add($date,$diff1Day))
                ->get();
            if(sizeof($temp) > 0){

            }else{
                $attendance = new Attendance();
                $attendance->e_id = $key;
                $attendance->in = $request->arrival;
                $attendance->save();
                $count++;
            }
        }
        if($count > 0){
            Session::put('message', 'Success!');
        }
        return redirect()->back();
        // $request->validate([

        //     'date'=>'required',
        //     'in'=>'required',
        //     'out'=>'required',
        //     ]);

        // Attendance::create($request->all());
        // return redirect()->back();
    }

    public function markOut(Request $request)
    {
        $date = date_create(date("Y-m-d")) ;
        $diff1Day = new DateInterval('P1D');
        // $t = DB::table('attendances')
        //             ->where('created_at', '>=', date("Y-m-d"))
        //             ->where('created_at', '<', date_add($date,$diff1Day))
        //             ->get();
        //             dd($t);
        foreach($request->emp as $key=>$e){
            // $attendance = DB::update('update attendances set out = ? where e_id = ? and created_at >= ? and created_at < ?', [$request->time , $key, date("Y-m-d"), date_add($date,$diff1Day)]);
            DB::table('attendances')
                    ->where('e_id','=',$key)
                    ->where('created_at', '>=', date("Y-m-d"))
                    ->where('created_at', '<', date_add($date,$diff1Day))
                    ->update(['out'=>$request->time]);
        }
        Session::put('message', 'Success!');
        return redirect()->back();

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = Attendance::find($id);
        return view('Attendance.edit',compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function updateAttendance(Request $request)
    {
        $attendance = Attendance::findOrFail($request->input('id'));
        $attendance->in = $request->input('in_edit');
        $attendance->out = $request->input('out_edit');

        $attendance->save();
        Session::put('message', 'Success!');
        return redirect('/attendance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //$attendance = Attendance::findOrFail($id);
        $attendance->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }

    public function createReport(Request $request){

        //$attendance =  DB::select('select a.id, in, out from attendances a, fname e where a.fname = e.fname');
        $attendance =  DB::select('select a.id,a.created_at,a.in,a.out,a.e_id,e.id as eid,e.fname,e.lname from employees e LEFT JOIN attendances a ON e.id = a.e_id');

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('attendance',$attendance);


        $pdf =  PDF::loadView('Attendance.attendanceReport',$attendance);

        // // download PDF file with download method
        return $pdf->stream('attendance.pdf');
        return view('Attendance.attendanceReport',compact('attendance'));
    }
}
