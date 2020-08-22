<?php

namespace App\Http\Livewire\StockTransfers;

use App\Inventory;
use App\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StockTransferForm extends Component
{
    use WithPagination;

    public $search;
    public $source;
    public $destination;
    public $inventories;

    public function mount() {
        // Get inventories from database
        $this->inventories = Inventory::all();
    }

    public function render()
    {
        // Check if there are enough inventories for a stock transfer
        if ($this->inventories->count() >= 2) {
            // Set the first two inventories as source and destination, if source and destination are null
            if ($this->source === null && $this->destination === null) {
                $this->source = $this->inventories[0]->id;
                $this->destination = $this->inventories[1]->id;
            }
        }
        else
            return view('livewire.stock-transfers.not-enough-inventories');

        // Get inventory items and the corresponding products from database
        $inventory_items = DB::table('inventory_items')->where('inventory_id', $this->source)->get();
        $product_ids = $inventory_items->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->where('name', 'LIKE', '%'.$this->search.'%')->paginate(5);

        // Assign each product to the corresponding inventory item (check for matching product ids)
        foreach ($inventory_items as $inventory_item) {
            foreach ($products as $product) {
                if ($inventory_item->product_id == $product->id) {
                    $inventory_item->product = $product;  // Add product as a property to the inventory item

                    // Get destination inventory's quantity and add it to source inventory item as a property
                    $inventory_item->destination_qty = DB::table('inventory_items')
                        ->where('inventory_id', $this->destination)->where('product_id', $product->id)
                        ->pluck('qty')->first();
                }
            }
        }

        // Remove inventory items that does not have an associated product (ones that don't match the search query)
        foreach ($inventory_items as $key => $inventory_item)
            if (!(isset($inventory_item->product)))
                $inventory_items->forget($key);

        return view('livewire.stock-transfers.stock-transfer-form')->with('inventory_items', $inventory_items)
            ->with('products', $products);
    }
}
