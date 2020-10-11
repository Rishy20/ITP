<?php

namespace App\Http\Controllers;

use App\User;
use App\userRole;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
        // dd(Auth::user()->id);
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $role = userRole::find($user->roleId);
        $date = date_create(date("Y-m-d")) ;
        $diff1Day = new DateInterval('P1D');
        $time= strtotime(date("Y-m-d"));

        $tsales = DB::select('select sum(amount) as totamount
        from sales s where s.created_at >= ? and s.created_at < ? ',[date("Y-m-d"),date_add($date,$diff1Day)] );

        $tproducts = DB::select('select sum(qty) as totqty
        from sales_products s where s.created_at >= ? and s.created_at < ? ',[date("Y-m-d"),date_add($date,$diff1Day)] );

        $texpenses = DB::select('select sum(amount) as totamount
        from expenses e where created_at >= ? and created_at < ? ',[date("Y-m-d"),date_add($date,$diff1Day)] );

        $tcp = DB::select('select sum(p.costPrice * sp.qty) as totcost
        from sales_products sp,products p where sp.pid = p.id and sp.created_at >= ? and sp.created_at < ? ',[date("Y-m-d"),date_add($date,$diff1Day)]);
        $j = 0;
        // $arr = array();
        // $arre = array();
        for($i = 9; $i>=0; $i--){
            $day[$j] = DB::select('select count(id) as scount
            from sales s where s.created_at >= ? and s.created_at < ? ',[date("Y-m-d", strtotime("-".$i." days", $time)),date("Y-m-d", strtotime("-".($i-1)." days", $time))] );
            $j++;
            // array_push($arr,date("Y-m-d", strtotime("-".$i." days", $time)));
            // array_push($arre,date("Y-m-d", strtotime("-".($i-1)." days", $time)));
        }


        // dd($arr,$arre,$day);
        foreach($tsales as $t){
            $totsales = $t->totamount;
        }
        foreach($tproducts as $t){
            $totproducts = $t->totqty;
        }
        foreach($texpenses as $t){
            $totexpenses = $t->totamount;
        }
        foreach($tcp as $t){
            $totcostprice = $t->totcost;
        }
        $grossprofit = $totsales - $totcostprice;
        $day = json_encode($day);
        if($role->viewDashboardStatistics){
            return view('dashboard',compact('totsales','totproducts','totexpenses','grossprofit','day'));
        }else{
            return view('noaccess');
        }

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
}
