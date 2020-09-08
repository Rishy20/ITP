@extends('layouts.main')
@section('content')

<div class="addService"> {{-- Start of addService --}}
    <div class="pg-heading">
        <a href="{{ route('service.index') }}"<i class="fa fa-arrow-left pg-back"></i> </a>
        <div class="pg-title">Add Service</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Service Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" action="{{route('service.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" id="Customer ID" name="customer_id" class="form-control" placeholder="Customer ID" />
                                <label for="Customer ID" class="float-label">Customer ID</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="id" placeholder="Service ID">
                                <label class="float-label">Service ID</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="date" placeholder="Date">
                                <label class="float-label">Date</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="service_description" placeholder="Service Description">
                                <label class="float-label">Service Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="return_date" placeholder="Return Date">
                                <label class="float-label">Return Date</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="cost" placeholder="cost">
                                <label class="float-label">cost</label>
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
