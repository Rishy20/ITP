<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class BarcodeInput extends Component
{
    public $barcode;

    public function mount(){
        $product = Product::all();
        $key = sizeof($product)-1;
        $this->barcode = $product[$key]['barcode']+1;
    }
    public function render()
    {
        return view('livewire.barcode-input');
    }
}
