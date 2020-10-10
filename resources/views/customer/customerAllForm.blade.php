@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Customer Details</div>
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
            <div class="add-btn"> {{-- Add button --}}
                <a href="{{ route('customer.create')}}">Add Customer</a> {{-- Enter the name of the add btn --}}
            </div>
            <thead class="table-head">
                <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Email</th>
                <th>Phone</th>

                <th>city</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cust as $row)
                <tr>
                <td> {{ $row->id }} </td>
                <td> {{ $row->firstname }} </td>
                <td> {{ $row->lastname }} </td>
                <td> {{ $row->gender }} </td>
                <td> {{ $row->dob }} </td>
                <td> {{ $row->email }} </td>
                <td> {{ $row->phone }} </td>
                <td> {{ $row->city }} </td>

                    <td class="action-icon">
                    <a href = "{{ route('customer.edit', $row->id)}}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row->id }}" action="{{route('customer.destroy',$row->id)}}">
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

@endsection
