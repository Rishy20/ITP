<?php

namespace App\Http\Controllers;

use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use PDF;

class VoucherController extends Controller
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
        $voucher = Voucher::all();
        return view ('Voucher.show',compact('voucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voucher.create');

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
            'amount'=>'required',
            'exp'=>'required',
            ]);

        Voucher::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/voucher');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    public function getLastIndex(){

        $last = DB::table('vouchers')->latest()->first();
        $voucherId = $last->id;
        return $voucherId + 1;
    }

    public function getVoucherAmount($id){

        $voucher = Voucher::find($id);

        if($voucher->redeem_status == 0){
            return $voucher->amount;
        }else{
            return -2;
        }
        if($voucher->exp > date("Y-m-d")){
            return $voucher->amount;
        }else{
            return -1;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $voucher = Voucher::find($id);
        return view('Voucher.edit',compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {

    }

    public function updateVoucher(Request $request){

        $voucher = Voucher::findOrFail($request->id);
        $voucher->amount = $request->input('amount');
        $voucher->exp = $request->input('exp');
        $voucher->redeem_status = $request->input('redeem_status');
        $voucher->update();
        Session::put('message', 'Success!');
        return redirect('/voucher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }

    public function createReport(Request $request){

        $voucher =  DB::select('select v.id, amount, exp,redeem_status from vouchers v');

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('voucher',$voucher);


        $pdf =  PDF::loadView('Voucher.voucherReport',$voucher);

        // // download PDF file with download method
        return $pdf->stream('voucher.pdf');
        return view('Voucher.voucherReport',compact('voucher'));
    }
}
