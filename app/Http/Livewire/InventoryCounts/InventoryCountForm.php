<?php

namespace App\Http\Livewire\InventoryCounts;

use App\Inventory;
use App\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryCountForm extends Component
{
    use WithPagination;

    public $outlet;
    public $inventories;
    public $search;
    public $counted_items;


    public function mount() {
        $this->counted_items = array();

        // Get inventories from database
        $this->inventories = Inventory::all();
    }


    public function addCountedItem($product_id) {
        // Check if the item is already added
        foreach ($this->counted_items as $counted_item) {
            if ($counted_item == $product_id)
                return;
        }

        // Add inventory id and product id as an array to the counted_items 2D array
        array_push($this->counted_items, $product_id);
    }


    private function getInventoryItems() {
        // Get inventory items and the corresponding product ids from database
        $inventory_items = DB::table('inventory_items')->where('inventory_id', $this->outlet)->get();
        $product_ids = $inventory_items->pluck('product_id');

        // Get products matching the product ids and the search query
        $products = Product::whereIn('id', $product_ids)->where('name', 'LIKE', '%'.$this->search.'%')->paginate(10);

        // Assign each product to the corresponding inventory item (check for matching product ids)
        foreach ($inventory_items as $inventory_item) {
            foreach ($products as $product) {
                if ($inventory_item->product_id == $product->id) {
                    $inventory_item->product = $product;  // Add product as a property to the inventory item
                }
            }
        }

        // Remove inventory items that does not have an associated product (ones that don't match the search query)
        foreach ($inventory_items as $key => $inventory_item)
            if (!(isset($inventory_item->product)))
                $inventory_items->forget($key);

        // Remove inventory items that have already been counted
        foreach ($inventory_items as $key=> $inventory_item) {
            foreach ($this->counted_items as $counted_item) {
                if ($counted_item == $inventory_item->product->id)
                    $inventory_items->forget($key);
            }
        }

        return ['inventory_items' => $inventory_items, 'products' => $products];
    }


    private function getCountedItems() {
        // Create transfer item objects array
        $counted_item_objects = array();

        // Assign to each transfer item, its respective product
        if ($this->counted_items > 0) {
            foreach ($this->counted_items as $counted_item) {
                $inventory_item = DB::table('inventory_items')->where('inventory_id', $this->outlet)
                    ->where('product_id', $counted_item)->first();  // Get respective inventory item object
                $inventory_item->product = Product::find($counted_item);  // Get respective product

                array_push($counted_item_objects, $inventory_item);  // Add the assigned transfer item to array
            }
        }

        return $counted_item_objects;
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

        // Inventory Items Search
        $inventory_items = $this->getInventoryItems()['inventory_items'];  // Get inventory items for search
        $products = $this->getInventoryItems()['products'];  // Get products for pagination

        // Counted Items Table
        $counted_item_objects = $this->getCountedItems();  // Get counted items to use in Counted Items table

        return view('livewire.inventory-counts.inventory-count-form')->with('inventory_items', $inventory_items)
            ->with('products', $products)->with('counted_item_objects', $counted_item_objects);
    }
}
