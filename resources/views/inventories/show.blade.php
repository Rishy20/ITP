@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('inventories.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">{{$inventory->name}}</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <thead class="table-head">
                <tr>
                    <th class="col-8">Item</th>
                    <th class="col-4">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventory_items as $inventory_item)
                    <tr>
                        <td>{{$inventory_item->product->name}}</td>
                        <td>{{$inventory_item->qty}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
