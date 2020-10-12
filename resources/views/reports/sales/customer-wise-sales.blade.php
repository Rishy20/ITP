@extends('layouts.main')
@section('content')

    <div class="pg-heading">
        <a href="{{ route('reports.index') }}">
            <i class="fa fa-arrow-left pg-back"></i>
        </a>
        <div class="pg-title">Customer-wise Sales Report</div>
    </div>

    <div class="section">

        <div class="section-content">
            <form action="{{ route('reports.export-salesman-wise-sales') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="start_date" id="start_date">
                <input type="hidden" name="end_date" id="end_date">

                <table id="data_table" class="table table-striped table-borderless table-hover all-table">
                    <button type="submit" class="add-btn">Export Report</button>
                    <div class="float-right pr-3" style="padding-top: 8px;">
                        <h5 class="d-inline-block text-secondary" id="start_date_text"></h5>
                        <h5 class="d-inline-block text-secondary" id="to">&nbsp;to&nbsp;</h5>
                        <h5 class="d-inline-block text-secondary" id="end_date_text"></h5>
                    </div>

                    <thead class="table-head">
                        <tr>
                            <th>Customer Name</th>
                            <th>Quantity Sold To</th>
                            <th>Total Sales (Incl. Tax)</th>
                            <th>Total Sales (Excl. Tax)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->lastname . ', ' . $sale->firstname }}</td>
                                <td class="text-right">{{ $sale->qty_sum }}</td>
                                <td class="text-right">{{ $sale->sales_sum + $sale->taxes_sum }}</td>
                                <td class="text-right">{{ $sale->sales_sum }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#data_table').DataTable({
                "order": []
                , "dom": '<"top"f><t><"bottom"lip>'
                , language: {
                    search: "_INPUT_"
                    , searchPlaceholder: "🔎 Search"
                }
            });

            $('#start_date').val("{{ date('Y-m-d', strtotime($start_date)) }}");
            $('#end_date').val("{{ date('Y-m-d', strtotime($end_date)) }}");
            $('#start_date_text').html("{{ date('Y-m-d', strtotime($start_date)) }}");
            $('#end_date_text').html("{{ date('Y-m-d', strtotime($end_date)) }}");
        });
    </script>

@endsection
