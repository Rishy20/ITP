@extends('layouts.main')
@section('content')

<div class="editCustomer"> 
    <div class="pg-heading">
        <a href="{{ route('customer.index',$cust->id)}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Customer</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Customer Details
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" action="{{route('customer.update',$cust->id)}}">
                        @csrf
                        @method('PATCH')


                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="firstname" id="firstname" value="{{$cust->firstname }}" placeholder="First Name">
                                <label for="firstname" class="float-label">First Name</label>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $cust->lastname }}" placeholder="Last name">
                                <label class="float-label">Last name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="gender" id="gender" value="{{ $cust->gender }}" placeholder="Gender">
                                <label for="gender" class="float-label">Gender</label>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" name="dob" id="dob" value="{{ $cust->dob }}" placeholder="Date Of Birth">
                                <label class="float-label">Date Of Birth</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="email" id="email" value="{{ $cust->email }}" placeholder="name@gmail.com">
                                <label for="email" class="float-label">Email</label>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $cust->phone }}" placeholder="Phone">
                                <label class="float-label">Phone</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="streetaddress" id="streetaddress" value="{{ $cust->streetaddress }}" placeholder="Street Address">
                                <label for="streetaddress" class="float-label">Street Address</label>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" name="city" id="city" value="{{ $cust->city }}" placeholder="City">
                                <label class="float-label">City</label>
                            </div>
                        </div>
                        {{method_field('PUT')}}

                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Update">
                            </div>
                        </div>
                    </form>
            

     </div>
</div>
@endsection