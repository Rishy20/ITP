<?php

namespace App\Http\Livewire\InventoryCounts;

use App\Inventory;
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
        $inventory_items = DB::table('inventory_items')->join('products', 'inventory_items.product_id',
            '=', 'products.id')->where('inventory_id', $this->outlet)->get();

        $this->dispatchBrowserEvent('contentChanged');  // Fire browser event to refresh data

        return view('livewire.inventory-counts.inventory-count-form')->with('inventory_items', $inventory_items);
    }
}
