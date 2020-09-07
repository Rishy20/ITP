@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Sales (by items) Report</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="#">Export</a>
            </div>
            <div class="float-right pr-3 pt-1">
                <label for="time_range">Time Range: </label>
                <input name="dates">
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

<script>
    $('input[name="dates"]').daterangepicker();
</script>

@endsection
