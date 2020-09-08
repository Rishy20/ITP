@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Edit Exchange Details</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Exchange Information
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}


    <form method ="POST" class="needs-validation"  action="{{action('ExchangeController@update',$exchange->id)}}" novalidate>
{{csrf_field()}}

<div class="row">
                <div class="col">
  <label for="productID" class="float-label">Product ID</label>
  <div class="invalid-feedback">
    Please enter Product ID
</div>
    <input type="text" class="form-control" name="productID" id="productID" value="{{ $exchange->productID}}"  placeholder="Product ID" required/>
  </div>

  <div class="col">
  <label for="customerID" class="float-label">Customer ID</label>
  <div class="invalid-feedback">
    Please enter Customer ID
</div>
    <input type="text" class="form-control" name="customerID" id="customerID" value="{{ $exchange->customerID}}" placeholder="Customer ID" required/>
  </div>
  </div>

  <div class="row">
                <div class="col">
                <label for="salesmanID" class="float-label">Salesman ID</label>
                <div class="invalid-feedback">
                    Please enter Salesman ID
                </div>
    <input type="text" class="form-control" name="salesmanID" id="salesmanID" value="{{ $exchange->salesmanID}}" placeholder="Salesman ID" required/>
  </div>

  <div class="col">
  <label for="amount" class="float-label">Amount</label>
    <div class="invalid-feedback">
    Please enter Amount
    </div>
    <input type="text" class="form-control" id="amount" name="amount"  value="{{ $exchange->amount}}" placeholder="Amount" required/>
  </div>
  </div>

  <div class="row">

                <div class="col-md-6">
                <label for="date" class="float-label">Date</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ $exchange->date}}" placeholder="Date" required/>
  </div>
  </div>

{{method_field('PUT')}}
<div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Update">
                </div>
                </div>
                </div>
  </form>
       </div>
    </div>

}
@endsection
