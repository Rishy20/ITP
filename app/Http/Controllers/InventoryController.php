<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index')->with('inventories', $inventories);
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
        // Validate inputs
        $request->validate([
            'name' => 'required'
        ]);

        // Create inventory
        $inventory = new Inventory([
            'name' => $request->input('name'),
            'address' => $request->input('address')
        ]);

        // Save inventory and redirect to index
        $inventory->save();
        return redirect('inventories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required'
        ]);

        // Assign new values to inventory
        $inventory->name = $request->input('name');
        $inventory->address = $request->input('address');

        // Save inventory and redirect to index
        $inventory->save();
        return redirect('inventories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Inventory $inventory)
    {
        // Delete inventory and redirect to index
        $inventory->delete();
        return redirect('inventories');
    }
}
