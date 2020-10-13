@extends('layouts.main')
@section('content')

<div class="pg-heading">
  <a href="{{ route('vendorPayment.index') }}"><i class="fa fa-arrow-left pg-back"></i></a>
  <div class="pg-title">Vendor Payment</div>
  <div class="demo-btn">
    Demo
</div>
</div>

<div class="section" > {{-- Start of Section--}}
  <div class="section-title">
      Payment for Vendor's
      <hr>
  </div>
  <div class="section-content" > {{-- Start of sectionContent--}}
      {{-- Start of Form --}}

    <form method="post" class="needs-validation" action="{{ route('vendorPayment.store') }}" novalidate>
              @csrf
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label class="sup-label">Vendor Name</label>
                    <select class="form-control sup-select" name="vendorID" required>
                        <option value="" disabled selected hidden>Select a Vendor</option>
                        @foreach($vendor as $v)
                        <option value="{{$v->id}}">{{$v->first_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                  <div class="col">
                    <div class="form-group">
                      <label class="sup-label">Payment Type</label>
                      <select class="form-control sup-select" name="paymentType" id="paymentType" required>
                          <option value="" disabled selected hidden>Select a Payment Type</option>
                          <option value="Cash" >Cash</option>
                          <option value="Bank" >Bank</option>
                          <option value="Cheque" >Cheque</option>
                      </select>
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group" id="bankDetails">
                    <label class="sup-label">Bank Details</label>
                    <select class="form-control sup-select" name="bankID" >
                        <option value="" disabled selected hidden>Select a Bank</option>
                        @foreach($banks as $b)
                        <option value="{{$b->id}}">{{$b->bankname}} - Holder name : {{ $b->name }} - Acc. No. : {{ $b->number }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col"></div>
              </div>

              <div class="row">
                <div class="col">
                  <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" required/>
                  <label for="paymentId" class="float-label">Amount</label>
                  <div class="invalid-feedback">
                    Please fill out this field
                  </div>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="date" placeholder="Date" required>
                    <label class="float-label">Date</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
              </div>


              <div class="row submit-row">
                  <div class="col">
                      <input class="btn-submit" type="submit" value="Save">
                  </div>
              </div>


          </form>


        </div> {{-- End  of sectionContent--}}
      </div> {{-- End  of section--}}

<script>

$(".demo-btn").click(function(){
        $("input[name='vendorID']").val("Ayesh");
        $("input[name='paymentType']").val("cash");
        $("input[name='amount']").val("10000");
    });


$(document).ready(function(){
  $('#paymentType').on('change', function(){

    if(this.value == 'Bank'){
      $("#bankDetails").show();
    }
    else{
      $("#bankDetails").hide();
    }
  }).trigger("change");
});

</script>
@endsection
