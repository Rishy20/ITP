
<?php

namespace App\Http\Livewire;

use App\Product;
use App\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddProduct extends Component
{
    public $size;
    public $color;
    public $svalue;
    public $cvalue;
    public $count = 0;
    public $inv;
    public $cat;
    public $brand;
    public $vendor;
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
    public function mount($inv,$cat,$brand,$vendor){
        $this->inv = $inv;
        $this->cat = $cat;
        $this->brand = $brand;
        $this->vendor = $vendor;
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
        return view('livewire.add-product');
    }
    public function save(){

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
        $last = DB::table('products')->latest()->first();
        $pId = $last->id;



        if($this->size && $this->color){
            $i = 0;
            foreach($this->size as $skey=>$svalue){
                foreach($this->color as $ckey=>$cvalue){

                        $var = new Variant();
                        $var->product_id = $pId;
                        $var->size = $svalue;
                        $var->color= $cvalue;
                        $var->price = $this->vprice[$i];
                        $var->quantity = $this->vqty[$i];
                        $var->save();
                        $i++;
                }
            }
        }else if($this->size){
            foreach($this->size as $key=>$value){
                $var = new Variant();
                $var->product_id = $pId;
                        $var->size = $value;
                        $var->price = $this->vprice[$key];
                        $var->quantity = $this->vqty[$key];
                        $var->save();

            }
        }else if($this->color){
            foreach($this->color as $key=>$value){
                $var = new Variant();
                $var->product_id = $pId;
                        $var->color= $value;
                        $var->price = $this->vprice[$key];
                        $var->quantity = $this->vqty[$key];
                        $var->save();

            }
        }

        return redirect('/product');
    }

}
