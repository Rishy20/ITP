<?php

namespace App\Http\Controllers;

use App\Exchange;
use App\Inventory;
use App\Product;
use App\SalaryPayment;
use App\Sale;
use App\SalesProduct;
use App\StockTransfer;
use App\VendorPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
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


    // Inventory Reports

    public function stockTransferSummary() {
        $stock_transfers = DB::table('stock_transfers')->join('stock_transfer_items', 'stock_transfers.id', '=',
            'stock_transfer_items.transfer_id')->groupBy('stock_transfers.id')
            ->select('stock_transfers.*', DB::raw('SUM(stock_transfer_items.transfer_qty) AS units'))->get();

        foreach ($stock_transfers as $stock_transfer) {
            $stock_transfer->source_name = Inventory::where('id', $stock_transfer->source)->pluck('name')->first();
            $stock_transfer->dest_name = Inventory::where('id', $stock_transfer->destination)->pluck('name')->first();

            if ($stock_transfer->completed)
                $stock_transfer->status = "Received";
            else
                $stock_transfer->status = "Pending";
        }

        return view('reports.inventory.stock-transfer-summary')->with('stock_transfers', $stock_transfers);
    }

    public function exportStockTransferSummary(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $stock_transfers = StockTransfer::whereBetween('created_at', [$start_date, $end_date])->get();

        $items = DB::table('stock_transfer_items')->get();

        foreach ($stock_transfers as $stock_transfer) {
            $stock_transfer->source_name = Inventory::where('id', $stock_transfer->source)->pluck('name')->first();
            $stock_transfer->dest_name = Inventory::where('id', $stock_transfer->destination)->pluck('name')->first();

            if ($stock_transfer->completed)
                $stock_transfer->status = "Received";
            else
                $stock_transfer->status = "Pending";

            // Get total transfer units of each stock transfer and assign it as a property
            $units = 0;
            foreach ($items as $item) {
                if ($item->transfer_id == $stock_transfer->id)
                    $units += $item->transfer_qty;
            }
            $stock_transfer->units = $units;
        }

        view()->share(['stock_transfers' => $stock_transfers, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.inventory.export.stock-transfer-summary', [$stock_transfers, $start_date, $end_date]);

        return $pdf->stream('stock-transfer-summary.pdf');
    }

    public function stockValuation() {
        $products = DB::table('products')->join('categories', 'products.catID', '=', 'categories.id')
            ->select('products.*', DB::raw('categories.name AS category_name'))->get();

        return view('reports.inventory.stock-valuation')->with('products', $products);
    }

    public function exportStockValuation() {
        $products = DB::table('products')->join('categories', 'products.catID', '=', 'categories.id')
            ->select('products.*', DB::raw('categories.name AS category_name'))->get();

        view()->share('products', $products);
        $pdf =  PDF::loadView('reports.inventory.export.stock-valuation', $products);

        return $pdf->stream('stock-valuation.pdf');
    }

    public function productWiseStock() {
        $products = DB::table('products')->join('categories', 'products.catID', '=', 'categories.id')
            ->select('products.*', DB::raw('categories.name AS category_name'))->get();

        return view('reports.inventory.product-wise-stock')->with('products', $products);
    }

    public function exportProductWiseStock() {
        $products = DB::table('products')->join('categories', 'products.catID', '=', 'categories.id')
            ->select('products.*', DB::raw('categories.name AS category_name'))->get();

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


    // Sales Reports

    public function productWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $product) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $product->sale = $sale;
                    }
                }
            }
        } else
            $sales_products = collect();

        return view('reports.sales.product-wise-sales')->with('sales_products', $sales_products)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function exportProductWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $product) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $product->sale = $sale;
                    }
                }
            }
        } else
            $sales_products = collect();

        view()->share(['sales_products' => $sales_products, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.product-wise-sales', [$sales_products, $start_date, $end_date]);

        return $pdf->stream('product-wise-sales.pdf');
    }

    public function categoryWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_categories = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->join('categories', 'products.catID', '=', 'categories.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('categories.id')
                ->select('categories.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_categories as $category) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $category->sale = $sale;
                    }
                }
            }
        } else
            $sales_categories = collect();

        return view('reports.sales.category-wise-sales')->with('sales_categories', $sales_categories)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function exportCategoryWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_categories = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->join('categories', 'products.catID', '=', 'categories.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('categories.id')
                ->select('categories.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_categories as $category) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $category->sale = $sale;
                    }
                }
            }
        } else
            $sales_categories = collect();

        view()->share(['sales_categories' => $sales_categories, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.category-wise-sales', [$sales_categories, $start_date, $end_date]);

        return $pdf->stream('category-wise-sales.pdf');
    }

    public function supplierWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_vendors = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->join('vendors', 'products.supplierId', '=', 'vendors.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('vendors.id')
                ->select('vendors.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_vendors as $vendor) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $vendor->sale = $sale;
                    }
                }
            }
        } else
            $sales_vendors = collect();

        return view('reports.sales.supplier-wise-sales')->with('sales_vendors', $sales_vendors)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function exportSupplierWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_vendors = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->join('vendors', 'products.supplierId', '=', 'vendors.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('vendors.id')
                ->select('vendors.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_vendors as $vendor) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $vendor->sale = $sale;
                    }
                }
            }
        } else
            $sales_vendors = collect();

        view()->share(['sales_vendors' => $sales_vendors, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.supplier-wise-sales', [$sales_vendors, $start_date, $end_date]);

        return $pdf->stream('supplier-wise-sales.pdf');
    }

    public function salesmanWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = DB::table('sales')->join('employees', 'sales.staffId', '=', 'employees.id')
            ->join('sales_products', 'sales_products.saleId', '=', 'sales.id')
            ->groupBy('sales.staffId')->whereBetween('sales.updated_at', [$start_date, $end_date])
            ->select('employees.*', DB::raw('SUM(sales.amount) AS sales_sum'),
                DB::raw('SUM(sales.taxes) AS taxes_sum'), DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();

        return view('reports.sales.salesman-wise-sales')->with('sales', $sales)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function exportSalesmanWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = DB::table('sales')->join('employees', 'sales.staffId', '=', 'employees.id')
            ->join('sales_products', 'sales_products.saleId', '=', 'sales.id')
            ->groupBy('sales.staffId')->whereBetween('sales.updated_at', [$start_date, $end_date])
            ->select('employees.*', DB::raw('SUM(sales.amount) AS sales_sum'),
                DB::raw('SUM(sales.taxes) AS taxes_sum'), DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();

        view()->share(['sales' => $sales, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.salesman-wise-sales', [$sales, $start_date, $end_date]);

        return $pdf->stream('salesman-wise-sales.pdf');
    }

    public function customerWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = DB::table('sales')->join('customers', 'sales.customerId', '=', 'customers.id')
            ->join('sales_products', 'sales_products.saleId', '=', 'sales.id')
            ->groupBy('sales.customerId')->whereBetween('sales.updated_at', [$start_date, $end_date])
            ->select('customers.*', DB::raw('SUM(sales.amount) AS sales_sum'),
                DB::raw('SUM(sales.taxes) AS taxes_sum'), DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();

        return view('reports.sales.customer-wise-sales')->with('sales', $sales)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function exportCustomerWiseSales(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = DB::table('sales')->join('customers', 'sales.customerId', '=', 'customers.id')
            ->join('sales_products', 'sales_products.saleId', '=', 'sales.id')
            ->groupBy('sales.customerId')->whereBetween('sales.updated_at', [$start_date, $end_date])
            ->select('customers.*', DB::raw('SUM(sales.amount) AS sales_sum'),
                DB::raw('SUM(sales.taxes) AS taxes_sum'), DB::raw('SUM(sales_products.qty) AS qty_sum'))->get();

        view()->share(['sales' => $sales, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.salesman-wise-sales', [$sales, $start_date, $end_date]);

        return $pdf->stream('salesman-wise-sales.pdf');
    }

    public function dailySalesSummary() {
        return view('reports.sales.daily-sales-summary');
    }

    public function exportDailySalesSummary(Request $request) {
        $date = $request->input('date');

        $start_date = date('Y-m-d'.' 00:00:00', strtotime($date));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($date));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        $profit = collect();
        $profit->revenue = 0;
        $profit->cost = 0;
        $profit->gp = 0;
        $profit->gp_margin = 0;
        $profit->tax = 0;

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(products.costPrice) AS cost_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $item) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $item->sale = $sale;
                    }
                }

                $profit->revenue += $item->sales_sum;
                $profit->cost += $item->cost_sum;
                $profit->tax += $item->sale->taxes;
            }

            $profit->gp = $profit->revenue - $profit->cost;
            $profit->gp_margin += ($profit->gp / $profit->revenue) * 100;
        }

        view()->share(['profit' => $profit, 'date' => $date]);
        $pdf =  PDF::loadView('reports.sales.export.daily-sales-summary', [$profit, $date]);

        return $pdf->stream('daily-sales-summary.pdf');
    }

    public function monthlySalesSummary() {
        return view('reports.sales.monthly-sales-summary');
    }

    public function exportMonthlySalesSummary(Request $request) {
        $date = $request->input('date');

        $start_date = date('Y-m-d'.' 00:00:00', strtotime($date));
        $temp_date = Carbon::createFromFormat('Y-m', $date)->endOfMonth();
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($temp_date));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        $profit = collect();
        $profit->revenue = 0;
        $profit->cost = 0;
        $profit->gp = 0;
        $profit->gp_margin = 0;
        $profit->tax = 0;

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(products.costPrice) AS cost_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $item) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $item->sale = $sale;
                    }
                }

                $profit->revenue += $item->sales_sum;
                $profit->cost += $item->cost_sum;
                $profit->tax += $item->sale->discount;
            }

            $profit->gp = $profit->revenue - $profit->cost;
            if ($profit->revenue != 0)
                $profit->gp_margin += ($profit->gp / $profit->revenue) * 100;
        }

        view()->share(['profit' => $profit, 'date' => $date]);
        $pdf =  PDF::loadView('reports.sales.export.monthly-sales-summary', [$profit, $date]);

        return $pdf->stream('monthly-sales-summary.pdf');
    }

    public function productReturn() {
        $returns = DB::select('select e.id, e.productID, e.customerID, e.salesmanID, e.amount, e.updated_at, p.pcode,
                        c.firstname, c.lastname, em.fname, em.lname from exchanges e, products p, employees em, customers c where
                        e.productID = p.id and e.customerID = c.id and e.salesmanID = em.id');

        return view('reports.sales.product-return')->with('returns', $returns);
    }

    public function exportProductReturn(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $returns = DB::select('select e.id, e.productID, e.customerID, e.salesmanID, e.amount, e.updated_at, p.pcode,
                        c.firstname, c.lastname, em.fname, em.lname from exchanges e, products p, employees em, customers c where
                        e.productID = p.id and e.customerID = c.id and e.salesmanID = em.id and e.updated_at between ? and ?', [$start_date, $end_date]);

        view()->share(['returns' => $returns, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.product-return', [$returns, $start_date, $end_date]);

        return $pdf->stream('product-return.pdf');
    }

    public function totalExpense() {
        $expenses = DB::table('expenses')->join('users', 'expenses.userId', '=',
            'users.id')->select('expenses.*', 'users.display_name')->get();

        return view('reports.sales.total-expense')->with('expenses', $expenses);
    }

    public function exportTotalExpense(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $expenses = DB::table('expenses')->join('users', 'expenses.userId', '=',
            'users.id')->whereBetween('expenses.updated_at', [$start_date, $end_date])
            ->select('expenses.*', 'users.display_name')->get();

        view()->share(['expenses' => $expenses, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.sales.export.total-expense', [$expenses, $start_date, $end_date]);

        return $pdf->stream('total-expense.pdf');
    }

    public function dailyProfit() {
        return view('reports.sales.daily-profit');
    }

    public function exportDailyProfit(Request $request) {
        $date = $request->input('date');

        $start_date = date('Y-m-d'.' 00:00:00', strtotime($date));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($date));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        $profit = collect();
        $profit->revenue = 0;
        $profit->cost = 0;
        $profit->gp = 0;
        $profit->np = 0;
        $profit->gp_margin = 0;
        $profit->tax = 0;

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(products.costPrice) AS cost_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $item) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $item->sale = $sale;
                    }
                }

                $profit->revenue += $item->sales_sum;
                $profit->cost += $item->cost_sum;
                $profit->tax += $item->sale->taxes;
            }

            $profit->gp = $profit->revenue - $profit->cost;
            $profit->np = $profit->revenue - $profit->cost - $profit->tax;
            $profit->gp_margin += ($profit->gp / $profit->revenue) * 100;
        }

        view()->share(['profit' => $profit, 'date' => $date]);
        $pdf =  PDF::loadView('reports.sales.export.daily-profit', [$profit, $date]);

        return $pdf->stream('daily-profit.pdf');
    }

    public function monthlyProfit() {
        return view('reports.sales.monthly-profit');
    }

    public function exportMonthlyProfit(Request $request) {
        $date = $request->input('date');

        $start_date = date('Y-m-d'.' 00:00:00', strtotime($date));
        $temp_date = Carbon::createFromFormat('Y-m', $date)->endOfMonth();
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($temp_date));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        $profit = collect();
        $profit->revenue = 0;
        $profit->cost = 0;
        $profit->gp = 0;
        $profit->np = 0;
        $profit->gp_margin = 0;
        $profit->tax = 0;

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(products.costPrice) AS cost_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $item) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $item->sale = $sale;
                    }
                }

                $profit->revenue += $item->sales_sum;
                $profit->cost += $item->cost_sum;
                $profit->tax += $item->sale->discount;
            }

            $profit->gp = $profit->revenue - $profit->cost;
            $profit->np = $profit->revenue - $profit->cost - $profit->tax;
            if ($profit->revenue != 0)
                $profit->gp_margin += ($profit->gp / $profit->revenue) * 100;
        }

        view()->share(['profit' => $profit, 'date' => $date]);
        $pdf =  PDF::loadView('reports.sales.export.monthly-profit', [$profit, $date]);

        return $pdf->stream('monthly-profit.pdf');
    }


    // Product Reports

    public function zeroStockProduct() {
        $products = Product::where('Qty', '=', 0)->get();

        return view('reports.product.zero-stock-product')->with('products', $products);
    }

    public function exportZeroStockProduct() {
        $products = Product::where('Qty', '=', 0)->get();
        view()->share('products', $products);
        $pdf =  PDF::loadView('reports.product.export.zero-stock-product', $products);

        return $pdf->stream('zero-stock-product.pdf');
    }

    public function minusStockProduct() {
        $products = Product::where('Qty', '<', 0)->get();

        return view('reports.product.minus-stock-product')->with('products', $products);
    }

    public function exportMinusStockProduct() {
        $products = Product::where('Qty', '<', 0)->get();
        view()->share('products', $products);
        $pdf =  PDF::loadView('reports.product.export.minus-stock-product', $products);

        return $pdf->stream('minus-stock-product.pdf');
    }

    public function supplierPurchase() {
        $supplier_purchases = DB::table('purchase')->join('vendors', 'purchase.vendorID', '=',
            'vendors.id')->select('purchase.*', 'vendors.first_name', 'vendors.last_name', 'vendors.company_name')
            ->get();

        foreach ($supplier_purchases as $purchase) {
            $purchase->name = $purchase->last_name . ', ' . $purchase->first_name;
        }
        return view('reports.product.supplier-purchase')->with('supplier_purchases', $supplier_purchases);
    }

    public function exportSupplierPurchase(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $supplier_purchases = DB::table('purchase')->join('vendors', 'purchase.vendorID', '=',
            'vendors.id')->whereBetween('purchase.updated_at', [$start_date, $end_date])
            ->select('purchase.*', 'vendors.first_name', 'vendors.last_name', 'vendors.company_name')->get();

        foreach ($supplier_purchases as $purchase) {
            $purchase->name = $purchase->last_name . ', ' . $purchase->first_name;
        }

        view()->share(['supplier_purchases' => $supplier_purchases, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.product.export.supplier-purchase', [$supplier_purchases, $start_date, $end_date]);

        return $pdf->stream('supplier-purchase.pdf');
    }

    public function productWiseProfit(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(products.costPrice) AS cost_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $product) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $product->sale = $sale;
                    }
                }

                $product->gp = $product->sales_sum - $product->cost_sum;
                $product->np = $product->gp - $product->sale->taxes;
                $product->gp_margin = ($product->gp / $product->sales_sum) * 100;
            }
        } else
            $sales_products = collect();

        return view('reports.product.product-wise-profit')->with('sales_products', $sales_products)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function exportProductWiseProfit(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $sales = Sale::whereBetween('updated_at', [$start_date, $end_date])->get();

        if (!$sales->isEmpty()) {
            $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
                ->whereIn('saleId', $sales->pluck('id'))->groupBy('sales_products.pid')
                ->select('products.*', DB::raw('SUM(sales_products.price) AS sales_sum'),
                    DB::raw('SUM(products.costPrice) AS cost_sum'))->get();
            $taxes = SalesProduct::all();

            foreach ($sales_products as $product) {
                foreach ($sales as $sale) {
                    foreach ($taxes as $tax) {
                        if ($tax->saleId == $sale->id)
                            $product->sale = $sale;
                    }
                }

                $product->gp = $product->sales_sum - $product->cost_sum;
                $product->np = $product->gp - $product->sale->taxes;
                $product->gp_margin = ($product->gp / $product->sales_sum) * 100;
            }
        } else
            $sales_products = collect();

        view()->share(['sales_products' => $sales_products, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.product.export.product-wise-profit', [$sales_products, $start_date, $end_date]);

        return $pdf->stream('product-wise-profit.pdf');
    }


    // Payment Reports

//    public function totalPayment() {
//        $expenses = DB::table('expenses')->join('users', 'expenses.userId', '=',
//            'users.id')->select('expenses.*', 'users.display_name')->get();
//
//        foreach ($expenses as $expense)
//            $expense->updated_at = date('Y-m-d', strtotime($expense->updated_at));
//
//        return view('reports.sales.total-expense')->with('expenses', $expenses);
//    }
//
//    public function exportTotalPayment(Request $request) {
//        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
//        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));
//
//        $expenses = DB::table('expenses')->join('users', 'expenses.userId', '=',
//            'users.id')->whereBetween('expenses.updated_at', [$start_date, $end_date])
//            ->select('expenses.*', 'users.display_name')->get();
//
//        $total = 0;
//        foreach ($expenses as $expense) {
//            $expense->updated_at = date('Y-m-d', strtotime($expense->updated_at));
//            $total += $expense->amount;
//        }
//
//        view()->share(['expenses' => $expenses, 'start_date' => $start_date, 'end_date' => $end_date]);
//        $pdf =  PDF::loadView('reports.sales.export.total-expense', [$expenses, $start_date, $end_date]);
//
//        return $pdf->stream('total-expense.pdf');
//    }

    public function supplierPayment() {
        $supplier_pays = DB::table('vendor_payment')->join('vendors', 'vendor_payment.vendorID', '=',
            'vendors.id')->select('vendor_payment.*', 'vendors.first_name', 'vendors.last_name', 'vendors.company_name')
            ->get();

        foreach ($supplier_pays as $pay) {
            $pay->name = $pay->last_name . ', ' . $pay->first_name;
        }

        return view('reports.payment.supplier-payment')->with('supplier_pays', $supplier_pays);
    }

    public function exportSupplierPayment(Request $request) {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($request->input('start_date')));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($request->input('end_date')));

        $supplier_pays = DB::table('vendor_payment')->join('vendors', 'vendor_payment.vendorID', '=',
            'vendors.id')->whereBetween('vendor_payment.updated_at', [$start_date, $end_date])
            ->select('vendor_payment.*', 'vendors.first_name', 'vendors.last_name', 'vendors.company_name')->get();

        foreach ($supplier_pays as $pay) {
            $pay->name = $pay->last_name . ', ' . $pay->first_name;
        }

        view()->share(['supplier_pays' => $supplier_pays, 'start_date' => $start_date, 'end_date' => $end_date]);
        $pdf =  PDF::loadView('reports.payment.export.supplier-payment', [$supplier_pays, $start_date, $end_date]);

        return $pdf->stream('supplier-payment.pdf');
    }


    // Other Reports

    public function dayEnd() {
        return view('reports.other.day-end');
    }

    public function exportDayEnd(Request $request) {
        $date = $request->input('date');

        $range_start = date('Y-m-d'.' 00:00:00', strtotime($date));
        $range_end = date('Y-m-d'.' 23:59:59', strtotime($date));

        $sales = Sale::whereBetween('updated_at', [$range_start, $range_end])->get();
        $sales_products = DB::table('sales_products')->join('products', 'sales_products.pid', '=', 'products.id')
            ->whereIn('saleId', $sales->pluck('id'))->get();

        $total_sales = 0;
        $total_cost = 0;
        $total_tax = 0;
        $total_discount = 0;
        $total_qty = 0;

        foreach ($sales as $sale) {
            $total_sales += $sale->amount;
            $total_discount += $sale->discount;
            $total_tax += $sale->taxes;
        }

        foreach ($sales_products as $sales_product) {
            $total_qty += $sales_product->qty;
            $total_cost += $sales_product->costPrice;
        }

        $exchanges = Exchange::whereBetween('updated_at', [$range_start, $range_end])->get();
        $total_exchanges = 0;

        foreach ($exchanges as $exchange)
            $total_exchanges += $exchange->amount;

        $items = DB::table('products')->join('categories', 'products.catID', '=', 'categories.id')
            ->select('products.*', DB::raw('categories.name AS category_name'))->get();

        $total_inventory_value = 0;
        $total_inventory_qty = 0;

        foreach ($items as $item) {
            $total_inventory_value += $item->costPrice;
            $total_inventory_qty += $item->Qty;
        }

        $salary_pays = SalaryPayment::whereBetween('updated_at', [$range_start, $range_end])->get();
        $vendor_pays = VendorPayment::whereBetween('updated_at', [$range_start, $range_end])->get();
        $total_salary_pays = 0;
        $total_vendor_pays = 0;

        foreach ($salary_pays as $salary_pay)
            $total_salary_pays += $salary_pay->amount;
        foreach ($vendor_pays as $vendor_pay)
            $total_vendor_pays += $vendor_pay->amount;

        $sales_info = ['total_sales_incl_tax' => $total_sales, 'total_sales_excl_tax' => $total_sales - $total_tax,
            'total_qty' => $total_qty, 'gross_profit' => $total_sales - $total_cost,
            'net_profit' => $total_sales - $total_cost - $total_tax];
        $other_info = ['total_exchanges' => $total_exchanges, 'total_discount' => $total_discount];
        $inventory_info = ['total_value' => $total_inventory_value, 'total_qty' => $total_inventory_qty];
        $payment_info = ['salary_pays' => $total_salary_pays, 'vendor_pays' => $total_vendor_pays, 'total_pays' => $total_salary_pays + $total_vendor_pays];

        view()->share(['sales_info' => $sales_info, 'other_info' => $other_info, 'inventory_info' => $inventory_info,
            'payment_info' => $payment_info, 'date' => $date]);
        $pdf =  PDF::loadView('reports.other.export.day-end', [$sales_info, $other_info, $inventory_info, $payment_info, $date]);

        return $pdf->stream('day-end.pdf');
    }
}
