@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('inventory-counts.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Inventory Count</div>
</div>

<livewire:inventory-counts.inventory-count-form />

@endsection
