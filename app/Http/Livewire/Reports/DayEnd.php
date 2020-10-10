<?php

namespace App\Http\Livewire\Reports;

use App\Exchange;
use App\SalaryPayment;
use App\Sale;
use App\VendorPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DayEnd extends Component
{
    public $date;

    public function mount() {
        $this->date = Carbon::today()->toDateString();
    }

    public function render()
    {
        $range_start = date('Y-m-d'.' 00:00:00', strtotime($this->date));
        $range_end = date('Y-m-d'.' 23:59:59', strtotime($this->date));

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

        $sales_info = ['total_sales_incl_tax' => $total_sales + $total_tax, 'total_sales_excl_tax' => $total_sales,
            'total_qty' => $total_qty, 'gross_profit' => $total_sales + $total_tax - $total_discount - $total_cost,
            'net_profit' => $total_sales - $total_discount - $total_cost];
        $other_info = ['total_exchanges' => $total_exchanges, 'total_discount' => $total_discount];
        $inventory_info = ['total_value' => $total_inventory_value, 'total_qty' => $total_inventory_qty];
        $payment_info = ['salary_pays' => $total_salary_pays, 'vendor_pays' => $total_vendor_pays, 'total_pays' => $total_salary_pays + $total_vendor_pays];

        return view('livewire.reports.day-end')->with('sales_info', $sales_info)->with('other_info', $other_info)
            ->with('inventory_info', $inventory_info)->with('payment_info', $payment_info);
    }
}
