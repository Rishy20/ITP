@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('inventories.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Add Inventory</div>
    <div class="demo-btn">Demo</div>
</div>

<div class="section">
    <div class="section-title">
        Inventory Information
        <hr>
    </div>
    <div class="section-content">
        <form method="POST" class="needs-validation" action="{{ route('inventories.store') }}" novalidate>
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Inventory Name" required>
                    <label for="name" class="float-label">Inventory Name</label>
                    <div class="invalid-feedback">
                        Please enter a name
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Inventory Address" required>
                    <label for="address" class="float-label">Inventory Address</label>
                    <div class="invalid-feedback">
                        Please enter an address
                    </div>
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

<script>
    // JS for demo button
    $(".demo-btn").click(function(){
        $("input[name='name']").val("Warehouse 05");
        $("input[name='address']").val("Malabe, Colombo");
    });
</script>

@endsection
