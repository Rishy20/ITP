<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class brandController extends Controller
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
        $brand= Brand::all();

        return view ('Brand.allBrand',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Brand.addBrand');
        Session::put('message', 'Success!');
        return redirect('/brand');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Brand::create($request->all());
        return \redirect('/brand');
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
        $brand= Brand::find($id);

        return view('Brand.editBrand',compact('brand'));
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
        $brand=Brand::findOrFail($id);
        $input=$request->all();
        $brand->update($input);
        Session::put('message', 'Success!');
        return redirect('/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::findOrFail($id);
        $brand->delete();
        Session::put('message', 'Success!');
        return redirect()->back();

    }
    public function createReport(Request $request){

        $brand =  DB::select('select b.name,b.description,count(brand) as count  from brands b , products p  where p.brand = b.id group by p.brand ');

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('brand',$brand);


        $pdf =  PDF::loadView('Brand.brandReport',$brand);

        // // download PDF file with download method
        return $pdf->stream('brands.pdf');
        return view('Brand.brandReport',compact('brand'));
    }
}

