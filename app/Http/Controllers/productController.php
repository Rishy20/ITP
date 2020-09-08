<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Inventory;
use App\Product;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product =DB::select('select p.id,p.pcode,p.name,p.description,p.brand,p.catID,p.sellingPrice,p.costPrice,p.discount,p.Qty,v.first_name,v.last_name from products p, vendors v where p.supplierId = v.id ');

        return view('Product.allProduct',compact('product'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat =Category::all();
        $inv =Inventory::all();
        $brand = Brand::all();
        $vendor = Vendor::all();
        $last = DB::table('products')->latest()->first();
        $barcode = $last->barcode;

        return view('Product.addProduct',compact('cat','inv','brand','vendor','barcode'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = Product::findOrFail($id);
        $cat =Category::all();
        $inv =Inventory::all();
        $brand = Brand::all();
        $vendor = Vendor::all();
        return view('Product.editProduct',compact('p','cat','inv','brand','vendor'));
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
        $Product=Product::findOrFail($id);
        $Product->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }
}
