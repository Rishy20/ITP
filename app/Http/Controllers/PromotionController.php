<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prms = Promotion::all();
        return view('cusfolder.promotionpage' ,compact('prms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cusfolder.promotionpage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'promotionname' => 'required',
            'promotiontype' => 'required',
            'discount' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            

        ]);

        $prms = new Promotion;

        $prms->promotionname = $request->input('promotionname');
        $prms->promotiontype = $request->input('promotiontype');
        $prms->discount = $request->input('discount');
        $prms->startdate = $request->input('startdate');
        $prms->enddate = $request->input('enddate');

        $prms->save();

        return redirect('cusfolder')->with('success','Data Inserted');


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
        return view('cusfolder.promeditpage',compact('prms','id'));
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

        return redirect('cusfolder')->with('success','Data updated');
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

        return redirect('cusfolder')->with('success','Data Deleted');
    }
}
