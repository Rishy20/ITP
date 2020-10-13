<?php

namespace App\Http\Controllers;

use App\Expense;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class ExpenseController extends Controller
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
        $expense = DB::table('expenses')->rightJoin('users', 'expenses.userId', '=', 'users.id')->get();
        $expense = DB::select('select e.id,type,description,e.created_at,amount,username from expenses e INNER JOIN users u ON e.userId=u.id' );


        return view('Expense.allExpenses',compact('expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Expense::create($request->all());
        Session::put('message', 'Success!');
        return redirect()->back();
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
        //
    }

    public function updateExpense(Request $request)
    {
        $expense=Expense::findOrFail($request->input('id'));
        $input=$request->all();
        $expense->update($input);
        Session::put('message', 'Success!');
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
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
        // dd(date_add($date,$diff1Day));
        // dd($time);
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

        $expense = DB::select('select e.id,type,description,e.created_at,amount,username from expenses e INNER JOIN users u ON e.userId=u.id and e.created_at >= ? and e.created_at < ? ',[$sdate,$edate] );

        // // return view ('Barcode.printBarcode',compact('product'));

        $newEndDate = date("Y-m-d") ;
        if($time==1 || $time == 0){
            $data = [
                'expense'   => $expense,
                'sdate' => $sdate,
                'edate'  => $newEndDate,
            ];

        }else if($time == 100){
            $data = [
                'expense'   => $expense,
                'sdate' => $sdate,
                'edate'  => $end,
            ];
        }else{
            $data = [
                'expense'   => $expense,
                'sdate' => $sdate->format('Y-m-d'),
                'edate'  => $newEndDate,
            ];
        }



        view()->share('expense',$data);


        $pdf =  PDF::loadView('Expense.expenseReport',$data);

        // // download PDF file with download method
        return $pdf->stream('expenses.pdf');
        return view('Expense.expenseReport',compact('expense'));
    }
}
