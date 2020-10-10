@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('employee.index') }}"><i class="fa fa-arrow-left pg-back"></i></a>
    <div class="pg-title">Add Employees</div>
    <div class="demo-btn">
            Demo
        </div>
</div>

<form method="post" class="needs-validation" action=" {{route('employee.store')}}" novalidate>
<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Employees Details
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}


            {{-- route('employees.store') --}}
            @csrf
           {{--  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            <div class="row">
                <div class="col">
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required/>
                    <label for="fname" class="float-label">First Name</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" required/>
                    <label for="lname" class="float-label">Last Name</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col">
                    <input type="text" id="nic" name="nic" class="form-control" placeholder=" NIC" required/>
                    <label for="nic" class="float-label">NIC</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" required/>
                    <label for="address" class="float-label">Address</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Phone(Mobile)" required/>
                    <label for="mobile" class="float-label">Phone(Mobile)</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="home" name="home" class="form-control" placeholder="Phone(Home)" required/>
                    <label for="home" class="float-label">Phone(Home) </label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
            </div>

                <div class="row">
                <div class="col">
                    <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Birthday" required/>
                    <label for="birthday" class="float-label">Birthday</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
                <div class="col">
                    <input type="date" id="joined_date" name="joined_date" class="form-control" placeholder="Joined Date" required/>
                    <label for="joined_date" class="float-label">Joined Date</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
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
            <div class="row">
                <div class="col">
                    <input type="text"  name="target" class="form-control" placeholder="Target" required/>
                    <label for="target" class="float-label">Target</label>
                    <div class="invalid-feedback">
                        Please fill the field
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="salary" name="salary" class="form-control" placeholder="Salary" required/>
                    <label for="salary" class="float-label">Salary</label>
                    <div class="invalid-feedback">
                        Please fill this field
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="form-group">
                        {{-- <label class="br-label">Salary Type</label> --}}
                        <select class="form-control br-select"  name="salary_type" required>
                            <option value="" disabled selected hidden>Salary Type</option>

                            <option value="Daily">Daily</option>
                            <option value="Monthly">Monthly</option>

                        </select>
                        <div class="invalid-feedback">
                            Please select a type
                        </div>
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="commission" name="commission" class="form-control" placeholder="Commission" required/>
                    <label for="commission" class="float-label">Commission</label>
                    <div class="invalid-feedback">
                        Please fill this field
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
        $("input[name='fname']").val("Jayani");
        $("input[name='lname']").val("Wickramathilaka");
        $("input[name='nic']").val("985830460V");
        $("input[name='address']").val("Kurunegala");
        $("input[name='mobile']").val("0715647700");
        $("input[name='home']").val("0372278970");
        //$("input[name='birthday']").val(getDate());
        $("input[name='joined_date']").val("25/05/2015");
        $("input[name='target']").val("50 sales");
        $("input[name='salary']").val("1500.00");
        $("input[name='salary_type']").val("daily");
        $("input[name='commission']").val("0.5");
    });












 </script>

@endsection
