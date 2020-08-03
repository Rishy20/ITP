<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('inventories.create');
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
        // Get relevant inventory items and products from database
        $inventory_items = DB::table('inventory_items')->where('inventory_id', $inventory->id)->get();
        $products = Product::findMany($inventory_items->pluck('product_id'));

        // Assign each product to the inventory item with a matching product id
        foreach ($inventory_items as $inventory_item)
            foreach ($products as $product)
                if ($inventory_item->product_id == $product->id)
                    $inventory_item->product = $product;

        // Pass the relevant inventory and inventory items to inventory show view
        return view('inventories.show')->with('inventory_items', $inventory_items)->with('inventory', $inventory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit')->with('inventory', $inventory);
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
