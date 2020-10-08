@extends('layouts.main')
@section('content')

<div class="addService"> {{-- Start of addService --}}
    <div class="pg-heading">
        <a href="{{ route('service.index') }}"<i class="fa fa-arrow-left pg-back"></i> </a>
        <div class="pg-title">Add Service</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Service Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" class="needs-validation" action="{{route('service.store')}}" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" id="Customer ID" name="customer_id" class="form-control" placeholder="Customer ID" data-toggle="dropdown" required/>
                                <label for="Customer ID" class="float-label">Customer ID</label>
                                <ul class="dropdown-menu">
                                    <input class="form-control" id="cusSearch" type="text" placeholder="Search..">
                                    <li ><span class="sid">Hello</span><span class="sname">Rishard</span></li>
                                </ul>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>






                                  {{-- <label class="mdb-main-label">Label example</label> --}}
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="id" placeholder="Service ID" required>
                                <label class="float-label">Service ID</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="date" placeholder="Date" required>
                                <label class="float-label">Date</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="service_description" placeholder="Service Description" required>
                                <label class="float-label">Service Description</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="return_date" placeholder="Return Date" required>
                                <label class="float-label">Return Date</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="cost" placeholder="cost" required>
                                <label class="float-label">cost</label>
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
                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}
        </div>

                    </form>
                </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
</div>{{-- End of addService --}}



@endsection
