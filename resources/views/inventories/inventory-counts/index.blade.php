@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Inventory Counts</div>
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
            <a href="{{ route('inventory-counts.create') }}">
                <div class="add-btn">Add Inventory Count</div>
            </a>
            <thead class="table-head">
                <tr>
                    <th>Reference #</th>
                    <th>Outlet</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventory_counts as $inventory_count)
                    <tr>
                        <td>{{ $inventory_count->reference }}</td>
                        <td>{{ $inventory_count->outlet_name }}</td>
                        <td>
                            @if ($inventory_count->completed)
                                <span><i class="fa fa-check text-success"></i>
                                    &nbsp;Completed
                                </span>
                            @else
                                <span><i class="fa fa-circle" style="color: #058de9"></i>
                                    &nbsp;Ongoing</span>
                            @endif
                        </td>
                        <td>{{ $inventory_count->created_at }}</td>

                        <td class="action-icon">
                            @if (!$inventory_count->completed)
                                <a href="{{ route('inventory-counts.complete', $inventory_count) }}"><i class="fas fa-check"></i></a>
                                <a href="{{ route('inventory-counts.edit', $inventory_count) }}"><i class="fas fa-pen"></i></a>
                            @else
                                <i style="margin: 0 44px"></i>
                            @endif

                            <button type="submit" class="dlt-btn" id="dlt-btn{{ $inventory_count->id }}"><i class="fas fa-trash-alt"></i></button>
                            <form method="POST" class="dlt-form" id="dlt-form{{ $inventory_count->id }}" action="{{ route('inventory-counts.destroy', $inventory_count) }}">
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
