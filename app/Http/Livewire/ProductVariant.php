<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductVariant extends Component
{
    public $size;
    public $color;
    public $svalue;
    public $cvalue;
    public $count = 0;


    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
    public function mount(){

    }
    public function showSize($i){
        $this->size = explode(",",$i);
        if($i == ""){
            $this->size=null;
        }
    }
    public function showColor($i){
        $this->color = explode(",",$i);
        if($i == ""){
            $this->color=null;
        }
    }
    public function render()
    {
        return view('livewire.product-variant');
    }
}
