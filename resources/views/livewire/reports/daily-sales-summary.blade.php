<div>
    <div class="section-content">
        <form action="{{ route('reports.export-daily-sales-summary') }}" target="_blank" method="POST">
            @csrf
            <table wire:loading.remove id="data_table" class="table table-striped table-borderless">
                <button type="submit" class="add-btn mb-3">Export Report</button>
                <div class="float-right pr-3 pt-1">
                    <input wire:model="date" class="form-control" type="date" name="date" id="date_input">
                </div>
                <thead class="table-head">
                    <tr class="text-center">
                        <th>Description</th>
                        <th>Cost of Goods</th>
                        <th>Total Sales (Incl. Tax)</th>
                        <th>Total Sales (Excl. Tax)</th>
                        <th>Gross Profit</th>
                        <th>Margin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>Total</td>
                        <td>{{ $profit->cost }}</td>
                        <td>{{ $profit->revenue + $profit->tax }}</td>
                        <td>{{ $profit->revenue }}</td>
                        <td>{{ $profit->gp }}</td>
                        <td>{{ number_format($profit->gp_margin, 2, '.', ',') . "%" }}</td>
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
