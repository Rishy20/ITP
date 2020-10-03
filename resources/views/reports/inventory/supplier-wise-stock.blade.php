@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('reports.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Supplier-wise Stock Report</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <a href="{{ route('reports.export-supplier-wise-stock') }}"
               target="_blank">
                <div class="add-btn">Export Report</div>
            </a>

            <thead class="table-head">
                <tr>
                    <th>Supplier Name</th>
                    <th>Company</th>
                    <th>Stock Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->company_name }}</td>
                        <td>{{ $supplier->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
