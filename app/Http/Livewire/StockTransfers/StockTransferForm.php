<?php

namespace App\Http\Livewire\StockTransfers;

use App\Inventory;
use App\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StockTransferForm extends Component
{
    public $source;
    public $destination;
    public $inventories;


    public function mount() {
        // Get inventories from database
        $this->inventories = Inventory::all();
    }


    public function swapInventories() {
        $temp = $this->source;
        $this->source = $this->destination;
        $this->destination = $temp;
    }


    private function getInventoryItems() {
        // Get inventory items
        $inventory_items = DB::table('inventory_items')->join('products', 'inventory_items.product_id',
            '=', 'products.id')->where('inventory_id', $this->source)->get();

        // Assign each product to the corresponding inventory item (check for matching product ids)
        foreach ($inventory_items as $inventory_item) {
            // Get destination inventory's quantity and add it to source inventory item as a property
            $inventory_item->destination_qty = DB::table('inventory_items')
                ->where('inventory_id', $this->destination)->where('product_id', $inventory_item->id)
                ->pluck('qty')->first();

            // If destination qty is null (if product does not exist in destination inventory), assign 0
            if (!$inventory_item->destination_qty)
                $inventory_item->destination_qty = 0;
        }

        return $inventory_items;
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

        // Get inventory items
        $inventory_items = $this->getInventoryItems();

        $this->dispatchBrowserEvent('contentChanged');  // Fire browser event to refresh data

        return view('livewire.stock-transfers.stock-transfer-form')->with('inventory_items', $inventory_items);
    }
}
