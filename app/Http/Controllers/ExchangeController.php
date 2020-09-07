<?php

namespace App\Http\Controllers;

use App\Exchange;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exchanges = Exchange::all();
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
           
            'productID'=>'required|max:5',
            'customerID'=>'required|max:3',
            'salesmanID'=>'required|max:3',
            'amount'=>'required',
            'date'=>'required',

        ]);
        Exchange::create($request->all());
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
        return view ('exchangefolder.exchangeEdit',compact('exchange','id'));
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
            'date'=>'required',


        ]);
        $exchanges = Exchange::find($id);


        $exchanges->productID=$request->input('productID');
        $exchanges->customerID=$request->input('customerID');
        $exchanges->salesmanID=$request->input('salesmanID');
        $exchanges->amount=$request->input('amount');
        $exchanges->date=$request->input('date');

          $exchanges->save();
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

        return redirect('/exchange');
    }
}
