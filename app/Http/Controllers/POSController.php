<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Exchange;
use App\Product;
use App\Sale;
use App\SalesPayment;
use App\SalesProduct;
use App\SalesVoucher;
use App\Variant;
use App\Voucher;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class POSController extends Controller
{




    public function __construct(){
        $this->middleware('auth:pos');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $prd = Product::all();
       $var = Variant::all();
       $cust = Customer::all();
       $emp = Employee::all();
       $last = DB::table('services')->latest()->first();
       $date = date("Y-m-d");

        $promo = DB::table('promotions')->where('startdate','<=',$date)->where('enddate','>',$date)->get();

       if($last == null){
           $serviceId = 1;
       }else{
            $serviceId = ($last->id) + 1;
       }

        return view('POS.pos',compact('prd','var','cust','emp','serviceId','promo'));

    }

    public function returnProducts(){
        $prd = Product::all();
        return $prd;
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
        if($request->customer){
            $sale->customerId = $request->customer;
        }
        $sale->staffId = $request->staff;
        $sale->amount = $request->total;
        $sale->discount = $request->discount;
        $sale->taxes = 0;
        $sale->save();
        $last = DB::table('sales')->latest()->first();
        $saleId = $last->id;

        $product = json_decode($request->item,true);

        $voucher = json_decode($request->voucher,true);

          // Set params
          $cid = $request->customer;
          $sid = $request->staff;
        //   $store_name = 'LeatherLine';
        //   $store_address = 'No.69,Bodhiraja Mawatha,';
        //   $store_city = 'Kurunegala';
        //   $store_phone = '037-2224660';
        // //   $store_email = 'yourmart@email.com';
        // //   $store_website = 'yourmart.com';
        //   $tax_percentage = 0;
        //   $discount = $request->discount;
        //   $type = $request->type;
        //   $amount = $request->amount;
        //   $balance = $request->balance;
        //   $transaction_id = $saleId;
        //   $items = array();
        //   // Set items

        //   foreach($product as $pr){
        //       $p = DB::table('products')
        //       ->where('id','=',$pr[0])
        //       ->get();
        //       $p = json_decode($p,true);
        //       if(strlen($pr[3]) == 0 && strlen($pr[4]) == 0){
        //           array_push($items,[
        //               'name' => $p[0]['name'],
        //               'pcode' => $p[0]['pcode'],
        //               'qty' => $pr[5],
        //               'price' => ($pr[1]/$pr[5]) + $pr[2],
        //           ]);
        //       }else if(strlen($pr[3]) > 0 && strlen($pr[4]) > 0){
        //           array_push($items,[
        //               'name' => $p[0]['name']."  ".$pr[3]."/".$pr[4],
        //               'pcode' => $p[0]['pcode'],
        //               'qty' => $pr[5],
        //               'price' => ($pr[1]/$pr[5]) + $pr[2],
        //           ]);
        //       }else if(strlen($pr[3]) > 0 && strlen($pr[4]) == 0){
        //           array_push($items,[
        //               'name' => $p[0]['name']."  ".$pr[3],
        //               'pcode' => $p[0]['pcode'],
        //               'qty' => $pr[5],
        //               'price' => ($pr[1]/$pr[5]) + $pr[2],
        //           ]);
        //       }else if(strlen($pr[3]) == 0 && strlen($pr[4]) > 0){
        //           array_push($items,[
        //               'name' => $p[0]['name']."  ".$pr[4],
        //               'pcode' => $p[0]['pcode'],
        //               'qty' => $pr[5],
        //               'price' => ($pr[1]/$pr[5]) + $pr[2],
        //           ]);
        //       }
        //   }

        //   foreach($voucher as $v){
        //       array_push($items,[
        //           'name' => 'Voucher',
        //           'pcode' => $v[0],
        //           'qty' => 1,
        //           'price' => $v[1],
        //       ]);
        //   }


        //   // Init printer
        //   $printer = new ReceiptPrinter;
        //   $printer->init(
        //       config('receiptprinter.connector_type'),
        //       config('receiptprinter.connector_descriptor')
        //   );

        //   // Set store info
        //   $printer->setStore($cid,$sid, $store_name, $store_address,$store_city, $store_phone, $store_email, $store_website);

        //   // Add items
        //   foreach ($items as $item) {
        //       $printer->addItem(
        //           $item['name'],
        //           $item['pcode'],
        //           $item['qty'],
        //           $item['price']
        //       );
        //   }
        //   // Set tax
        //   $printer->setTax($tax_percentage);

        //   // Set Discount
        //   $printer->setDiscount($discount);

        //   //Set Type
        //   $printer->setType($type);

        //   //Set Amount
        //   $printer->setAmount($amount);

        //   //Set Balance
        //   $printer->setBalance($balance);

        //   if($type === 'split'){
        //     //Set Method1
        //     $printer->setMethod1($request->method1);
        //     //Set Method2
        //     $printer->setMethod2($request->method2);
        //     //Set Method1 Amount
        //     $printer->setm1Amount($request->meth1Amount);
        //     //Set Method2 Amount
        //     $printer->setm2Amount($request->meth2Amount);
        //   }
        //   // Calculate total
        //   $printer->calculateSubTotal();
        //   $printer->calculateGrandTotal();

        //   // Set transaction ID
        //   $printer->setTransactionID($transaction_id);

        //   // Set qr code
        //   // $printer->setQRcode([
        //   //     'tid' => $transaction_id,
        //   // ]);

        //   // Print receipt
        //   $printer->printReceipt();



        //Save and Update database

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

                if($pr[1] > 0){
                    $sp = new SalesProduct();
                    $sp->saleId = $saleId;
                    $sp->pid = $pr[0];
                    $sp->vid = $var[0]['id'];
                    $sp->qty = $pr[5];
                    $sp->price = $pr[1];
                    $sp->discount = $pr[2];
                    $sp->save();

                    $p = Product::find($pr[0]);
                    $qty = $p->Qty;
                    Product::where('id',$pr[0])->update(['Qty'=>$qty-$pr[5]]);

                    $v = Variant::find($var[0]['id']);
                    $qty = $v->quantity;
                    Variant::where('id',$var[0]['id'])->update(['quantity'=>$qty-$pr[5]]);
                }else{
                    $ex = new Exchange();
                    $ex->salesID = $saleId;
                    $ex->productID = $pr[0];
                    $ex->variantID = $var[0]['id'];
                    if($request->customer){
                        $ex->customerID = $request->customer;
                    }
                    $ex->salesmanID = $request->staff;
                    $ex->amount = abs($pr[1]);
                    $ex->save();

                    $p = Product::find($pr[0]);
                    $qty = $p->Qty;
                    Product::where('id',$pr[0])->update(['Qty'=>$qty+$pr[5]]);

                    $v = Variant::find($var[0]['id']);
                    $qty = $v->quantity;
                    Variant::where('id',$var[0]['id'])->update(['quantity'=>$qty+$pr[5]]);
                }

            }else{
                if($pr[1] > 0){
                    $sp = new SalesProduct();
                    $sp->saleId = $saleId;
                    $sp->pid = $pr[0];
                    $sp->qty = $pr[5];
                    $sp->price = $pr[1];
                    $sp->discount = $pr[2];
                    $sp->save();
                    $p = Product::find($pr[0]);
                    $qty = $p->Qty;
                    Product::where('id',$pr[0])->update(['Qty'=>$qty-$pr[5]]);
                }else{
                    $ex = new Exchange();
                    $ex->salesID = $saleId;
                    $ex->productID = $pr[0];
                    if($request->customer){
                        $ex->customerID = $request->customer;
                    }
                    $ex->salesmanID = $request->staff;
                    $ex->amount = abs($pr[1]);
                    $ex->save();

                    $p = Product::find($pr[0]);
                    $qty = $p->Qty;
                    Product::where('id',$pr[0])->update(['Qty'=>$qty+$pr[5]]);
                }
            }


        }


        if($request->type !== 'split'){

            if($request->type === 'Cash'){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = $request->type;
                $sp->amount = $request->amount;
                $sp->save();
            }else if($request->method1 === "Card"){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = $request->type;
                $sp->amount = $request->amount;
                $sp->last_four_digits = $request->digits1;
                $sp->save();
            }else if($request->method1 === "Voucher"){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = "Voucher";
                $sp->amount = $request->amount;
                $sp->voucherId = $request->voucher1;
                $sp->save();

                $v = Voucher::find($request->voucher1);
                $v->redeem_status = 1;
                $v->update();
            }

        }else{

            if($request->method1 === 'Cash'){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = $request->method1;
                $sp->amount = $request->meth1Amount;
                $sp->save();
            }else if($request->method1 === "Visa" || $request->method1 === "Amex" || $request->method1 === "Master"){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = $request->method1;
                $sp->amount = $request->meth1Amount;
                $sp->last_four_digits = $request->digits1;
                $sp->save();
            }else {
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = "Voucher";
                $sp->amount = $request->meth1Amount;
                $sp->voucherId= $request->voucher1;
                $sp->save();

                $v = Voucher::find($request->voucher1);
                $v->redeem_status = 1;
                $v->update();
            }

            if($request->method2 === 'Cash'){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = $request->method2;
                $sp->amount = $request->meth2Amount;
                $sp->save();
            }else if($request->method2 === "Visa" || $request->method2 === "Amex" || $request->method2 === "Master"){
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = $request->method2;
                $sp->amount = $request->meth2Amount;
                $sp->last_four_digits = $request->digits2;
                $sp->save();
            }else{
                $sp = new SalesPayment();
                $sp->salesId = $saleId;
                $sp->payment_type = "Voucher";
                $sp->amount = $request->meth2Amount;
                $sp->voucherId= $request->voucher2;
                $sp->save();
            }

        }


        foreach($voucher as $v){
            $vou = new Voucher();
            $vou->id = $v[0];
            $vou->amount = $v[1];
            $vou->exp = $v[2];
            $vou->save();

            $sv = new SalesVoucher();
            $sv->saleId = $saleId;
            $sv->vid = $v[0];
            $sv->discount = $v[3];
            $sv->save();
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

    public function getCustomer($mobile){


        // $cus = DB::table('customers')
        // ->where('phone','=',$mobile)
        // ->get();
        $cus = DB::select('select c.id,firstname,lastname,gender,phone,city,lc.points,loyaltyId,loyaltyName from customers c, loyalty_customers lc,loyalty l where c.id = lc.customerId and l.id = lc.loyaltyId and c.phone = ?', [$mobile]);

        return $cus;
    }
}
