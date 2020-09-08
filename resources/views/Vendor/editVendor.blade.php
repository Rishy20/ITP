@extends('layouts.main')
@section('content')

<div class="editVendor"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <i class="fa fa-arrow-left pg-back"></i>
        <div class="pg-title">Edit Vendor</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Vendor Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" class="needs-validation"  action="{{route('vendors.update',$v->id)}}" novalidate>
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col">
                                <input type="text" id="First Name" value="{{ $v->first_name }}" name="first_name" class="form-control" placeholder="First Name" required/>
                                <label for="First Name" class="float-label">First Name</label>
                                <div class="invalid-feedback">
                                    Please enter First Name
                                </div>

                            </div>

                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->last_name }}" name="last_name" placeholder="Last Name" required>
                                <label class="float-label">Last Name</label>
                                <div class="invalid-feedback">
                                    Please enter Last name
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->address }}" name="address" placeholder="Vendor Address" required>
                                <label class="float-label">Vendor Address</label>
                                <div class="invalid-feedback">
                                    Please enter Vendor Address
                                </div>

                            </div>

                            <div class="col">
                                <input type="text" class="form-control"  value="{{ $v->city }}" name="email" placeholder="Email" required>
                                <label class="float-label">Email</label>
                                <div class="invalid-feedback">
                                    Please enter Email
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->company_name }}" name="company_name" placeholder="Company Name" required>
                                <label class="float-label">Company Name</label>
                                <div class="invalid-feedback">
                                    Please enter Company name
                                </div>

                            </div>

                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->phone_no }}" name="phone_no" placeholder="Phone Number" required>
                                <label class="float-label">Phone Number</label>
                                <div class="invalid-feedback">
                                    Please enter Phone Number
                                </div>

                            </div>
                        </div>
                        <div class="row" style="width: 53%">

                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->city }}" name="city" placeholder="City" required>
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
@endsection
