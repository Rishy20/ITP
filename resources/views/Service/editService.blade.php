@extends('layouts.main')
@section('content')

<div class="editSService"> {{-- Start of editService --}}
    <div class="pg-heading">
        <a href="{{ route('service.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Service</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Service Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" class="needs-validation" action="{{route('service.update',$s->id)}}" novalidate>
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col">
                                <input type="text" id="Customer ID" value="{{ $s->customer_id }}" name="customer_id" class="form-control" placeholder="Customer ID" required/>
                                <label for="Customer ID" class="float-label">Customer ID</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $s->id }}" name="id" placeholder="Service ID" required>
                                <label class="float-label">Service ID</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $s->date }}"  name="date" placeholder="Date" required>
                                <label class="float-label">Date</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control"  value="{{ $s->service_description}}" name="service_description" placeholder="Service Description" required>
                                <label class="float-label">Service Description</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $s->return_date}}" name="return_date" placeholder="Return Date" required>
                                <label class="float-label">Return Date</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" value="{{ $s->cost}}" name="cost" placeholder="Cost" required>
                                <label class="float-label">Cost</label>
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
</div>{{-- End of editService --}}
@endsection
