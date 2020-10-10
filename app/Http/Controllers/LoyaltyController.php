<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loyalty;
use App\Customer;
use App\LoyaltyCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class LoyaltyController extends Controller
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
        $loyalty = Loyalty::all()->toArray();
        return view('Loyalty.allLoyalty', compact('loyalty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::all();
        return view('Loyalty.addLoyalty',compact('customer'));

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
            'loyaltyName' => 'required|max:20',
            'minimumPointRequired' => 'required|min:0',
            'tierPoints' => 'required|max:100000',
            'points' => 'required'
        ]);

        // Loyalty::create($request->all());

        $c = $_COOKIE['customers'];
        $customer = json_decode($c,true);

        $last = DB::table('loyalty')->latest()->first();
        $loyaltyid = $last->id;
        $pointsonSignUp = $last->points;
        setcookie("customers","",time()-3600);
        foreach($customer as $cu){

            $cus = new LoyaltyCustomer();
            $cus->loyaltyId = $loyaltyid;
            $cus->customerId = $cu[0];
            $cus->points = $pointsonSignUp;
            $cus->save();
        }


        Session::put('message', 'Success!');
        return redirect('/loyalty');
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
        $loyalty = Loyalty::find($id);
        return view('Loyalty.editLoyalty', compact('loyalty', 'id'));
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
        //     'loyaltyName' => 'required',
        //     'minimumPointRequired' => 'required',
        //     'tierPoints' => 'required',
        //     'points' => 'required'
        // ]);

        $loyalty = Loyalty::findOrFail($id);

        $input = $request->all();
        $loyalty->update($input);
        Session::put('message', 'Success!');
        return redirect('/loyalty');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $loyalty = Loyalty::findOrFail($id);
        $loyalty->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }

    public function createReport(Request $request){

        $loyalty =  Loyalty::all()->toArray();

        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('loyalty',$loyalty);


        $pdf =  PDF::loadView('Loyalty.loyaltyReport',$loyalty);

        // // download PDF file with download method
        return $pdf->stream('loyalty.pdf');
        return view('Loyalty.loyaltyReport',compact('loyalty'));
    }

}
