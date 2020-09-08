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
                    <form method="post" action="{{route('vendors.update',$v->id)}}">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col">
                                <input type="text" id="First Name" value="{{ $v->first_name }}" name="first_name" class="form-control" placeholder="First Name" />
                                <label for="First Name" class="float-label">First Name</label>
                            </div>

                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->last_name }}" name="last_name" placeholder="Last Name">
                                <label class="float-label">Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->address }}" name="address" placeholder="Vendor Address">
                                <label class="float-label">Vendor Address</label>
                            </div>

                            <div class="col">
                                <input type="text" class="form-control"  value="{{ $v->city }}" name="email" placeholder="Email">
                                <label class="float-label">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->company_name }}" name="company_name" placeholder="Company Name">
                                <label class="float-label">Company Name</label>
                            </div>

                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->phone_no }}" name="phone_no" placeholder="Phone Number">
                                <label class="float-label">Phone Number</label>
                            </div>
                        </div>
                        <div class="row" style="width: 53%">

                            <div class="col">
                                <input type="text" class="form-control" value="{{ $v->city }}" name="city" placeholder="City">
                                <label class="float-label">City</label>
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
