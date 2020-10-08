<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index() {
        return view('reports.index');
    }

    public function productWiseSales() {
        $products = Product::all();

        return view('reports.sales.product-wise-sales');
    }


    // Inventory Reports

    public function stockTransferSummary() {
        $products = Product::all();

        return view('reports.inventory.stock-transfer-summary');
    }

    public function productWiseStock() {
        $products = Product::all();

        return view('reports.inventory.product-wise-stock')->with('products', $products);
    }

    public function exportProductWiseStock() {
        $products = Product::all();
        view()->share('products', $products);
        $pdf =  PDF::loadView('reports.inventory.export.product-wise-stock', $products);

        return $pdf->stream('product-wise-stock.pdf');
    }

    public function categoryWiseStock() {
        $categories = DB::table('categories')->join('products', 'products.catID', '=', 'categories.id')
            ->groupBy('categories.id')->select('categories.name', DB::raw('SUM(products.Qty) AS qty'))->get();

        return view('reports.inventory.category-wise-stock')->with('categories', $categories);
    }

    public function exportCategoryWiseStock() {
        $categories = DB::table('categories')->join('products', 'products.catID', '=', 'categories.id')
            ->groupBy('categories.id')->select('categories.name', DB::raw('SUM(products.Qty) AS qty'))->get();

        view()->share('categories', $categories);
        $pdf =  PDF::loadView('reports.inventory.export.category-wise-stock', $categories);

        return $pdf->stream('category-wise-stock.pdf');
    }

    public function supplierWiseStock() {
        $suppliers = DB::table('vendors')->join('products', 'products.supplierId', '=', 'vendors.id')
            ->groupBy('vendors.id')->select('vendors.*', DB::raw('SUM(products.Qty) AS qty'))->get();

        foreach ($suppliers as $supplier)
            $supplier->name = $supplier->last_name.", ".$supplier->first_name;

        return view('reports.inventory.supplier-wise-stock')->with('suppliers', $suppliers);
    }

    public function exportSupplierWiseStock() {
        $suppliers = DB::table('vendors')->join('products', 'products.supplierId', '=', 'vendors.id')
            ->groupBy('vendors.id')->select('vendors.*', DB::raw('SUM(products.Qty) AS qty'))->get();

        foreach ($suppliers as $supplier)
            $supplier->name = $supplier->last_name.", ".$supplier->first_name;

        view()->share('suppliers', $suppliers);
        $pdf =  PDF::loadView('reports.inventory.export.supplier-wise-stock', $suppliers);

        return $pdf->stream('supplier-wise-stock.pdf');
    }
}
