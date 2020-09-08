@extends('layouts.main')
@section('content')


<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Create Return</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Return Details
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
    <form method ="POST" class="needs-validation"  action="{{action('ExchangeController@store')}}">
{{csrf_field()}}


<div class="row">
                <div class="col">
                    <input type="text" id="productID" name="productID" class="form-control" placeholder="Product ID" required/>
                    <div class="invalid-feedback">
                        Please fill out field
                    </div>


                </div>

                <div class="col">
                    <input type="text" id="customerID" name="customerID" class="form-control" placeholder="Customer ID" required />
                    <div class="invalid-feedback">
                        Please fill out field
                    </div>

                </div>
                </div>
                <div class="row">
                <div class="col">
                    <input type="text" id="salesmanID" name="salesmanID" class="form-control" placeholder="Salesman ID" required />
                    <div class="invalid-feedback">
                        Please fill out field
                    </div>

                </div>
                <div class="col">
                    <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount" required/>
                    <div class="invalid-feedback">
                        Please fill out field
                    </div>

                </div>
                </div>

                <div class="row">

                <div class="col-md-6">
                    <input type="date" id="date" name="date" class="form-control" placeholder="Date" required/>
                    <div class="invalid-feedback">
                        Please fill out field
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

}
@endsection
