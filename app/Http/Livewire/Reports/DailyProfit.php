<?php

namespace App\Http\Livewire\Reports;

use App\Sale;
use App\SalesProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DailyProfit extends Component
{
    public $date;

    public function mount() {
        $this->date = Carbon::today()->toDateString();
    }

    public function render()
    {
        $start_date = date('Y-m-d'.' 00:00:00', strtotime($this->date));
        $end_date = date('Y-m-d'.' 23:59:59', strtotime($this->date));

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
            if ($profit->revenue != 0)
                $profit->gp_margin += ($profit->gp / $profit->revenue) * 100;
        }

        return view('livewire.reports.daily-profit')->with('profit', $profit)
            ->with('start_date', $start_date)->with('end_date', $end_date);
    }
}
