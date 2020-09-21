@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">Attendance</div>
</div>
@if(session('message'))
<div class="message">
    <div class="message-success">
        <i class="far fa-check-circle message-icon"></i>
        <span class="message-text">Success!</span>
        <span class="message-text-sub">You're awesome!!!</span>

    </div>
</div>
{{ Session::forget('message') }}
@endif

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn" >
                <a href="#"  id="staffOut">Staff Out</a>
            </div>
            <div class="add-btn"  >
                <a href="#" id="staffIn">Staff In</a>
            </div>
            <thead class="table-head">
                <tr>

                    <th>Employee</th>
                    <th>Attendance</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendance as $att)


                <tr>

                    <td>{{ $att->eid ." - ".$att->fname." ".$att->lname}}</td>
                    <td>
                        @if ($att->in)
                            Present
                        @else
                            Absent
                        @endif
                    </td>
                    <td>{{ $att->created_at }}</td>
                    <td>{{ $att->in }}</td>
                    <td>{{ $att->out }}</td>

                    @if ($att->in)
                    <td class="action-icon">
                        <a onclick="editAttendance({{ $att->id }})" ><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $att->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $att->id }}" action="{{ route('attendance.destroy',$att->id) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                    @endif
                </tr>
                 </tbody>
                 @endforeach
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

{{-- Staff In Attendance --}}
<div class="full-pg" id="fadeBg1"></div>
<div class="pos-sub-display emp-attendance" id="staffInModel">

    <div class="pos-sub-display-title">
        <span class="title">Staff In</span>
        <button class="close-btn" id="closeBtn1"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{route('attendance.store')}}" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Arrival Time
                    </h6>
                </div>
                <div class="col-md-8">
                    @php
                        date_default_timezone_set('Asia/Colombo');
                    @endphp
                    <input type="time" name="arrival" class="form-control " value="{{ date('H:i') }}" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-3">
                        Select Employees
                    </h6>
                </div>
                <div class="col-md-8">
                    @foreach($employee as $e)
                    <div class="form-check permission-check emp-check">
                        <input name="emp[{{ $e->id }}]" class="form-check-input" type="checkbox" value="1" id="emp_name_{{ $e->id }}">
                        <label class="form-check-label" for="emp_name_{{ $e->id }}">
                            {{ $e->fname." ".$e->lname }}
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="action-btn-row mt-4">

                <input type="submit" class="add-sub-btn" value="Mark" />

            </div>
        </form>
    </div>
</div>

{{-- End of Staff In Attendance --}}

{{-- Staff Out Attendance --}}
<div class="full-pg" id="fadeBg2"></div>
<div class="pos-sub-display emp-attendance" id="staffOutModel">

    <div class="pos-sub-display-title">
        <span class="title">Staff Out</span>
        <button class="close-btn" id="closeBtn2"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{route('attendance.markout')}}" novalidate>
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Time
                    </h6>
                </div>
                <div class="col-md-8">
                    @php
                        date_default_timezone_set('Asia/Colombo');
                    @endphp
                    <input type="time" name="time" class="form-control " value="{{ date('H:i') }}" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-3">
                        Select Employees
                    </h6>
                </div>
                <div class="col-md-8">
                    @foreach($employee as $e)
                    <div class="form-check permission-check emp-check">
                        <input name="emp[{{ $e->id }}]" class="form-check-input" type="checkbox" value="1" id="emp_name_{{ $e->id }}">
                        <label class="form-check-label" for="emp_name_{{ $e->id }}">
                            {{ $e->fname." ".$e->lname }}
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="action-btn-row mt-4">

                <input type="submit" class="add-sub-btn" value="Mark" />

            </div>
        </form>
    </div>
</div>

{{-- End of Staff Out Attendance --}}

{{-- Edit Attendance --}}
<div class="full-pg" id="fadeBg3"></div>
<div class="pos-sub-display emp-attendance"  id="editAttendance">

    <div class="pos-sub-display-title">
        <span class="title">Edit Attendance</span>
        <button class="close-btn" id="closeBtn3"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{route('attendance.updateAttendance')}}" novalidate>
            @csrf
            @method('patch')
            @php
            date_default_timezone_set('Asia/Colombo');
        @endphp
            <div class="row mb-3" >
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Name
                    </h6>
                </div>
                <div class="col-md-8">
                    <input type="text" name="emp_name" id="empName" class="form-control " readonly/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Time In
                    </h6>
                </div>
                <div class="col-md-8">
                    <input type="time" name="in_edit" id="timeIn" class="form-control " value="{{ date('H:i') }}" required/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Time Out
                    </h6>
                </div>
                <div class="col-md-8">

                    <input type="time" name="out_edit" id="timeOut" class="form-control " value="{{ date('H:i') }}" required/>
                </div>
            </div>
            <input type="text" name="id" id="editId" hidden/>
            <div class="action-btn-row mt-4">

                <input type="submit" class="add-sub-btn" value="Mark" />

            </div>
        </form>
    </div>
</div>

{{-- End of Edit Attendance --}}
<script>
    //Expense Model
    $(document).ready(function() {
        $('#staffIn').on('click', function() {
            $('#staffInModel').toggleClass('block');
            $('#fadeBg1').toggleClass('block');
        });
        $('#closeBtn1').on('click', function() {
            $('#staffInModel').removeClass('block');
            $('#fadeBg1').removeClass('block');
        });

        $('#staffOut').on('click', function() {
            $('#staffOutModel').toggleClass('block');
            $('#fadeBg2').toggleClass('block');
        });
        $('#closeBtn2').on('click', function() {
            $('#staffOutModel').removeClass('block');
            $('#fadeBg2').removeClass('block');
        });
        $('#closeBtn3').on('click', function() {
            $('#editAttendance').removeClass('block');
            $('#fadeBg3').removeClass('block');
        });
    });

    function editAttendance(id){
        $('#editAttendance').toggleClass('block');
        $('#fadeBg3').toggleClass('block');

        var complex = <?php echo json_encode($attendance); ?>;

        complex.forEach(myFunction);

        function myFunction(index,value,array){

            if(array[value]['id'] == id){
                $('#empName').val(array[value]['fname'] + " " + array[value]['lname']);
                $('#timeIn').val(array[value]['in']);
                $('#timeOut').val(array[value]['out']);
                $('#editId').val(array[value]['id']);
            }
        }
    }
</script>
@endsection
