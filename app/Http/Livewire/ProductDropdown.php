<?php

namespace App\Http\Livewire;

use App\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductDropdown extends Component
{
    public $products;
    public $dbproducts;
    public $items = array();
    public $noOfItems;
    public $discount;
    public $subtotal;
    public $tax;
    public $total;
    public $query;

    public function mount(){

        $this->products = Product::all();
        $this->query = '';
        $this->noOfItems = sizeof($this->items);
        $this->discount = 0.00;
        $this->subtotal = 0.00;
        $this->tax = 0.00;
        $this->total = 0.00;
    }
    public function updatedQuery(){
        $this->products =  Product::where('pcode','like','%'.$this->query.'%')->get();
    }
    public function rest(){
        $this->query = '';
        $this->products = '';
    }
    public function sub(){
        dd($this->query);
    }
    public function render()
    {


        return view('livewire.product-dropdown');
    }
    public function show($id){
        $pr = Product::find($id);
        dd($pr);
        $bool = false;

        if($this->items){
            foreach($this->items as $key=>$i){
                if($i['code'] == $id){
                    $bool = true;
                    $k = $key;
                    $qty = $this->items[$key]['qty'];
                    $this->items[$key]['qty'] = ++$qty;

                }
            }
        }

        if($bool != true){
        array_push($this->items,[
            'code' => $pr->pcode,
            'name' => $pr->name,
            'qty' => '1',
            'price' => $pr->sellingPrice,
            'discount' => $pr->discount,
            'total' => $pr->sellingPrice - $pr->discount
        ]);
    }


        $tempd = 0;
        $tempPrice = 0;
        $tempq=0;
        foreach($this->items as $i){
            $tempd = $tempd + $i['discount'];
            $tempPrice = $tempPrice + $i['price'];
            $tempq = $tempq + $i['qty'];
        }
        $this->discount = $tempd;
        $this->noOfItems = $tempq;
        $this->subtotal = $tempPrice - $tempd;
        $this->total = $this->subtotal - $this->tax;
    }
}
