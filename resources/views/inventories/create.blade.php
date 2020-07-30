@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('inventories.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Inventories</div>
</div>

<div class="section">
    <div class="section-title">
        Add Inventory
        <hr>
    </div>
    <div class="section-content">
        <form method="POST" action="{{ route('inventories.store') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Inventory name">
                    <label for="name" class="float-label">Inventory Name</label>
                </div>
                <div class="col">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Inventory address">
                    <label for="address" class="float-label">Inventory Address</label>
                </div>
            </div>
            <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
