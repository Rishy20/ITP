@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Inventory Count Summary</div>
</div>

<div class="section">
    <div class="section-title">
        {{ $inventory_count->reference }}
        <hr>
    </div>

    <div class="section-content">
        <div class="row">
            <div class="col-9 mx-auto">
                <table class="table table-sm">
                    <thead class="text-center table-dark">
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Expected Qty</th>
                            <th>Actual Qty</th>
                            <th>Difference</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($counted_items as $counted_item)
                        <tr>
                            <td>{{ $counted_item->product->pcode }}</td>
                            <td>{{ $counted_item->product->name }}</td>
                            <td class="text-right">{{ $counted_item->expected_qty }}</td>
                            <td class="text-right">{{ $counted_item->actual_qty }}</td>
                            <td class="text-right">{{ $counted_item->difference }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mx-auto">
                <p class="text-center text-black-50" style="font-size: 24px">
                    Replace expected quantities with actual quantities?
                </p>

                <a class="btn-submit" style="background: #058DE9"
                   href="{{ route('inventory-counts.replace', $inventory_count) }}">
                    Replace Quantities</a>
                <a class="btn-submit" style="background: grey; float:left" href="{{ route('inventory-counts.index') }}">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection
