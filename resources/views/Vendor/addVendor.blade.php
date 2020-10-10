@extends('layouts.main')
@section('content')

<div class="addVendor"> {{-- Start of addVendor --}}
    <div class="pg-heading">
        <a href="{{ route('vendors.index') }}"<i class="fa fa-arrow-left pg-back"></i> </a>
        <div class="pg-title">Add Vendor</div>
        <div class="demo-btn">
            Demo
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Vendor Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" class="needs-validation"   action="{{route('vendors.store')}}" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" id="First Name" name="first_name" class="form-control" placeholder="First Name" required/>
                                <label for="First Name" class="float-label">First Name</label>
                                <div class="invalid-feedback">
                                    Please enter the First Name
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                <label class="float-label">Last Name</label>
                                <div class="invalid-feedback">
                                    Please enter the Last name
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="address" placeholder="Vendor Address" required>
                                <label class="float-label">Vendor Address</label>
                                <div class="invalid-feedback">
                                    Please enter  Vendor Address
                                </div>

                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="email" placeholder="Email" required>
                                <label class="float-label">Email</label>
                                <div class="invalid-feedback">
                                    Please enter Email
                                </div>

                                </div>
                            </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name" required>
                                <label class="float-label">Company Name</label>
                                <div class="invalid-feedback">
                                    Please enter Company Name
                                </div>

                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" required>
                                <label class="float-label">Phone Number</label>
                                <div class="invalid-feedback">
                                    Please enter Phone Number
                                </div>

                            </div>
                        </div>
                        <div class="row" style="width: 53%">
                            <div class="col">
                                <input type="text" class="form-control" name="city" placeholder="City" required>
                                <label class="float-label">City</label>
                                <div class="invalid-feedback">
                                    Please enter City
                                </div>

                            </div>
                        </div>
                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Submit">
                            </div>
                        </div>
                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}
        </div>


                    </form>
                </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
</div>{{-- End of addVendor --}}
<script>
    //Demo Button
    $(".demo-btn").click(function(){
        $("input[name='username']").val("Rashmika");
        $("input[name='display_name']").val("Rashmika Dulaj");
        $("input[name='password']").val("admin1234");
        $("input[name='repass']").val("admin1234");
        $("input[name='pin']").val("1234");
        $("input[name='repin']").val("1234");
    });


</script>
@endsection


