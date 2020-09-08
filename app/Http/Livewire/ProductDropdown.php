<?php

namespace App\Http\Livewire;

use App\Customer;
use App\Employee;
use App\Product;
use App\Sale;
use App\SalesProduct;
use App\Variant;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PHPUnit\Framework\Constraint\IsEmpty;

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
    public $selectedSize;
    public $selectedColor;
    public $index = 1;
    public $customer;
    public $cusid;
    public $cusname;
    public $cusphone;
    public function mount()
    {

        $this->products = Product::all();
        $this->employee = Employee::all();
        $this->customer = Customer::all();
        $this->query = '';
        $this->noOfItems = sizeof($this->items);
        $this->discount = 0.00;
        $this->subtotal = 0.00;
        $this->tax = 0.00;
        $this->total = 0.00;
    }
    // public function updatedQuery(){
    //     $this->products =  Product::where('pcode','like','%'.$this->query.'%')->get();
    // }
    // public function rest(){
    //     $this->query = '';
    //     $this->products = '';
    // }
    public function sub()
    {
        $bcode = str_replace('#', '', $this->query);
        $p =  Product::where('barcode', '=', $bcode)->get();
        $this->query = '';
        $this->products = '';

        $this->addDropdown($p);
    }
    public function render()
    {


        return view('livewire.product-dropdown');
    }
    public function show($id)
    {
        $prd =  Product::where('id', '=', $id)->get();
        $var =  Variant::where('product_id', '=', $id)->get();


        if ($var->isEmpty()) {

            $this->addDropdown($prd);
        } else {
            $this->pr = $prd;
            $this->showSize($var, $prd);
        }
    }
    public function addDropdown($prd)
    {

        $bool = false;
        foreach ($prd as $pr) {

            if (!empty($this->items)) {
                foreach ($this->items as $key => $i) {

                    if ($i['code'] == $pr->pcode) {
                        if ($this->items[$key]['size'] == $this->selectedSize && $this->items[$key]['color'] == $this->selectedColor) {

                            $bool = true;
                            $k = $key;
                            $qty = $this->items[$key]['qty'];
                            $this->items[$key]['qty'] = ++$qty;
                            $this->items[$key]['price'] = $pr->sellingPrice * $this->items[$key]['qty'];
                            $this->items[$key]['discount'] = $pr->discount * $this->items[$key]['qty'];
                            $this->items[$key]['total'] = $this->items[$key]['price'] - $this->items[$key]['discount'];

                        } else if ($this->items[$key]['size'] == '' && $this->items[$key]['color'] == '') {
                            $bool = true;
                            $k = $key;
                            $qty = $this->items[$key]['qty'];
                            $this->items[$key]['qty'] = ++$qty;
                            $this->items[$key]['price'] = $pr->sellingPrice * $this->items[$key]['qty'];
                            $this->items[$key]['discount'] = $pr->discount * $this->items[$key]['qty'];
                            $this->items[$key]['total'] = $this->items[$key]['price'] - $this->items[$key]['discount'];

                        }else if ($this->items[$key]['size'] == $this->selectedSize && $this->items[$key]['color'] == '') {
                            $bool = true;
                            $k = $key;
                            $qty = $this->items[$key]['qty'];
                            $this->items[$key]['qty'] = ++$qty;
                            $this->items[$key]['price'] = $pr->sellingPrice * $this->items[$key]['qty'];
                            $this->items[$key]['discount'] = $pr->discount * $this->items[$key]['qty'];
                            $this->items[$key]['total'] = $this->items[$key]['price'] - $this->items[$key]['discount'];

                        } else if ($this->items[$key]['size'] == '' && $this->items[$key]['color'] == $this->selectedColor) {
                            $bool = true;
                            $k = $key;
                            $qty = $this->items[$key]['qty'];
                            $this->items[$key]['qty'] = ++$qty;
                            $this->items[$key]['price'] = $pr->sellingPrice * $this->items[$key]['qty'];
                            $this->items[$key]['discount'] = $pr->discount * $this->items[$key]['qty'];
                            $this->items[$key]['total'] = $this->items[$key]['price'] - $this->items[$key]['discount'];

                        }
                    }
                }
            }

            if ($bool != true && $this->selectedSize && $this->selectedColor) {

                array_push($this->items, [
                    'id' => $pr->id,
                    'num' =>  $this->index++,
                    'code' => $pr->pcode,
                    'name' => $pr->name,
                    'qty' => '1',
                    'price' => $pr->sellingPrice,
                    'discount' => $pr->discount,
                    'total' => $pr->sellingPrice - $pr->discount,
                    'size' => $this->selectedSize,
                    'color' => $this->selectedColor
                ]);
                $this->selectedSize = '';
                $this->selectedColor = '';
            } else if ($bool != true && $this->selectedSize) {

                array_push($this->items, [
                    'id' => $pr->id,
                    'num' =>  $this->index++,
                    'code' => $pr->pcode,
                    'name' => $pr->name,
                    'qty' => '1',
                    'price' => $pr->sellingPrice,
                    'discount' => $pr->discount,
                    'total' => $pr->sellingPrice - $pr->discount,
                    'size' => $this->selectedSize,
                    'color' => ''

                ]);
                $this->selectedSize = '';
            } else if ($bool != true &&  $this->selectedColor) {

                array_push($this->items, [
                    'id' => $pr->id,
                    'num' =>  $this->index++,
                    'code' => $pr->pcode,
                    'name' => $pr->name,
                    'qty' => '1',
                    'price' => $pr->sellingPrice,
                    'discount' => $pr->discount,
                    'total' => $pr->sellingPrice - $pr->discount,
                    'size' => '',
                    'color' => $this->selectedColor
                ]);
                $this->selectedSize = '';
                $this->selectedColor = '';
            } else if ($bool != true) {

                array_push($this->items, [
                    'id' => $pr->id,
                    'num' =>  $this->index++,
                    'code' => $pr->pcode,
                    'name' => $pr->name,
                    'qty' => '1',
                    'price' => $pr->sellingPrice,
                    'discount' => $pr->discount,
                    'total' => $pr->sellingPrice - $pr->discount,
                    'size' => '',
                    'color' => ''
                ]);
            }
        }


        $tempd = 0;
        $tempPrice = 0;
        $tempq = 0;
        foreach ($this->items as $i) {
            $tempd = $tempd + $i['discount'];
            $tempPrice = $tempPrice + $i['price'];
            $tempq = $tempq + $i['qty'];
        }
        $this->discount = $tempd;
        $this->noOfItems = $tempq;
        $this->subtotal = $tempPrice - $tempd;
        $this->total = $this->subtotal - $this->tax;
    }

    public function showSize($var, $prd)
    {

        foreach ($var as $v) {
            array_push($this->size, $v->size);
            array_push($this->color, $v->color);
        }
        $this->size =  array_unique($this->size);
        $this->color =  array_unique($this->color);
    }
    public function selectSize($s)
    {
        $this->size = array();
        $this->selectedSize = $s;
        if ($this->color) {
            $this->colorSelect = true;
        } else {
            $this->addDropdown($this->pr);
        }
    }
    public function selectColor($c)
    {

        $this->selectedColor = $this->color[$c];

        $this->color = array();
        $this->colorSelect = '';
        $this->addDropdown($this->pr);
    }

    public function updateSalesman($id)
    {

        $sm =  Employee::where('id', '=', $id)->get();
        $this->sid = $id;
        foreach ($sm as $s) {
            $this->sname = $s->fname . ' ' . $s->lname;
        }
    }
    public function updateCustomer($id)
    {
        $cus =  Customer::where('id', '=', $id)->get();
        $this->cusid = $id;
        foreach ($cus as $c) {
            $this->cusname = $c->firstname . ' ' . $c->lastname;
            $this->cusphone = $c->phone;
        }
    }
    public function makeSale(){

        $sale = new Sale();
        $sale->customerId = $this->cusid;
        $sale->staffId = $this->sid;
        $sale->amount = $this->total;
        $sale->discount = $this->discount;
        $sale->taxes = $this->tax;
        $sale->save();
        $last = DB::table('sales')->latest()->first();
        $saleId = $last->id;


        foreach($this->items as $key=>$i){

            $sp = new SalesProduct();
            $sp->saleId = $saleId;
            $sp->pid = $this->items[$key]['id'];
            $sp->qty = $this->items[$key]['qty'];
            $sp->price = $this->items[$key]['total'];
            $sp->discount = $this->items[$key]['discount'];
            $sp->save();
        }


    }
}
