@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('stock-transfers.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Stock Transfer</div>
</div>

<livewire:stock-transfers.stock-transfer-form />

@endsection
