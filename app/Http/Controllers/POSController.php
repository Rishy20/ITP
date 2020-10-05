<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Product;
use App\Sale;
use App\SalesProduct;
use App\Variant;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,p.sellingPrice,p.discount,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');
        // $var = DB::table('variants')
        // ->where('product_id','=',1)
        // ->where('size','=',null)
        // ->where('color','=',null)
        // ->get();
        // $var = json_decode($var,true);
        // if(!empty($var)){
        //     dd("Hekko");
        // }
        // dd($var);
    //     $size = "";
    //     $color = "";
    //     $var = DB::table('variants')
    //         ->where('product_id','=','1')
    //         ->where('size','=',$size)
    //         ->where('color','=',$color)
    //         ->get();
    //         $var = json_decode($var,true);
    // if(!empty($var)){
    //     $sp = new SalesProduct();
    //     $sp->saleId = 56;
    //     $sp->pid = 1;
    //     $sp->vid = $var[0]['id'];
    //     $sp->qty =10;
    //     $sp->price = 1000;
    //     $sp->discount = 1500;
    //     $sp->save();
    // }else{
    //     $sp = new SalesProduct();
    //     $sp->saleId = 55;
    //     $sp->pid = 1;
    //     $sp->qty = 20;
    //     $sp->price = 2000;
    //     $sp->discount = 100;
    //     $sp->save();
    //     dd("Hello");
    // }
       $prd = Product::all();
       $var = Variant::all();
       $cust = Customer::all();
       $emp = Employee::all();
        return view('POS.pos',compact('prd','var','cust','emp'));

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
       
        $sale = new Sale();
        $sale->customerId = $request->customer;
        $sale->staffId = $request->staff;
        $sale->amount = $request->total;
        $sale->discount = $request->discount;
        $sale->taxes = 0;
        $sale->save();
        $last = DB::table('sales')->latest()->first();
        $saleId = $last->id;

        $product = json_decode($request->item,true);

        foreach($product as $pr){

                $size = $pr[3];
                $color = $pr[4];
                $var = DB::table('variants')
                    ->where('product_id','=',$pr[0])
                    ->where('size','=',$size)
                    ->where('color','=',$color)
                    ->get();
                    $var = json_decode($var,true);
            if(!empty($var)){
                $sp = new SalesProduct();
                $sp->saleId = $saleId;
                $sp->pid = $pr[0];
                $sp->vid = $var[0]['id'];
                $sp->qty = $pr[5];
                $sp->price = $pr[1];
                $sp->discount = $pr[2];
                $sp->save();
            }else{
                $sp = new SalesProduct();
                $sp->saleId = $saleId;
                $sp->pid = $pr[0];
                $sp->qty = $pr[5];
                $sp->price = $pr[1];
                $sp->discount = $pr[2];
                $sp->save();
            }


        }

        // Set params
        $cid = $request->customer;
        $sid = $request->staff;
        $store_name = 'LeatherLine';
        $store_address = 'No.69,Bodhiraja Mawatha,';
        $store_city = 'Kurunegala';
        $store_phone = '037-2224660';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 0;
        $discount = $request->discount;
        $transaction_id = $saleId;
        $items = array();
        // Set items

        foreach($product as $pr){
            $p = DB::table('products')
            ->where('id','=',$pr[0])
            ->get();
            $p = json_decode($p,true);
            if(strlen($pr[3]) == 0 && strlen($pr[4]) == 0){
                array_push($items,[
                    'name' => $p[0]['name'],
                    'pcode' => $p[0]['pcode'],
                    'qty' => $pr[5],
                    'price' => ($pr[1]/$pr[5]) + $pr[2],
                ]);
            }else if(strlen($pr[3]) > 0 && strlen($pr[4]) > 0){
                array_push($items,[
                    'name' => $p[0]['name']."  ".$pr[3]."/".$pr[4],
                    'pcode' => $p[0]['pcode'],
                    'qty' => $pr[5],
                    'price' => ($pr[1]/$pr[5]) + $pr[2],
                ]);
            }else if(strlen($pr[3]) > 0 && strlen($pr[4]) == 0){
                array_push($items,[
                    'name' => $p[0]['name']."  ".$pr[3],
                    'pcode' => $p[0]['pcode'],
                    'qty' => $pr[5],
                    'price' => ($pr[1]/$pr[5]) + $pr[2],
                ]);
            }else if(strlen($pr[3]) == 0 && strlen($pr[4]) > 0){
                array_push($items,[
                    'name' => $p[0]['name']."  ".$pr[4],
                    'pcode' => $p[0]['pcode'],
                    'qty' => $pr[5],
                    'price' => ($pr[1]/$pr[5]) + $pr[2],
                ]);
            }
        }


        // $items = [
        //     [
        //         'name' => 'French Fries (tera)',
        //         'pcode' => 'IGN1500',
        //         'qty' => 2,
        //         'price' => 650,
        //     ],
        // ];

        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($cid,$sid, $store_name, $store_address,$store_city, $store_phone, $store_email, $store_website);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['pcode'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Set Discount
        $printer->setDiscount($discount);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set qr code
        // $printer->setQRcode([
        //     'tid' => $transaction_id,
        // ]);

        // Print receipt
        $printer->printReceipt();

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
}
