<?php

namespace App\Http\Controllers;

use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

use function Ramsey\Uuid\v1;

class SalesController extends Controller
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
        $sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,s.updated_at
         from sales s,employees e, customers c
        where s.customerId = c.id and s.staffId = e.id' );

        return view('Sales.allSales',compact('sale'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,c.phone,s.updated_at
        from sales s,employees e, customers c
       where s.customerId = c.id and s.staffId = e.id and s.id = ?',[$id] );

       $product = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,s.qty,s.price,s.discount from sales_products s left join products p on s.pid = p.id left join variants v on s.vid = v.id  where  s.saleId = ? ',[$id]);

        return view('Sales.showSales',compact('sale','product'));
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
        //
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
        }else if($time = 2){
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



        $sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,s.updated_at
        from sales s,employees e, customers c
       where s.customerId = c.id and s.staffId = e.id and s.created_at >= ? and s.created_at < ? order by s.created_at',[$sdate,$edate] );

        $tamount = DB::select('select sum(amount) as totamount
        from sales s where s.created_at >= ? and s.created_at < ? ',[$sdate,$edate] );

        $tdiscount = DB::select('select sum(discount) as totdiscount
        from sales s where s.created_at >= ? and s.created_at < ? ',[$sdate,$edate] );


        foreach($tamount as $t){
            $totamount = $t->totamount;
        }
        foreach($tdiscount as $t){
            $totdiscount = $t->totdiscount;
        }

        $newEndDate = date("Y-m-d") ;
        if($time==1 || $time == 0){
            $data = [
                'sales'   => $sale,
                'sdate' => $sdate,
                'edate'  => $newEndDate,
                'totamount' => $totamount,
                'totdiscount' => $totdiscount,
            ];

        }else if($time == 100){
            $data = [
                'sales'   => $sale,
                'sdate' => $sdate,
                'edate'  => $end,
                'totamount' => $totamount,
                'totdiscount' => $totdiscount,
            ];
        }else{
            $data = [
                'sales'   => $sale,
                'sdate' => $sdate->format('Y-m-d'),
                'edate'  => $newEndDate,
                'totamount' => $totamount,
                'totdiscount' => $totdiscount,
            ];
        }

        // dd($data);
        view()->share('sales',$data);

        $pdf =  PDF::loadView('Sales.salesReport',$data);

        // // download PDF file with download method
        return $pdf->stream('sales.pdf');
        return view('Sales.salesReport',compact('sales','sdate','edate'));
    }
}
