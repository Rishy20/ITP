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

    public $source;
    public $destination;
    public $inventories;
    public $search;
    public $transfer_items;


    public function mount() {
        $this->transfer_items = array();

        // Get inventories from database
        $this->inventories = Inventory::all();
    }


    public function addTransferItem($product_id) {
        // Check if the item is already added
        foreach ($this->transfer_items as $transfer_item) {
            if ($transfer_item == $product_id)
                return;
        }

        // Add inventory id and product id as an array to the transfer_items 2D array
        array_push($this->transfer_items, $product_id);
    }


    private function getInventoryItems() {
        // Get inventory items and the corresponding product ids from database
        $inventory_items = DB::table('inventory_items')->where('inventory_id', $this->source)->get();
        $product_ids = $inventory_items->pluck('product_id');

        // Get products matching the product ids and the search query
        $products = Product::whereIn('id', $product_ids)->where('name', 'LIKE', '%'.$this->search.'%')->paginate(10);

        // Assign each product to the corresponding inventory item (check for matching product ids)
        foreach ($inventory_items as $inventory_item) {
            foreach ($products as $product) {
                if ($inventory_item->product_id == $product->id) {
                    $inventory_item->product = $product;  // Add product as a property to the inventory item

                    // Get destination inventory's quantity and add it to source inventory item as a property
                    $inventory_item->destination_qty = DB::table('inventory_items')
                        ->where('inventory_id', $this->destination)->where('product_id', $product->id)
                        ->pluck('qty')->first();

                    // If destination qty is null (if product does not exist in destination inventory), assign 0
                    if (!$inventory_item->destination_qty)
                        $inventory_item->destination_qty = 0;
                }
            }
        }

        // Remove inventory items that does not have an associated product (ones that don't match the search query)
        foreach ($inventory_items as $key => $inventory_item)
            if (!(isset($inventory_item->product)))
                $inventory_items->forget($key);

        // Remove inventory items that have already been added
        foreach ($inventory_items as $key=> $inventory_item) {
            foreach ($this->transfer_items as $transfer_item) {
                if ($transfer_item == $inventory_item->product->id)
                    $inventory_items->forget($key);
            }
        }

        return ['inventory_items' => $inventory_items, 'products' => $products];
    }


    private function getTransferItems() {
        // Create transfer item objects array
        $transfer_item_objects = array();

        // Assign to each transfer item, its respective product and destination qty
        if ($this->transfer_items > 0) {
            foreach ($this->transfer_items as $transfer_item) {
                $inventory_item = DB::table('inventory_items')->where('inventory_id', $this->source)
                    ->where('product_id', $transfer_item)->first();  // Get respective inventory item object
                $inventory_item->product = Product::find($transfer_item);  // Get respective product
                $inventory_item->destination_qty = DB::table('inventory_items')
                    ->where('inventory_id', $this->destination)->where('product_id', $transfer_item)
                    ->pluck('qty')->first();  // Get respective destination qty

                // If destination qty is null, assign 0
                if (!$inventory_item->destination_qty)
                    $inventory_item->destination_qty = 0;

                array_push($transfer_item_objects, $inventory_item);  // Add the assigned transfer item to array
            }
        }

        return $transfer_item_objects;
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

        // Inventory Items Search
        $inventory_items = $this->getInventoryItems()['inventory_items'];  // Get inventory items for search
        $products = $this->getInventoryItems()['products'];  // Get products for pagination

        // Transfer Items Table
        $transfer_item_objects = $this->getTransferItems();  // Get transfer items to use in Transfer Items table

        return view('livewire.stock-transfers.stock-transfer-form')->with('inventory_items', $inventory_items)
            ->with('products', $products)->with('transfer_item_objects', $transfer_item_objects);
    }
}
