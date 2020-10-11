<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use Illuminate\Support\Facades\Session;
use PDF;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Vendor;

class PurchaseController extends Controller
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
        $vendor = Vendor::all();

        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');
        return view('order.createOrder',compact('prd','vendor'));
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
        Session::put('message', 'Success!');
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
        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');

        $purchase = Purchase::find($id);
        $vendor = Vendor::all();
        return view('order.editPurchaseOrder',compact('purchase','id','prd','vendor'));
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

    public function createReport(Request $request){

        $purchase =  Purchase::all()->toArray();

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('purchase',$purchase);


        $pdf =  PDF::loadView('order.purchaseReport',$purchase);

        // // download PDF file with download method
        return $pdf->stream('purchase.pdf');
        return view('order.purchaseReport',compact('purchase'));
    }
}
