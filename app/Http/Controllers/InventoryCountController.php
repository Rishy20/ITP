<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\InventoryCount;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory_counts = InventoryCount::all();

        foreach ($inventory_counts as $inventory_count)
            $inventory_count->outlet_name = Inventory::find($inventory_count->outlet)->name;

        return view('inventories.inventory-counts.index')->with('inventory_counts', $inventory_counts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.inventory-counts.create');
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
            'reference' => 'required|unique:inventory_counts|max:20',
            'outlet' => 'required',
            'counted_items' => 'required'
        ]);

        // Get inputs from request
        $outlet = $request->input('outlet');
        $counted_items = $request->input('counted_items');
        $actual_quantities = $request->input('actual_quantities');

        // Create inventory count
        $inventory_count = new InventoryCount([
            'reference' => $request->input('reference'),
            'outlet' => $outlet
        ]);

        if ($request->input('completed') == "on")
            $inventory_count->completed = true;

        // Save inventory count
        $inventory_count->save();

        $count_id = InventoryCount::all()->last()['id'];  // Get the latest stock transfer id

        for ($i = 0; $i < count($counted_items); $i++) {
            $product_id = $counted_items[$i];
            $actual_qty = $actual_quantities[$i];

            // Get expected quantity
            $expected_qty = DB::table('inventory_items')->where('inventory_id', $outlet)
                ->where('product_id', $product_id)->first()->qty;

            // Save counted items
            DB::table('counted_items')
                ->insert(['count_id' => $count_id, 'product_id' => $product_id, 'actual_qty' => $actual_qty,
                    'difference' => $actual_qty - $expected_qty, 'created_at' => now(), 'updated_at' => now()]);
        }

        // Get the saved counted items to pass into summary view
        $counted_items = DB::table('counted_items')->where('count_id', $count_id)->get();

        foreach ($counted_items as $counted_item) {
            $counted_item->product = Product::find($counted_item->product_id);
            $counted_item->expected_qty = DB::table('inventory_items')->where('inventory_id', $outlet)
                ->where('product_id', $counted_item->product_id)->first()->qty;
        }

        return view('inventories.inventory-counts.summary')->with('inventory_count', $inventory_count)->with('counted_items', $counted_items);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InventoryCount  $inventoryCount
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryCount $inventoryCount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventoryCount  $inventoryCount
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryCount $inventoryCount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventoryCount  $inventoryCount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryCount $inventoryCount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryCount  $inventoryCount
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryCount $inventoryCount)
    {
        // Delete inventory count and redirect to index
        $inventoryCount->delete();
        return redirect('inventory-counts');
    }

    public function replace(InventoryCount $inventory_count) {
        $counted_items = DB::table('counted_items')->where('count_id', $inventory_count->id)->get();

        foreach ($counted_items as $counted_item) {
            if ($counted_item->actual_qty == 0) {
                // If actual quantity is 0, delete the item from inventory
                DB::table('inventory_items')->where('inventory_id', $inventory_count->outlet)
                    ->where('product_id', $counted_item->product_id)->delete();
            }
            else {
                // Else replace the existing quantity with actual quantity
                DB::table('inventory_items')->where('inventory_id', $inventory_count->outlet)
                    ->where('product_id', $counted_item->product_id)->update(['qty' => $counted_item->actual_qty]);
            }
        }

        return redirect('inventory-counts');
    }

    public function complete(InventoryCount $inventory_count) {
        $inventory_count->completed = true;
        $inventory_count->save();

        return redirect('inventory-counts');
    }
}
