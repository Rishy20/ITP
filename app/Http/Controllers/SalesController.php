<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SalesController extends Controller
{
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

    public function createReport(Request $request){

        $sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,s.updated_at
        from sales s,employees e, customers c
       where s.customerId = c.id and s.staffId = e.id' );

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('sales',$sale);


        $pdf =  PDF::loadView('Sales.salesReport',$sale);

        // // download PDF file with download method
        return $pdf->stream('sales.pdf');
        return view('Sales.salesReport',compact('sales'));
    }
}
