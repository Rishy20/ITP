<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\StockTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_transfers = StockTransfer::all();

        foreach ($stock_transfers as $stock_transfer) {
            $stock_transfer->source_name = Inventory::find($stock_transfer->source)->name;
            $stock_transfer->destination_name = Inventory::find($stock_transfer->destination)->name;

            if ($stock_transfer->completed)
                $stock_transfer->status = "Completed";
            else
                $stock_transfer->status = "Pending";
        }

        return view('inventories.stock-transfers.index')->with('stock_transfers', $stock_transfers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.stock-transfers.create');
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
            'reference' => 'required|unique:stock_transfers|max:20',
            'source' => 'required',
            'destination' => 'required|different:source',
            'transfer_items' => 'required'
        ]);

        // Get inputs from request
        $source = $request->input('source');
        $destination = $request->input('destination');
        $transfer_items = $request->input('transfer_items');
        $quantities = $request->input('quantities');

        // Create stock transfer
        $stock_transfer = new StockTransfer([
            'reference' => $request->input('reference'),
            'source' => $source,
            'destination' => $destination,
        ]);

        // Save stock transfer
        $stock_transfer->save();

        $transfer_id = StockTransfer::all()->last()['id'];  // Get the latest stock transfer id

        for ($i = 0; $i < count($transfer_items); $i++) {
            $product_id = $transfer_items[$i];
            $qty = $quantities[$i];

            // Save transfer items
            DB::table('stock_transfer_items')
                ->insert(['transfer_id' => $transfer_id, 'product_id' => $product_id, 'qty' => $qty,
                    'created_at' => now(), 'updated_at' => now()]);

            // Decrement the selected quantity from source inventory
            DB::table('inventory_items')->where('inventory_id', $source)->where('product_id', $product_id)
                ->decrement('qty', $qty);

            // Check if the selected product exist in destination inventory
            if (DB::table('inventory_items')->where('inventory_id', $destination)->where('product_id', $product_id)->first()) {
                // If the product exists, increment its respective quantity by the given value
                DB::table('inventory_items')->where('inventory_id', $destination)->where('product_id', $product_id)
                    ->increment('qty', $qty);
            }
            else {  // If the product does not exist in destination inventory, insert a new row for it
                DB::table('inventory_items')->insert(['inventory_id' => $destination, 'product_id' => $product_id, 'qty' => $qty,
                    'created_at' => now(), 'updated_at' => now()]);
            }

            // If the quantity in source inventory is 0 after the transaction, delete the item from that inventory
            if (DB::table('inventory_items')->where('inventory_id', $source)->where('product_id', $product_id)->first()->qty == 0)
                DB::table('inventory_items')->where('inventory_id', $source)->where('product_id', $product_id)->delete();
        }

        return redirect('stock-transfers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(StockTransfer $stockTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(StockTransfer $stockTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockTransfer $stockTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockTransfer $stockTransfer)
    {
        // Delete stock transfer and redirect to index
        $stockTransfer->delete();
        return redirect('stock-transfers');
    }
}
