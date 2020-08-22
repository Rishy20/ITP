@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('stock-transfers.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Stock Transfer</div>
</div>

<div class="section text-center">
    <i class="fas fa-exclamation-triangle fa-3x text-warning my-4"></i>
    <h4 class="font-weight-bold">Not Enough Inventories</h4>
    <p class="font-weight-lighter">At least 2 inventories are required for a stock transfer</p>
</div>

@endsection
