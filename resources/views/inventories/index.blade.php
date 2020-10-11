@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Inventories</div>
</div>
@if(session('message'))
<div class="message">
    <div class="message-success">
        <i class="far fa-check-circle message-icon"></i>
        <span class="message-text">Success!</span>
        <span class="message-text-sub">You're awesome!!!</span>

    </div>
</div>
{{ Session::forget('message') }}
@endif
<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <a href="{{ route('inventories.report') }}" target="_blank">
                <div class="add-btn">Export Inventories</div>
            </a>
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
                        <td class="font-weight-bold">
                            <a href="{{ route('inventories.show', $inventory) }}" style="color: #058DE9">{{ $inventory->name }}</a>
                        </td>
                        <td>{{ $inventory->address }}</td>
                        <td>{{ $inventory->qty }}</td>

                        <td class="action-icon">
                            <a href="{{ route('inventories.edit', $inventory) }}"><i class="fas fa-pen"></i></a>
                            <button type="submit" class="dlt-btn" id="dlt-btn{{ $inventory->id }}"><i class="fas fa-trash-alt"></i></button>
                            <form method="POST" class="dlt-form" id="dlt-form{{ $inventory->id }}" action="{{ route('inventories.destroy', $inventory) }}">
                                @method('DELETE')  {{-- Spoof form method as 'DELETE' to comply with destroy route --}}
                                @csrf

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
