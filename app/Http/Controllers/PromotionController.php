<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPromotion;
use Illuminate\Http\Request;
use App\Promotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PromotionController extends Controller
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
        $prms = Promotion::all();
        return view('promotion.promotionAllForm',compact('prms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prd = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');
        return view('promotion.addPromotion',compact('prd'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pr = new Promotion();
        $pr->promotionname = $request->promotionname;
        $pr->description = $request->description;
        $pr->discount = $request->discount;
        $pr->discounttype = $request->discounttype;
        $pr->promotiontype = $request->promotiontype;
        if($request->discounttype == "cash"){
            $pr->discount = $request->amount;
        }else{
            $pr->discount = $request->percentage;
        }
        $pr->startdate = $request->startdate;
        $pr->enddate = $request->enddate;
        $pr->save();

        if($request->promotiontype=="specific"){

            $pr = $_COOKIE['promotions'];
            $temp = json_decode($pr,true);
            $last = DB::table('promotions')->latest()->first();
            $promotionid = $last->id;
            setcookie("promotions","",time()-3600);
            foreach($temp as $t){

                $p = new ProductPromotion();
                $p->promotionid = $promotionid;
                $p->productid = $t[0];
                $p->variantid = $t[1];
                $p->save();
            }

        }

        Session::put('message', 'Success!');
        return redirect('/promotion');

        // $this->validate($request,[
        //     'promotionname' => 'required',
        //     'promotiontype' => 'required',
        //     'discount' => 'required',
        //     'startdate' => 'required',
        //     'enddate' => 'required',


        // ]);
        // Promotion::create($request->all());
        // Session::put('message', 'Success!');
        // return redirect('/promotion');

        // $prms = new Promotion;

        // $prms->promotionname = $request->input('promotionname');
        // $prms->promotiontype = $request->input('promotiontype');
        // $prms->discount = $request->input('discount');
        // $prms->startdate = $request->input('startdate');
        // $prms->enddate = $request->input('enddate');

        // $prms->save();
        // Session::put('message', 'Success!');
        return redirect('/promotion');


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
        $prms = Promotion::find($id);
        return view('promotion.editPromotion',compact('prms','id'));
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
        $this->validate($request,[

            'promotionname' => 'required',
            'promotiontype' => 'required',
            'discount' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',


        ]);

        $prms = Promotion::find($id);

        $prms->promotionname = $request->input('promotionname');
        $prms->promotiontype = $request->input('promotiontype');
        $prms->discount = $request->input('discount');
        $prms->startdate = $request->input('startdate');
        $prms->enddate = $request->input('enddate');

        $prms->save();
        Session::put('message', 'Success!');
        return redirect('/promotion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prms = Promotion::find($id);
        $prms->delete();
        Session::put('message', 'Success!');

        return redirect('/promotion');
    }
}
