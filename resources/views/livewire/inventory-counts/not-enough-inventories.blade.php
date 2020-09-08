@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('inventory-counts.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Inventory Count</div>
</div>

<div class="section text-center">
    <i class="fas fa-exclamation-triangle fa-3x text-warning my-4"></i>
    <h4 class="font-weight-bold">Not Enough Inventories</h4>
    <p class="font-weight-lighter">At least 1 inventory is required for an inventory count</p>
</div>

@endsection
