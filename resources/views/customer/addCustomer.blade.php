

@extends('layouts.main')
@section('content')

<div class="addCustomer"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route('customer.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Add Customer</div>
        <div class="demo-btn">
            Demo
        </div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
    Customer Details
        <hr>
    </div>

    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}

        <form method="post" class="needs-validation" action="{{route('customer.store')}}" novalidate>

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

<script>
    //Demo Button
    $(".demo-btn").click(function(){
        $("input[name='firstname']").val("Windy");
        $("input[name='lastname']").val("Perera");
        $("input[name='gender']").val("female");
        $("input[name='dob']").val(moment("1994-03-28").format("YYYY-MM-DD"));
        $("input[name='email']").val("wperera@gmail.com");
        $("input[name='phone']").val("0335642258");
        $("input[name='streetaddress']").val("1/57, Negombo road");
        $("input[name='city']").val("Giriulla");

    });

</script>

@endsection


