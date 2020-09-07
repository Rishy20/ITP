@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Inventory Counts</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <a href="{{ route('inventory-counts.create') }}">
                <div class="add-btn">Add Inventory Count</div>
            </a>
            <thead class="table-head">
                <tr>
                    <th>Reference #</th>
                    <th>Outlet</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventory_counts as $inventory_count)
                    <tr>
                        <td>{{ $inventory_count->reference }}</td>
                        <td>{{ $inventory_count->outlet_name }}</td>
                        <td>{{ $inventory_count->status }}</td>

                        <td class="action-icon">
                            <a href="{{ route('inventory-counts.edit', $inventory_count) }}"><i class="fas fa-pen"></i></a>
                            <form method="POST" class="dlt-form" action="{{ route('inventory-counts.destroy', $inventory_count) }}">
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
