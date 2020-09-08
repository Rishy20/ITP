<?php

namespace App\Http\Controllers;

use App\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Service.allService');
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
            'service_id'=>'required|max:20',
            'customer_id'=>'required|max:20',
            'date'=>'required|max:10',
            'return_date'=>'required|max:10',
            'service_description'=>'required|max:100',
            'cost'=>'required|max:10',

            ]);
            service::create($request->all());
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
    public function edit(service $service)
    {
        $service = Service::find($service);
        return view('service.editService',compact('service'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, service $service)
    {
        $vendor = Service::findOrFail($service);
        $vendor->service_id = $request->input('service_id');
        $vendor->customer_id = $request->input('customer_id');
        $vendor->date = $request->input('return_date');
        $vendor->service_description = $request->input('service_description');
        $vendor->cost = $request->input('cost');
        $vendor->save();
        Session::put('message', 'Success!');
        return redirect('/service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(service $service)
    {
        $service= Service::findOrFail( $service);
        $service->delete();
        Session::put('message', 'Success!');
        return redirect()->back();
    }
}
