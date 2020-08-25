<?php

namespace App\Http\Livewire;

use App\Employee;
use App\Product;
use App\Variant;
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
    public $pr;
    public $size = array();
    public $color = array();
    public $colorSelect;
    public $employee;
    public $sid;
    public $sname;


    public function mount(){

        $this->products = Product::all();
        $this->employee = Employee::all();

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
        $bcode = str_replace('#','',$this->query);
        $p =  Product::where('barcode','=',$bcode)->get();
        $this->query = '';
        $this->products = '';

        $this->addDropdown($p);

    }
    public function render()
    {


        return view('livewire.product-dropdown');
    }
    public function show($id){
        $prd =  Product::where('id','=',$id)->get();
        $var =  Variant::where('product_id','=',$id)->get();
        $this->query = '';
        $this->products = '';

        if($var){
            $this->showSize($var,$prd);
            $this->pr = $prd;
        }else{
            $this->addDropdown($prd);
        }


    }
    public function addDropdown($prd){

        $bool = false;
        foreach($prd as $pr){

        if(!empty($this->items)){
            foreach($this->items as $key=>$i){
                if($i['code'] == $pr->pcode){
                    $bool = true;
                    $k = $key;
                    $qty = $this->items[$key]['qty'];
                    $this->items[$key]['qty'] = ++$qty;
                    $this->items[$key]['price'] = $pr->sellingPrice * $this->items[$key]['qty'];
                    $this->items[$key]['discount'] = $pr->discount* $this->items[$key]['qty'];
                    $this->items[$key]['total'] = $this->items[$key]['price'] - $this->items[$key]['discount'];
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

    public function showSize($var,$prd){

        foreach($var as $v){
            array_push($this->size,$v->size);
            array_push($this->color,$v->color);
        }
       $this->size =  array_unique($this->size);
       $this->color =  array_unique($this->color);

    }
    public function selectSize($s){
        $this->size = '';

        if($this->color){
            $this->colorSelect = true;
        }else{
            $this->addDropdown($this->pr);
        }

    }
    public function selectColor($c){

        $selectedColor = $this->color[$c];
        $this->color = '';
        $this->colorSelect = '';
        $this->addDropdown($this->pr);
    }

    public function updateSalesman($id){

        $sm =  Employee::where('emp_id','=',$id)->get();
        $this->sid = $id;
        foreach($sm as $s){
            $this->sname = $s->fname.' '.$s->lname;
        }

    }
}
