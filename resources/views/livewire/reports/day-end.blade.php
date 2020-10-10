<div>
    <div class="section-content">
        <form action="{{ route('reports.export-day-end') }}" target="_blank" method="POST">
            @csrf
            <table wire:loading.remove id="data_table" class="table table-striped table-borderless">
                <button type="submit" class="add-btn mb-3">Export Report</button>
                <div class="float-right pr-3 pt-1">
                    <input wire:model="date" class="form-control" type="date" name="date" id="date_input">
                </div>
                <thead class="table-head">
                    <tr class="text-center">
                        <th>Description</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">Sales</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Total Sales (incl. Tax)</td>
                        <td class="text-right">{{ $sales_info['total_sales_incl_tax'] }}</td>
                    </tr>
                    <tr>
                        <td>Total Sales (excl. Tax)</td>
                        <td class="text-right">{{ $sales_info['total_sales_excl_tax'] }}</td>
                    </tr>
                    <tr>
                        <td>No. of Items Sold</td>
                        <td class="text-right">{{ $sales_info['total_qty'] }}</td>
                    </tr>
                    <tr>
                        <td>Gross Profit</td>
                        <td class="text-right">{{ $sales_info['gross_profit'] }}</td>
                    </tr>
                    <tr>
                        <td>Net Profit</td>
                        <td class="text-right">{{ $sales_info['net_profit'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Exchanges</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Total Exchanges</td>
                        <td class="text-right">{{ $other_info['total_exchanges'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Discounts</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Total Discounts</td>
                        <td class="text-right">{{ $other_info['total_discount'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Inventory</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Total Items in Inventory</td>
                        <td class="text-right">{{ $inventory_info['total_qty'] }}</td>
                    </tr>
                    <tr>
                        <td>Total Inventory Value</td>
                        <td class="text-right">{{ $inventory_info['total_value'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Payments</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Salary Payments</td>
                        <td class="text-right">{{ $payment_info['salary_pays'] }}</td>
                    </tr>
                    <tr>
                        <td>Payments to Vendors</td>
                        <td class="text-right">{{ $payment_info['vendor_pays'] }}</td>
                    </tr>
                    <tr>
                        <td>Total Payments</td>
                        <td class="text-right">{{ $payment_info['total_pays'] }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center">
                <div wire:loading id="spinner">
                    <div class="spinner-border" role="status"
                         style="color: #058de9; width: 2.5em; height: 2.5em">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
