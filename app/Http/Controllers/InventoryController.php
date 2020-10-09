<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class InventoryController extends Controller
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
        // Get all inventories from the database and pass them to inventory index view
        $inventories = Inventory::all();

        // Assign total quantity of each inventory by getting the total of inventory items quantities
        foreach ($inventories as $inventory) {
            $items = DB::table('inventory_items')->where('inventory_id', $inventory->id)->get();
            $total_qty = 0;

            foreach ($items as $item) {
                $total_qty += $item->qty;
            }

            $inventory->qty = $total_qty;
        }

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
            'name' => 'required|max:50',
            'address' => 'max:200'
        ]);
        Session::put('message', 'Success!');

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

        // Assign each product to the corresponding inventory item (check for matching product ids)
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
        // Return inventory edit view with the corresponding inventory as a parameter
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
        Session::put('message', 'Success!');
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
        Session::put('message', 'Success!');
        return redirect('inventories');
    }

    public function createReport(Request $request){
        $inventories = Inventory::all();
        view()->share('inventories',$inventories);
        $pdf =  PDF::loadView('inventories.report', $inventories);

        // Download the PDF file with download method
        return $pdf->stream('inventories.pdf');
    }
}
