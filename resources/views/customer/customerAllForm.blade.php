@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Enter the Page heading here</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn"> {{-- Add button --}}
                <a href="{{ route() }}">Add User</a> {{-- Enter the name of the add btn --}}
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
                <th>Street Address</th>
                <th>City</th>
                <th>EDIT</th>
                <th>DELETE</th>
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
                <td> {{ $row->streetaddress }} </td>
                <td> {{ $row->city }} </td>
                    <td>
                        {{-- Start of toggle switch --}}
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                        {{-- End of toggle switch --}}
                    </td>
                    <td class="action-icon">
                    <a href = "{{action('CustomerController@edit', $row['id'])}}" class="btn btn-success"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <form method="POST" class="dlt-form" action="{{ action('CustomerController@destroy' , $row['id'])}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
