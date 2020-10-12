<?php

namespace App\Http\Livewire;

use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Variant extends Component
{
    public $size = array();
    public $color = array();
    public $svalue ;
    public $cvalue ;
    public $count = 0;
    public $vprice = array();
    public $vqty = array();
    private $var;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
    public function mount($var){

      if($var != null){
            foreach($var as $v){
                array_push($this->size,$v->size);
                array_push($this->color,$v->color);
            }
            $this->size = array_unique($this->size);
            $this->color = array_unique($this->color);
            $this->size = array_filter($this->size);
            $this->color = array_filter($this->color);
            $this->svalue = implode(",",$this->size);
            $this->cvalue = implode(",",$this->color);


        }

        $product = Product::all();
        $key = sizeof($product)-1;
    }
    public function showSize($i){

        $this->size = explode(",",$i);
        if($i == ""){
            $this->size=null;
        }
        // $sprice = $_COOKIE['sprice'];
    }
    public function showColor($i){
        $this->color = explode(",",$i);
        if($i == ""){
            $this->color=null;
        }
    }
    public function render()
    {
        return view('livewire.variant');
    }


}
