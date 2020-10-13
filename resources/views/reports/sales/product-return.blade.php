@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('reports.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Product Return Report</div>
</div>

<div class="section">

    <div class="section-content">
        <form action="{{ route('reports.export-product-return') }}" target="_blank" method="POST">
            @csrf

            <table id="data_table" class="table table-striped table-borderless table-hover all-table">
                <button type="submit" class="add-btn">Export Report</button>
                <div class="float-right pr-3">
                    <div id="date_range" style="background: #fff; cursor: pointer; padding: 9px 18px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>

                <thead class="table-head">
                    <tr>
                        <th>Product Code</th>
                        <th>Customer</th>
                        <th>Salesman</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returns as $return)
                        <tr>
                            <td>{{ $return->pcode }}</td>
                            <td>{{ $return->firstname." ".$return->lastname }}</td>
                            <td>{{ $return->fname." ".$return->lname }}</td>
                            <td class="text-right">{{ $return->amount }}</td>
                            <td>{{ $return->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



@endsection
