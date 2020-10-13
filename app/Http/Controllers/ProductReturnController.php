<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductReturn;
use App\ReturnProducts;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
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

        $returns = DB::select('select r.id, v.first_name, v.last_name,r.date, r.remarks from return_products r, vendors v where r.vendorId = v.id');
        return view('Product.allReturn',compact('returns'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = Vendor::all();
        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,p.costPrice,v.size,v.color,v.price,v.quantity,p.Qty from products p LEFT JOIN variants v ON p.id = v.product_id');
        return view('Product.returnProduct',compact('vendor','prd'));
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
        return redirect('/return');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $returns = DB::select('select r.id, v.first_name, v.last_name,r.date, r.remarks from return_products r, vendors v where r.vendorId = v.id and r.id = ?',[$id]);
        $tot = DB::select('select sum(p.costPrice * r.qty) as total from product_returns r, products p where r.productId = p.id and r.returnId = ? ',[$id]);
        foreach($tot as $t){
            $total = $t->total;
        }
       $product = DB::select('select r.id,pcode,p.name,v.size,v.color,r.qty,p.costPrice from product_returns r left join products p on r.productId = p.id left join variants v on r.variantId = v.id  where  r.returnId = ? ',[$id]);



        return view('Product.showReturn',compact('returns','total','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $r = DB::select('select r.id,v.id as vendorId, v.first_name, v.last_name,r.date, r.remarks from return_products r, vendors v where r.vendorId = v.id and r.id = ?',[$id]);
        $vendor = Vendor::all();
        foreach($r as $res){
            $return = $res;
        }
        $product = DB::select('select productId,variantId,qty from product_returns where returnId = ?', [$id]);

        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,p.costPrice,v.size,v.color,v.price,v.quantity,p.Qty from products p LEFT JOIN variants v ON p.id = v.product_id');
        return view('Product.editReturn',compact('vendor','prd','return','product'));

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

        $rp = ReturnProducts::find($id);
        $rp->vendorId = $request->vendorId;
        $rp->date = $request->date;
        $rp->remarks = $request->remarks;
        $rp->update();

        $pr = $_COOKIE['returnproducts'];
        $temp = json_decode($pr,true);
        $last = DB::table('return_products')->latest()->first();
        $returnid = $id;
        setcookie("returnproducts","",time()-3600);

        DB::delete('delete from product_returns where returnId = ?', [$id]);
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
        return redirect('/return');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $pr = ReturnProducts::findOrFail($id);
        $pr->delete();
        DB::delete('delete from product_returns where returnId = ?', [$id]);
        return redirect()->back();
    }

    public function getVendorProducts($id){
        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price,v.quantity,p.Qty from products p LEFT JOIN variants v ON p.id = v.product_id Where p.supplierId = ?',[$id]);
        return $prd;
    }

    public function createReport(Request $request){


        $returns = DB::select('select r.id, v.first_name, v.last_name,r.date, r.remarks,sum(p.costPrice * rp.qty) as total from return_products r, vendors v,product_returns rp,products p where r.vendorId = v.id and rp.productId = p.id Group By  r.id, v.first_name, v.last_name,r.date, r.remarks');
        // $tot = DB::select('select sum(p.costPrice * r.qty) as total from product_returns r, products p where r.productId = p.id ');
        // // return view ('Barcode.printBarcode',compact('product'));


        view()->share('returns',$returns);


        $pdf =  PDF::loadView('Product.returnReport',$returns);

        // // download PDF file with download method
        return $pdf->stream('returns.pdf');
        return view('Product.returnReport',compact('returns'));
    }
}
