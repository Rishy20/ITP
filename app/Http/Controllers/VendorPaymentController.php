<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendorPayment;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorPayment = VendorPayment::all()->toArray();
        return view('VendorPayment.allVendorPayment',compact('vendorPayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('VendorPayment.addVendorPayment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // $request->validate([
        //     'paymentType' => 'required|max:20',
        //     'amount' => 'required|min:100',
        //     'date' => 'required',
        // ]);

        VendorPayment::create($request->all());
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
        $vendorPayment = VendorPayment::find($id);
        return view('vendorPayment.editVendorPayment', compact('vendorPayment', 'id'));
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
        $vendorPayment = VendorPayment::findOrFail($id);

        $input = $request->all();
        $vendorPayment->update($input);
        return redirect('/vendorPayment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendorPayment = VendorPayment::findOrFail($id);
        $vendorPayment->delete();
        return redirect()->back();
    }
}
