@extends('layouts.main')
@section('content')
{
    <form method ="POST" action="{{action('BankAccountController@store')}}">
{{csrf_field()}}

 <br><br><br>
 
 <div class="form-group">
    <label>Exchange ID</label>
    <input type="text" class="form-control" name="exchangeID" id="exchangeID"  placeholder="Enter Exchange ID" required="required">
  </div>

  <div class="form-group">
    <label>Product ID</label>
    <input type="text" class="form-control" name="productID" id="productID" placeholder="Enter Product ID" required="required">
  </div>

  <div class="form-group">
    <label>Customer ID</label>
    <input type="text" class="form-control" name="customerID" id="customerID" placeholder="Enter Customer ID" required="required">
  </div>

  <div class="form-group">
    <label>Salesman ID</label>
    <input type="text" class="form-control" id="salesmanID" name="salesmanID" placeholder="Enter Salesman ID" required="required">
  </div>

  <div class="form-group">
    <label>Amount</label>
    <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required="required">
  </div>

  <div class="form-group">
    <label>Date</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date" required="required">
  </div>


  <button type="submit" name="submit" class="btn btn-primary " style="width:80%">Submit</button>

  </form>
}
@endsection