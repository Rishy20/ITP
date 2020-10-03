@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Product-wise Sales Report</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <a href="#" target="_blank">
                <div class="add-btn">Export Report</div>
            </a>
            <div class="float-right pr-3 pt-1">
                <div id="time_range" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>

            <thead class="table-head">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity Sold</th>
                    <th>Sales</th>
                    <th>Purchase Cost</th>
                    <th>Gross Profit</th>
                    <th>Margin %</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    $(function() {

        const time_range_text = $('#time_range span');

        const today = moment().format('MMMM D, YYYY');
        const yesterday = moment().subtract(1, 'days').format('MMMM D, YYYY');
        const seven_days_back = moment().subtract(6, 'days').format('MMMM D, YYYY');
        const thirty_days_back = moment().subtract(29, 'days').format('MMMM D, YYYY');
        const month_start = moment().startOf('month').format('MMMM D, YYYY');
        const month_end = moment().endOf('month').format('MMMM D, YYYY');
        const last_month_start = moment().subtract(1, 'month').startOf('month').format('MMMM D, YYYY');
        const last_month_end = moment().subtract(1, 'month').endOf('month').format('MMMM D, YYYY');

        const start = moment();
        const end = moment();

        function cb(start, end) {
            if (start.format('MMMM D, YYYY') === today && end.format('MMMM D, YYYY') === today)
                time_range_text.html("Today");
            else if (start.format('MMMM D, YYYY') === yesterday && end.format('MMMM D, YYYY') === yesterday)
                time_range_text.html("Yesterday");
            else if (start.format('MMMM D, YYYY') === seven_days_back && end.format('MMMM D, YYYY') === today)
                time_range_text.html("Last 7 Days");
            else if (start.format('MMMM D, YYYY') === thirty_days_back && end.format('MMMM D, YYYY') === today)
                time_range_text.html("Last 30 Days");
            else if (start.format('MMMM D, YYYY') === month_start && end.format('MMMM D, YYYY') === month_end)
                time_range_text.html("This Month");
            else if (start.format('MMMM D, YYYY') === last_month_start && end.format('MMMM D, YYYY') === last_month_end)
                time_range_text.html("Last Month");
            else
                time_range_text.html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#time_range').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>

@endsection
