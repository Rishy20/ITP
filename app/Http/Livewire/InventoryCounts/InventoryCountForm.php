<?php

namespace App\Http\Livewire\InventoryCounts;

use App\Inventory;
use App\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InventoryCountForm extends Component
{
    public $outlet;
    public $inventories;


    public function mount() {
        // Get inventories from database
        $this->inventories = Inventory::all();
    }


    private function getInventoryItems() {
        // Get inventory items and the corresponding product ids from database
        $inventory_items = DB::table('inventory_items')->where('inventory_id', $this->outlet)->get();
        $product_ids = $inventory_items->pluck('product_id');

        // Get products matching the product ids and the search query
        $products = Product::whereIn('id', $product_ids)->get();

        // Assign each product to the corresponding inventory item (check for matching product ids)
        foreach ($inventory_items as $inventory_item) {
            foreach ($products as $product) {
                if ($inventory_item->product_id == $product->id) {
                    $inventory_item->product = $product;  // Add product as a property to the inventory item
                }
            }
        }

        return $inventory_items;
    }


    public function render()
    {
        // Check if there are enough inventories
        if ($this->inventories->count() >= 1) {
            // Set the first inventory as outlet if null
            if ($this->outlet === null) {
                $this->outlet = $this->inventories[0]->id;
            }
        }
        else
            return view('livewire.inventory-counts.not-enough-inventories');

        // Get inventory items
        $inventory_items = $this->getInventoryItems();

        $this->dispatchBrowserEvent('contentChanged');  // Fire browser event to refresh data

        return view('livewire.inventory-counts.inventory-count-form')->with('inventory_items', $inventory_items);
    }
}
