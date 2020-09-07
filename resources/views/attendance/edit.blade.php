@extends('layouts.main')
@section('content')

<div class="editUser"> {{-- Start of addAttendance --}}
    <div class="pg-heading">
        <a href="{{ route('attendance.index',$attendance->id)}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Attendance</div>
    </div>
    <div class="row">
        <div class="col-md-9">

<div class="section"> {{-- Start of Section--}}
        <div class="section-title">
        Attendace Details
         <hr>
          </div>
         <div class="section-content"> {{-- Start of sectionContent--}}
            <form method="post" action="{{route('attendance.update',$attendance->id)}}"> {{-- Start of Form --}}
                @csrf
                 @method('PATCH')
          <div class="row">
              <div class="col">
             <input type="text" id="id" name="id" class="form-control" value="{{ $attendance->id }}" placeholder="Attendance ID" />
             <label for="id" class="float-label">Attendance ID</label>
                </div>
                <div class="col">
                    <input type="text" id="e_id" name="e_id" class="form-control" value="{{ $attendance->e_id }}"placeholder="Employee ID" />
                    <label for="e_id" class="float-label">Employee ID</label>
                </div>
           
            </div> 

            <div class="row">
                <div class="col">
                    <input type="text" id="attendance" name="attendance" class="form-control" value="{{ $attendance->attendance }}" placeholder="Attendance" />
                    <label for="attendance" class="float-label">Attendance</label>
                </div>
                <div class="col">
                    <input type="date" id="date" name="date" class="form-control" value="{{ $attendance->date }}" placeholder="Date" />
                    <label for="date" class="float-label">Date</label>
                </div>
           
            </div> 

            <div class="row">
                <div class="col">
                    <input type="text" id="in" name="in" class="form-control" value="{{ $attendance->in }}"placeholder="Arrival Time" />
                    <label for="in" class="float-label">Arrival Time</label>
                </div>
                <div class="col">
                    <input type="text" id="out" name="out" class="form-control" value="{{ $attendance->out}}"placeholder="Departure Time" />
                    <label for="out" class="float-label">Departure Time</label>
                </div>
            </div> 

                        
                <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Change">
            </div>
        </div>
    </div> {{-- End  of sectionContent--}}
    </div> {{-- End  of section 1--}}
</div>
</div>{{-- End of addAttendance --}}
@endsection