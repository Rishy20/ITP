<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Product extends Component
{
    public $products;
    public function mount(){

    }
    public function render()
    {
        return view('livewire.product');
    }
}
