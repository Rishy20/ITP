<?php

namespace App\Http\Controllers;

use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
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
        //$voucher = Voucher::findOrFail($id);
        $voucher->amount = $request->input('amount');
        $voucher->exp = $request->input('exp');

        $voucher->save();
        Session::put('message', 'Success!');
        return redirect('/voucher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        Session::put('message', 'Success!');

        return redirect()->back();
    }
}
