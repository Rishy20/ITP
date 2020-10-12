<?php

namespace App\Http\Controllers;

use App\Customer;
use App\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class ServiceController extends Controller
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
        // $service = Service::all();
        $customer = Customer::all();
        $service = DB::select('select s.id,s.customer_id,s.return_date,s.service_description,s.cost,c.firstname,c.lastname,u.username,s.created_at from services s left join customers c on s.customer_id = c.id left join users u on u.id = s.user_id');
        // dd($service);
        $last = DB::table('services')->latest()->first();

        if($last == null){
            $serviceId = 1;
        }else{
             $serviceId = ($last->id) + 1;
        }
        return view('Service.allService',compact('service','customer','serviceId'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.addService');
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
            //'service_id'=>'required|max:20',
            //'customer_id'=>'required|max:20',
            //'date'=>'required|max:10',
            //'return_date'=>'required|max:10',
            //'service_description'=>'required|max:100',
            //'cost'=>'required|max:10',

            ]);

            Service::create($request->all());
            Session::put('message', 'Success!');
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(service $service)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $s = Service::find($id);
        return view('service.editService',compact('s','id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $service=Service::findOrFail($id);
        // $input=$request->all();
        // $service->update($input);
        // Session::put('message', 'Success!');
        // return redirect('/service');
    }

    public function updateService(Request $request){

        $service=Service::findOrFail($request->id);
        $input=$request->all();
        $service->update($input);
        Session::put('message', 'Success!');
        return redirect('/service');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }

    public function getLastIndex(){

        $last = DB::table('services')->latest()->first();
        $serviceId = $last->id;
        return $serviceId;
    }
    public function createReport(Request $request){

        // $service =  DB::select('select service.id, username,display_name,password,pin,status,roleId,Role_name,u.created_at from users u,
        // service_roles ur where s.roleId = service.id');
        $service = DB::select('select s.id,s.return_date,s.service_description,s.cost,c.firstname,c.lastname,u.username,s.created_at from services s left join customers c on s.customer_id = c.id left join users u on u.id = s.user_id');


        // // return view ('Barcode.printBarcode',compact('product'));

        view()->share('service',$service);


        $pdf =  PDF::loadView('Service.serviceReport',$service);

        // // download PDF file with download method
        return $pdf->stream('service.pdf');
        return view('Service.serviceReport',compact('service'));
    }
}


