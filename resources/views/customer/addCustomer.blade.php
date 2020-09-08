

@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Create Customer</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
    Customer Details
        <hr>
    </div>

    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}

        <form method="post" class="needs-validation"  action="{{route('customer.store')}}" novalidate>

            @csrf

            <div class="row">
                <div class="col">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
                    <label for="firstname" class="float-label">First Name</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                <div class="col">
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" required>
                    <label class="float-label">Last name</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender" required>
                    <label for="gender" class="float-label">Gender</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                <div class="col">
                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date Of Birth" required>
                    <label class="float-label">Date Of Birth</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <input type="text" class="form-control" name="email" id="email" placeholder="name@gmail.com" required>
                    <label for="email" class="float-label">Email</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                <div class="col">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                    <label class="float-label">Phone</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <input type="text" class="form-control" name="streetaddress" id="streetaddress" placeholder="Street Address" required>
                    <label for="streetaddress" class="float-label">Street Address</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                <div class="col">
                <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city" required>
                    <label class="float-label">City</label>
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
        {{-- End of Form --}}
    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection

{{--
    Important points to consider
    * The labels should be below the input box
    * All the input boxes should have a placeholder
    * The class name of the label should be "float-label"
    * The class name of the submit button should be "btn-submit"
    * The row containing the submit button should have a class of submit-row
--}}
