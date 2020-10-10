<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductReturn;
use App\ReturnProducts;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReturnController extends Controller
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
        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price,v.quantity,p.Qty from products p LEFT JOIN variants v ON p.id = v.product_id');
        return view('Product.returnProduct',compact('vendor','prd'));
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

        $rp = new ReturnProducts();
        $rp->vendorId = $request->vendorId;
        $rp->date = $request->date;
        $rp->remarks = $request->remarks;
        $rp->save();

        $pr = $_COOKIE['returnproducts'];
        $temp = json_decode($pr,true);
        $last = DB::table('return_products')->latest()->first();
        $returnid = $last->id;
        setcookie("returnproducts","",time()-3600);
        foreach($temp as $t){

            $p = new ProductReturn();
            $p->returnId = $returnid;
            $p->productId = $t[0];
            if($t[1] != null){
                $p->variantId = $t[1];
            }
            $p->qty = $t[2];
            $p->save();

            $product = DB::table('products')
            ->where('id','=',$t[0])
            ->get();

            //Deduct from Products table
            foreach($product as $prd){
                $qty = $prd->Qty;
            }
            $newQty = $qty - $t[2];
            DB::update('update products set Qty = ? where id = ?', [$newQty,$t[0]]);

            //Deduct from variants table

            if($t[1] != null){
                $variant = DB::table('variants')
                ->where('id','=',$t[1])
                ->get();

                //Deduct from Products table
                foreach($variant as $v){
                    $qty = $v->quantity;
                }
                $newQty = $qty - $t[2];
                DB::update('update variants set quantity = ? where id = ?', [$newQty,$t[1]]);
            }
        }
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

    public function getVendorProducts($id){
        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price,v.quantity,p.Qty from products p LEFT JOIN variants v ON p.id = v.product_id Where p.supplierId = ?',[$id]);
        return $prd;
    }
}
