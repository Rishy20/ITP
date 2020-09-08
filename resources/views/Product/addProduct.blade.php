@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Add Products</div>
</div>



        @livewire('add-product', ['inv' => $inv, 'cat' => $cat, 'brand' => $brand, 'vendor' => $vendor])


@endsection

