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
    public $dbproducts;
    public $index = 1;
    public $items = array();

    public function mount()
    {
        $this->products = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');
    }

    public function addProduct($id,$vid)
    {

        if($vid){
            $prd =  DB::select('select p.id,v.id as vid,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id Where v.product_id = ? and v.id = ?',[$id,$vid]);
        }else{
            $prd =  DB::select('select p.id,v.id as vid,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id Where p.id = ?',[$id]);
        }


        $this->products = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');
        foreach ($prd as $prs) {
            array_push($this->items, [
                'num' =>  $this->index++,
                'code' => $prs->pcode,
                'name' => $prs->name,
                'size' => $prs->size,
                'color' => $prs->color,
            ]);
        }

    }
    public function remove($index){

            unset($this->items[$index]);
            $this->products = DB::select('select p.id,v.id as vid ,pcode,p.name,v.size,v.color,v.price from products p LEFT JOIN variants v ON p.id = v.product_id');

    }


    public function render()
    {
        return view('livewire.select-products');
    }

}
