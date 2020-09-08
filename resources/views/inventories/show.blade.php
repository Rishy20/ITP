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
            <div class="add-btn">
                <a href="">Add Product</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventory_items as $inventory_item)
                    <tr>
                        <td>{{$inventory_item->product->name}}</td>
                        <td>{{$inventory_item->qty}}</td>
                        <td class="action-icon">
                            <a href=""><i class="fas fa-pen"></i></a>
                            <form method="POST" class="dlt-form" action="">
                                @method('DELETE')  {{-- Spoof form method as 'DELETE' to comply with destroy route --}}
                                @csrf
                                <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
