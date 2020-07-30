@extends('layouts.main')
@section('content')
    {


    <div class="container">
       <div class="jumbotron">

    <form method ="POST" action="{{action('BankAccountController@update',$banks->id)}}">
{{csrf_field()}}

  <div class="form-group">
    <label>Account Number</label>
    <input type="text" class="form-control" name="number" id="number" value="{{ $banks->number}}" aria-describedby="emailHelp" placeholder="Enter Account Number">
  </div>

  <div class="form-group">
    <label>Account Name</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $banks->name}}" placeholder="Enter Account Name">
  </div>

  <div class="form-group">
    <label>Account Type</label>
    <input type="text" class="form-control" name="type" id="type" value="{{ $banks->type}}" placeholder="Enter Account Type">
  </div>

  <div class="form-group">
    <label>Bank Name</label>
    <input type="text" class="form-control" id="bankname" name="bankname"  value="{{ $banks->bankname}}" placeholder="Enter Bank Name">
  </div>

  <div class="form-group">
    <label>Branch Name</label>
    <input type="text" class="form-control" id="branchname" name="branchname" value="{{ $banks->branchname}}" placeholder="Enter Branch Name">
  </div>

{{method_field('PUT')}}
  <button type="submit" name="submit" class="btn btn-primary " style="width:80%">Update</button>

  </form>
       </div>
    </div>

}
@endsection
