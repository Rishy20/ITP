<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\userRole;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class BarcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $role = userRole::find($user->roleId);

        if($role->printbarcodes){
            return view('Barcode.selectProducts');
        }else{
            return view('noaccess');
        }
    }
    public function show(){

        $product = Product::all();
        return view('Barcode.barcode',compact('product'));
    }

    public function createPDF(Request $request) {

        $items = $request->session()->get('item', 'default');


        // $pdf = PDF::loadView('testBarcode');
        // return $pdf->download('invoice.pdf');
        $product = Product::all();

        // return view ('Barcode.printBarcode',compact('product'));

        view()->share('items',$items);

        $pdf =  PDF::loadView('Barcode.printBarcode',$items);

        // download PDF file with download method
        return $pdf->stream('barcode.pdf');
      }
}
