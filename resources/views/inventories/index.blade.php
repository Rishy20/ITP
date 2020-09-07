@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Inventories</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <a href="{{ route('inventory-counts.index') }}">
                <div class="add-btn">Inventory Counts</div>
            </a>
            <a href="{{ route('stock-transfers.index') }}">
                <div class="add-btn">Stock Transfers</div>
            </a>
            <a href="{{ route('inventories.create') }}">
                <div class="add-btn">Add Inventory</div>
            </a>
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>
                            <a href="{{ route('inventories.show', $inventory) }}" style="color: #058DE9">{{ $inventory->name }}</a>
                        </td>
                        <td>{{ $inventory->address }}</td>
                        <td>{{ $inventory->qty }}</td>

                        <td class="action-icon">
                            <a href="{{ route('inventories.edit', $inventory) }}"><i class="fas fa-pen"></i></a>
                            <form method="POST" class="dlt-form" action="{{ route('inventories.destroy', $inventory) }}">
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
