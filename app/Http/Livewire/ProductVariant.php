<?php

namespace App\Http\Livewire;

use App\Product;
use App\Variant;
use Illuminate\Http\Request;
use Livewire\Component;

class ProductVariant extends Component
{
    public $size;
    public $color;
    public $svalue;
    public $cvalue;
    public $count = 0;
    public $inv;
    public $cat;
    public $pname;
    public $pcode;
    public $pdescription;
    public $pbrand;
    public $pcat;
    public $psup;
    public $cprice;
    public $sprice;
    public $pdiscount;
    public $pinv;
    public $barcode;
    public $pqty;
    public $prqty;
    public $vprice = array();
    public $vqty = array();

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
    public function mount($inv,$cat){
        $this->inv = $inv;
        $this->cat = $cat;
        $product = Product::all();
        $key = sizeof($product)-1;
        $this->barcode = $product[$key]['barcode']+1;
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
    public function save(){

        // dd($this->vprice[0]);

        $pr = new Product();
        $pr->pcode = $this->pcode;
        $pr->name = $this->pname;
        $pr->description = $this->pdescription;
        $pr->brand = $this->pbrand;
        $pr->catID = $this->pcat;
        $pr->barcode = $this->barcode;
        $pr->sellingPrice = $this->sprice;
        $pr->costPrice = $this->cprice;
        $pr->discount= $this->pdiscount;
        $pr->Qty = $this->pqty;
        $pr->reorder_level = $this->prqty;
        $pr->supplierId = $this->psup;
        $pr->save();

        $index = Product::where('pcode','=',$this->pcode)->get();


        if($this->size && $this->color){
            $i = 0;
            foreach($this->size as $skey=>$svalue){
                foreach($this->color as $ckey=>$cvalue){
                        $var = new Variant();
                        $var->product_id = $index[0]['id'];
                        $var->size = $svalue;
                        $var->color= $cvalue;
                        // dd( $this->vqty[$i],$this->vprice[$i]);
                        $var->price = $this->vprice[$i];

                        $var->quantity = $this->vqty[$i];

                        $var->save();
                        $i++;
                }
            }
        }else if($this->size){
            foreach($this->size as $key=>$value){
                $var = new Variant();
                        $var->product_id = $index[0]['id'];
                        $var->size = $value;
                        $var->price = $this->vprice[$key];
                        $var->quantity = $this->vqty[$key];
                        $var->save();

            }
        }else if($this->color){
            foreach($this->color as $key=>$value){
                $var = new Variant();
                        $var->product_id = $index[0]['id'];
                        $var->color= $value;
                        $var->price = $this->vprice[$key];
                        $var->quantity = $this->vqty[$key];
                        $var->save();

            }
        }


    }

}
