<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class ProductDropdown extends Component
{
    public $products;
    public $dbproducts;

    public function mount(){

        $this->products = Product::all();
    }
    public function render()
    {
        return view('livewire.product-dropdown');
    }
}
