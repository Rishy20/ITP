@extends('layouts.main')
@section('content')

<div class="editUser"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route('employee.index',$employee->emp_id)}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Employee</div>
    </div>
   
        
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Employee Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" action="{{route('employee.update',$employee->emp_id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            
                            <div class="col">
                                <input type="text" id="fname" name="fname" class="form-control" value="{{ $employee->fname }}" placeholder="First Name" />
                                <label for="fname" class="float-label">First Name</label>
                            </div>
                            <div class="col">
                                <input type="text" id="lname" name="lname" class="form-control" value="{{ $employee->lname }}"placeholder="Last Name" />
                                <label for="lname" class="float-label">Last Name</label>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col">
                                <input type="text" id="nic" name="nic" class="form-control" value="{{ $employee->nic }}"placeholder=" NIC" />
                                <label for="nic" class="float-label">NIC</label>
                            </div>
                            <div class="col">
                                <input type="text" id="address" name="address" class="form-control" value="{{ $employee->address }}" placeholder="Address" />
                                <label for="address" class="float-label">Address</label>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col">
                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $employee->mobile }}"placeholder="Phone(Mobile)" />
                                <label for="mobile" class="float-label">Phone(Mobile)</label>
                            </div>
                            <div class="col">
                                <input type="text" id="home" name="home" class="form-control" value="{{ $employee->home }}"placeholder="Phone(Home)" />
                                <label for="home" class="float-label">Phone(Home) </label>
                            </div>
                        </div> 
            
                            <div class="row">
                            <div class="col">
                                <input type="date" id="birthday" name="birthday" class="form-control" value="{{ $employee->birthday }}"placeholder="Birthday" />
                                <label for="birthday" class="float-label">Birthday</label> 
                            </div>
                            <div class="col">
                                <input type="date" id="joined_date" name="joined_date" class="form-control" value="{{ $employee->joined_date }}"placeholder="Joined Date" />
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
                                <form method="post" action="{{route('employee.update',$employee->emp_id)}}">
            
                        <div class="row">
                            <div class="col">
                                <input type="text" id="target" name="target" class="form-control" value="{{ $employee->target }}"placeholder="Target" />
                                <label for="target" class="float-label">Target</label>
                            </div>
                            <div class="col">
                                <input type="text" id="salary" name="salary" class="form-control" value="{{ $employee->salary }}"placeholder="Salary" />
                                <label for="salary" class="float-label">Salary</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="salary_type" name="salary_type" class="form-control" value="{{ $employee->salary_type }}"placeholder="Salary Type" />
                                <label for="salary_type" class="float-label">Salary Type</label>
                            </div>
                            <div class="col">
                                <input type="text" id="commission" name="commission" class="form-control" value="{{ $employee->commission }}"placeholder="Commission" />
                                <label for="commission" class="float-label">Commission</label>
                            </div>
                        </div>

                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Change">
                            </div>
                        </div>
                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}
    
  
</div>{{-- End of addUser --}}
@endsection