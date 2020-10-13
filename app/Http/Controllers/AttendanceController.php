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

        if(isset($_COOKIE['timeperiod'])){
            $time = $_COOKIE['timeperiod'];
        }else{
            $time = 0;
        }
        date_default_timezone_set('Asia/Colombo');
        $date = date_create(date("Y-m-d")) ;
        setcookie("timeperiod","",time()-3600);

        if($time == 1 || $time == 0){
            $sdate = date("Y-m-d") ;
            $diff = new DateInterval('P1D');
            $edate = date_add($date,$diff);
        }else if($time == 2){
            $eddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P0D');
            $edate = date_add($eddate,$diff);
            $sddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P1D');
            $sdate = date_sub($sddate,$diff);
        }else if($time == 7 ){
            $eddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P1D');
            $edate = date_add($eddate,$diff);
            $sddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P7D');
            $sdate = date_sub($sddate,$diff);
        }else if($time == 14){
            $eddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P1D');
            $edate = date_add($eddate,$diff);
            $sddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P14D');
            $sdate = date_sub($sddate,$diff);
        }else if($time == 30){
            $eddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P1M');
            $edate = date_add($eddate,$diff);

            $sddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P1M');
            $sdate = date_sub($sddate,$diff);

        }else if($time == 60){
            $eddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P1D');
            $edate = date_add($eddate,$diff);
            $sddate = date_create(date("Y-m-d")) ;
            $diff = new DateInterval('P2M');
            $sdate = date_sub($sddate,$diff);
        }else if($time == 100){
            $sdate = $_COOKIE['start'];
            $end = $_COOKIE['end'];
            $datee = strtotime($end);
            $edate = date("Y-m-d", strtotime("+1 day", $datee));
            setcookie("start","",time()-3600);
            setcookie("end","",time()-3600);
        }

        $attendance =  DB::select('select a.id,a.created_at,a.in,a.out,a.e_id,e.id as eid,e.fname,e.lname from employees e LEFT JOIN attendances a ON e.id = a.e_id and a.created_at >= ? and a.created_at < ?',[$sdate,$edate]);

        $newEndDate = date("Y-m-d") ;
        if($time==1 || $time == 0){
            $data = [
                'attendance'   => $attendance,
                'sdate' => $sdate,
                'edate'  => $newEndDate,
            ];

        }else if($time == 100){
            $data = [
                'attendance'   => $attendance,
                'sdate' => $sdate,
                'edate'  => $end,
            ];
        }else{
            $data = [
                'attendance'   => $attendance,
                'sdate' => $sdate->format('Y-m-d'),
                'edate'  => $newEndDate,
            ];
        }


        view()->share('attendance',$data);


        $pdf =  PDF::loadView('Attendance.attendanceReport',$data);

        // // download PDF file with download method
        return $pdf->stream('attendance.pdf');
        return view('Attendance.attendanceReport',compact('attendance'));
    }
}
