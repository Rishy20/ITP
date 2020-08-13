@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Add Employees</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Employees Details
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}
        
        <form method="post" action=" {{route('employee.store')}}">
            {{-- route('employees.store') --}}
            @csrf 
           {{--  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            <div class="row">
                <div class="col">
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" />
                    <label for="fname" class="float-label">First Name</label>
                </div>
                <div class="col">
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" />
                    <label for="lname" class="float-label">Last Name</label>
                </div>
            </div>
                <div class="row">
                <div class="col">
                    <input type="text" id="nic" name="nic" class="form-control" placeholder=" NIC" />
                    <label for="nic" class="float-label">NIC</label>
                </div>
                <div class="col">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" />
                    <label for="address" class="float-label">Address</label>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Phone(Mobile)" />
                    <label for="mobile" class="float-label">Phone(Mobile)</label>
                </div>
                <div class="col">
                    <input type="text" id="home" name="home" class="form-control" placeholder="Phone(Home)" />
                    <label for="home" class="float-label">Phone(Home) </label>
                </div>
            </div> 

                <div class="row">
                <div class="col">
                    <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Birthday" />
                    <label for="birthday" class="float-label">Birthday</label> 
                </div>
                <div class="col">
                    <input type="date" id="joined_date" name="joined_date" class="form-control" placeholder="Joined Date" />
                    <label for="joined_date" class="float-label">Joined Date</label>
                </div>
            </div> 
        </div>
</div>
            <div class="section"> {{-- Start of Section--}}
                <div class="section-title">
                    Salary Details
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    {{-- Start of Form --}}
                    <form method="post" action=" {{route('employee.store')}}">
                        @csrf 
            <div class="row">
                <div class="col">
                    <input type="text" id="target" name="target" class="form-control" placeholder="Target" />
                    <label for="target" class="float-label">Target</label>
                </div>
                <div class="col">
                    <input type="text" id="salary" name="salary" class="form-control" placeholder="Salary" />
                    <label for="salary" class="float-label">Salary</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" id="salary_type" name="salary_type" class="form-control" placeholder="Salary Type" />
                    <label for="salary_type" class="float-label">Salary Type</label>
                </div>
                <div class="col">
                    <input type="text" id="commission" name="commission" class="form-control" placeholder="Commission" />
                    <label for="commission" class="float-label">Commission</label>
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
