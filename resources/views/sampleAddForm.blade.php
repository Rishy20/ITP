@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Enter the page heading</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Create Employees
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}
        <form method="post" action="{{ route('employee.store') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" />
                    <label for="fname" class="float-label">First Name</label>
                </div>
                <div class="col">
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" />
                    <label for="lname" class="float-label">Last Name</label>
                </div>
                <div class="col">
                    <input type="text" id="nic" name="nic" class="form-control" placeholder="Your NIC" />
                    <label for="nic" class="float-label">NIC</label>
                </div>
                <div class="col">
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" />
                    <label for="phone" class="float-label">Phone Number</label>
                </div>
                <div class="col">
                    <input type="text" id="birthday" name="birthday" class="form-control" placeholder="Birthday" />
                    <label for="birthday" class="float-label">Birthday</label>
                </div>
                <div class="col">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" />
                    <label for="address" class="float-label">Address</label>
                </div>
                <div class="col">
                    <input type="text" id="target" name="target" class="form-control" placeholder="Target" />
                    <label for="target" class="float-label">Target</label>
                </div>
                <div class="col">
                    <input type="text" id="salary" name="salary" class="form-control" placeholder="Salary" />
                    <label for="salary" class="float-label">Salary</label>
                </div>
                <div class="col">
                    <input type="text" id="salary_type" name="salary_type" class="form-control" placeholder="Salary Type" />
                    <label for="salary_type" class="float-label">Salary Type</label>
                </div>
                <div class="col">
                    <input type="text" id="commission" name="commission" class="form-control" placeholder="Commission" />
                    <label for="commission" class="float-label">Commission</label>
                </div>
                <div class="col">
                    <input type="text" id="joined_date" name="joined_date" class="form-control" placeholder="Joined Date" />
                    <label for="joined_date" class="float-label">Joined Date</label>
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
