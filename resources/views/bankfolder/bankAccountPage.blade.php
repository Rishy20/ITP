@extends('layouts.main')
@section('content')

<div class="addBank">
    <div class="pg-heading">
        <a href="{{ route('bank.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Create Bank Account</div>
        <div class="demo-btn">
            Demo
        </div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Bank Account Details
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}

    <form method ="POST" class="needs-validation"  action="{{action('BankAccountController@store')}}" novalidate>
{{csrf_field()}}

<div class="row">
                <div class="col">
                    <input type="text" id="number" name="number" class="form-control" placeholder="Account Number"  required/>
                    <label for="number" class="float-label">Account Number</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>

                <div class="col">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Account Holder's Name" required/>
                    <label for="name" class="float-label">Account Holder's Name</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col">
                    <input type="text" id="type" name="type" class="form-control" placeholder="Account Type" required/>
                    <label for="type" class="float-label">Account Type</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="bankname" name="bankname" class="form-control" placeholder="Bank Name" required/>
                    <label for="bankname" class="float-label">Bank Name</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                </div>

                <div class="row">

                <div class="col-md-6">
                    <input type="text" id="branchname" name="branchname" class="form-control" placeholder="Branch Name" required/>
                    <label for="branchname" class="float-label">Branch Name</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>

                </div>
                <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Submit">
                </div>
                </div>
                </div>
  </form>
  </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}



<script>

    //Demo Button

    $(".demo-btn").click(function(){
        $("input[name='number']").val("4567893");
        $("input[name='name']").val("Sithara");
        $("input[name='type']").val("fix");
        $("input[name='bankname']").val("HSBC");
        $("input[name='branchname']").val("Galle");

    });
</script>

@endsection
