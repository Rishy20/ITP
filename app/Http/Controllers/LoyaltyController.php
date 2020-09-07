<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loyalty;
class LoyaltyController extends Controller
{
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
        return view('Loyalty.addLoyalty');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'loyaltyName' => 'required|max:20',
        //     'minimumPointRequired' => 'required|min:100',
        //     'tierPoints' => 'required|max:100000'
        // ]);
        // $loyalty = new Loyalty();
        // $loyalty-> loyaltyName = $request->input('loyaltyName');
        // $loyalty-> minimumPointRequired = $request->input('minimumPointRequired');
        // $loyalty-> tierPoints = $request->input('tierPoints');
        
        // $loyalty->save();
        Loyalty::create($request->all());
        return redirect()->back();
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
        return redirect()->back();
    }
}
