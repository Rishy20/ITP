<?php

namespace App\Http\Livewire;

use App\Barcode;
use App\Product;
use Livewire\Component;
use PDF;
use Illuminate\Http\Request;
class SelectProducts extends Component
{
    public $products;
    public $dbproducts;
    public $index = 1;
    public $items = array();
    public $labelQty;
    public function mount()
    {
        $this->products = Product::orderBy('id','DESC')->get();
    }

    public function addProduct($id)
    {

        $prd =  Product::where('id', '=', $id)->get();

        foreach ($prd as $pr) {


            array_push($this->items, [
                'num' =>  $this->index++,
                'code' => $pr->pcode,
                'name' => $pr->name,
                'qty' => $pr->Qty,
                'barcode' => $pr->barcode,
                'sellingPrice' => $pr->sellingPrice,
                'lqty'=>$pr->Qty
            ]);
        }
    }

    public function updateQty($value,$index){

        $index = $index - 1;
        $this->items[$index]['lqty'] = $value;
    }

    public function render()
    {
        return view('livewire.select-products');
    }
    public function createPDF(Request $request) {


        $request->session()->put('item', $this->items);
        return redirect()->route('printBarcode');

      }
}
