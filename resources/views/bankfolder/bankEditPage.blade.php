@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('bank.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
    <div class="pg-title">Edit Bank Account Details</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Bank Account Information
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}


    <form method ="POST" class="needs-validation"  action="{{action('BankAccountController@update',$banks->id)}}">
{{csrf_field()}}

<div class="row">
                <div class="col">
    <input type="text" class="form-control" name="number" id="number" value="{{ $banks->number}}"  placeholder="Account Number" required/>
    <label for="number" class="float-label">Account Number</label>
    <div class="invalid-feedback">
        Please fill out field
    </div>
  </div>

  <div class="col">
    <input type="text" class="form-control" name="name" id="name" value="{{ $banks->name}}" placeholder="Account Holder's Name" required/>
    <label for="name" class="float-label">Account Holder's Name</label>
    <div class="invalid-feedback">
        Please fill out field
    </div>
  </div>
  </div>

  <div class="row">
                <div class="col">
    <input type="text" class="form-control" name="type" id="type" value="{{ $banks->type}}" placeholder="Account Type" required/>
    <label for="type" class="float-label">Account Type</label>
    <div class="invalid-feedback">
        Please fill out field
    </div>
  </div>

  <div class="col">
    <input type="text" class="form-control" id="bankname" name="bankname"  value="{{ $banks->bankname}}" placeholder="Bank Name" required/>
    <label for="bankname" class="float-label">Bank Name</label>
    <div class="invalid-feedback">
        Please fill out field
    </div>
  </div>
  </div>

  <div class="row">

                <div class="col-md-6">
    <input type="text" class="form-control" id="branchname" name="branchname" value="{{ $banks->branchname}}" placeholder="Branch Name" required/>
    <label for="branchname" class="float-label">Branch Name</label>
    <div class="invalid-feedback">
        Please fill out field
    </div>
  </div>
  </div>

{{method_field('PUT')}}
<div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Submit">
                </div>
                </div>
                </div>
  </form>
       </div>
    </div>

}
@endsection
