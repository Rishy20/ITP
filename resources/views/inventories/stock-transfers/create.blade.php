@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('stock-transfers.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Stock Transfer</div>
</div>

<div class="section">
    <div class="section-title">
        Transfer Information
        <hr>
    </div>
    <div class="section-content">
        <form method="post" action="">
            @csrf

            <livewire:stock-transfers.stock-transfer-form />

            <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
