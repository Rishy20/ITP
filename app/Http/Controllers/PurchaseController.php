<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Purchase::all();
        return view('order.purchase', compact('purchase'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('message', 'Success!');
        return view('order.createOrder');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'date' => 'required',
        //     'expectedDate' => 'required',
        //     'qty' => 'required|min:1',
        //     'supplyPrice' => 'required|min:1',
        //     'note' => 'required',
        //     'vendorID' => 'required'
        // ]);

        Purchase::create($request->all());
        return redirect('/purchase');
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
        $purchase = Purchase::find($id);
        return view('order.editPurchaseOrder',compact('purchase','id'));
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
        // $this->validate($request,[
        //     'date' => 'required',
        //     'expectedDate' => 'required',
        //     'qty' => 'required|min:1',
        //     'supplyPrice' => 'required|min:1',
        //     'note' => 'required',
        //     'vendorID' => 'required'
        // ]);

        $purchase = Purchase::findOrFail($id);

        $input = $request->all();
        $purchase->update($input);
        Session::put('message', 'Success!');
        return redirect('/purchase');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        Session::put('message', 'Success!');

        return redirect()->back();
    }
}
