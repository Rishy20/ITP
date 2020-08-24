<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use PDF;


class BarcodeController extends Controller
{
    public function show(){

        $product = Product::all();
        return view('Barcode.barcode',compact('product'));
    }

    public function createPDF() {

        // $pdf = PDF::loadView('testBarcode');
        // return $pdf->download('invoice.pdf');
        $product = Product::all();

        // return view ('Barcode.printBarcode',compact('product'));

        view()->share('product',$product);

        $pdf = PDF::loadView('Barcode.printBarcode',$product);

        // download PDF file with download method
        return $pdf->stream('barcode.pdf');
      }
}
