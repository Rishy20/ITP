@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="#">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Inventories</div>
</div>

<div class="section">

    <div class="section-content">

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <a href="{{ route('inventories.create') }}">
                <div class="add-btn">Add Inventory</div>
            </a>
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{$inventory->name}}</td>
                        <td>{{$inventory->address}}</td>

                        <td class="action-icon">
                            <a href="{{ route('inventories.edit', $inventory) }}"><i class="fas fa-pen"></i></a>
                            <a href=""><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
