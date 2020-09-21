<?php

namespace App\Http\Livewire;

use App\Barcode;
use App\Product;
use Livewire\Component;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectProducts extends Component
{
    public $products;


    public function mount($product)
    {
        $this->products = $product;
    }


    public function render()
    {
        return view('livewire.select-products');
    }

}
