@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Mark Attendance</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Attendance Information
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}

        <form method="post"  action=" {{route('attendance.store')}}">

            @csrf
           {{--  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            <div class="row">
                {{-- <div class="col">
                    <input type="text" id="id" name="id" class="form-control" placeholder="Attendance ID" />
                    <label for="id" class="float-label">Attendance ID</label>
                </div> --}}
                <div class="col">
                    <input type="text" id="e_id" name="e_id" class="form-control" placeholder="Employee ID" />
                    <label for="e_id" class="float-label">Employee ID</label>
                </div>
                <div class="col">
                    <input type="date" id="date" name="date" class="form-control" placeholder="Date" />
                    <label for="date" class="float-label">Date</label>
                </div>


            </div>


            <div class="row">
                <div class="col">
                    <input type="text" id="in" name="in" class="form-control" placeholder="Arrival Time" />
                    <label for="in" class="float-label">Arrival Time</label>
                </div>
                <div class="col">
                    <input type="text" id="out" name="out" class="form-control" placeholder="Departure Time" />
                    <label for="out" class="float-label">Departure Time</label>
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
