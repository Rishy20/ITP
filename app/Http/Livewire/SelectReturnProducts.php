<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectReturnProducts extends Component
{
    public $products;


    public function mount($product)
    {
        $this->products = $product;
    }

    public function render()
    {
        return view('livewire.select-return-products');
    }
}
