<?php

namespace App\Http\Controllers;

use App\Exchange;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class ExchangeController extends Controller
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
        $exchanges = Exchange::all();
        $exchanges = DB::select('select e.id,e.productID,e.customerID,e.salesmanID,e.amount,e.created_at,p.pcode,c.firstname,c.lastname,em.fname,em.lname from exchanges e, products p, employees em, customers c where e.productID = p.id and e.customerID = c.id and e.salesmanID=em.id');

        return view('exchangefolder.displayExchangeDetails',compact('exchanges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exchangefolder.createExchangePage');
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

            'productID'=>'required',
            'customerID'=>'required',
            'salesmanID'=>'required',
            'amount'=>'required',


        ]);
        Exchange::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/exchange');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function show(Exchange $exchanges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $exchange = Exchange::find($id);

        return view ('exchangefolder.exchangeEdit',compact('exchanges','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'productID'=>'required',
            'customerID'=>'required',
            'salesmanID'=>'required',
            'amount'=>'required',



        ]);
        $exchanges = Exchange::find($id);


        $exchanges->productID=$request->input('productID');
        $exchanges->customerID=$request->input('customerID');
        $exchanges->salesmanID=$request->input('salesmanID');
        $exchanges->amount=$request->input('amount');


          $exchanges->save();
          Session::put('message', 'Success!');
          return redirect('/exchange');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $exchanges = Exchange::find($id);
        $exchanges->delete();

        Session::put('message', 'Success!');
        return redirect('/exchange');
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

        $exchanges = DB::select('select e.id,e.productID,e.customerID,e.salesmanID,e.amount,e.created_at,p.pcode,c.firstname,c.lastname,em.fname,em.lname from exchanges e, products p, employees em, customers c where e.productID = p.id and e.customerID = c.id and e.salesmanID=em.id and e.created_at >= ? and e.created_at < ? order by e.created_at',[$sdate,$edate]);

        // // return view ('Barcode.printBarcode',compact('product'));

        $newEndDate = date("Y-m-d") ;
        if($time==1 || $time == 0){
            $data = [
                'exchanges'   => $exchanges,
                'sdate' => $sdate,
                'edate'  => $newEndDate,
            ];

        }else if($time == 100){
            $data = [
                'exchanges'   => $exchanges,
                'sdate' => $sdate,
                'edate'  => $end,
            ];
        }else{
            $data = [
                'exchanges'   => $exchanges,
                'sdate' => $sdate->format('Y-m-d'),
                'edate'  => $newEndDate,
            ];
        }


        view()->share('exchanges',$data);


        $pdf =  PDF::loadView('exchangefolder.exchangeReport',$data);

        // // download PDF file with download method
        return $pdf->stream('exchanges.pdf');
        return view('exchangefolder.exchangeReport',compact('exchanges','sdate','edate'));
    }
}
