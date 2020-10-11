@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Salary Payment</div>
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
<div class="section" > {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="#" id="addStaffPayment">+ Add Staff Payment</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('salaryPayment.report') }}" target="_blank">Export Staff Payment</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Pay ID</th>
                    <th>Staff ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($salaryPayment as $row)

                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->fname ." ". $row->lname }}</td>
                    <td>{{ $row->amount}}</td>
                    <td>{{ $row->date }}</td>
                    <td class="action-icon">
                        <a href="{{ route('salaryPayment.edit',$row->id) }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row->id }}" action="{{ route('salaryPayment.destroy',$row->id) }}">
                            @method('DELETE')
                            @csrf

                        </form>
                    </td>
                </tr>

            @endforeach
        </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

{{-- Add Staff Payment --}}
<div class="full-pg" id="fadeBg1"></div>
<div class="pos-sub-display emp-attendance" id="staffPaymentModel">

    <div class="pos-sub-display-title">
        <span class="title">Add Staff Payment</span>
        <button class="close-btn" id="closeBtn1"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{ route('salaryPayment.store') }}" novalidate>
            @csrf
            <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            {{-- <thead class="table-head">
                <tr>
                    <th>Staff Member's Name</th>
                    <th>Amount</th>
                </tr>
            </thead> --}}
            @foreach($employee as $row)
            <tbody>
                <tr>
                    <td>{{ $row['fname'] }} {{  $row['lname']  }}</td>
                    <input type="text" name="staffID[{{$row['id']}}]" class="form-control" value="{{$row['id']}}" hidden/>
                    <td><input type="text" id="empAmount" name="amount[{{$row['id']}}]" class="form-control" placeholder="Amount"/></td>
                </tr>
            </tbody>
            @endforeach
            </table>
            <div class="action-btn-row mt-4">

                <input type="submit" class="add-sub-btn" value="Submit" />

            </div>

        </form>
    </div>
</div>


<script>

$(document).ready(function() {
        $('#addStaffPayment').on('click', function() {
            $('#staffPaymentModel').toggleClass('block');
            $('#fadeBg1').toggleClass('block');
        });
        $('#closeBtn1').on('click', function() {
            $('#staffPaymentModel').removeClass('block');
            $('#fadeBg1').removeClass('block');
        });
    });
</script>
@endsection
