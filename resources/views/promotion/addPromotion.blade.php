

@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Create Promotion</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
    Promotion Details
        <hr>
    </div>

    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}

        <form method="post" class="needs-validation"  action="{{route('promotion.store')}}" novalidate>

            @csrf

            <div class="row">
                <div class="col">
                <input type="text" class="form-control" name="promotionname" id="promotionname" placeholder="Promotion Name" required>
                    <label for="promotionname" class="float-label">Promotion Name</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
                <div class="col">
                <input type="text" class="form-control" name="promotiontype" id="promotiontype" placeholder="Promotion Type" required>
                    <label class="float-label">Promotion Type</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" required>
                    <label for="discount" class="float-label">Discount</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" name="startdate" id="startdate" placeholder="Start Date" required>
                        <label class="float-label">Start Date</label>
                        <div class="invalid-feedback">
                            Please fill out this field
                        </div>
                    </div>
                <div class="col">
                <input type="date" class="form-control" name="enddate" id="enddate" placeholder="End Date" required>
                    <label for="enddate" class="float-label">End Date</label>
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
