<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class VendorController extends Controller
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
        $vendor = Vendor::all();
        return view('Vendor.allVendor',compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Vendor.addVendor');
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
        // 'first_name'=>'required|max:50',
        // 'last_name'=>'required|max:50',
        // 'company_name'=>'required|max:20',
        // 'address'=>'required|max:50',
        // 'city'=>'required|max:10',
        // 'email'=>'required|max:20',
        // 'phone_no'=>'required|max:50',
        // ]);
        Vendor::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/vendors');
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

        $v = Vendor::find($id);
        return view('vendor.editvendor',compact('v'));
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
        $vendor = Vendor::findOrFail($id);
        $input=$request->all();
        $vendor->update($input);
        Session::put('message', 'Success!');
        return redirect('/vendors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }
    public function createReport(Request $request){

        $vendor = Vendor::all();
        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('vendor',$vendor);


        $pdf =  PDF::loadView('vendor.vendorReport',$vendor);

        // // download PDF file with download method
        return $pdf->stream('vendor.pdf');
        return view('vendor.vendorReport',compact('vendor'));
    }
}


