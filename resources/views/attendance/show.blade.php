@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">Attendance</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('attendance.create') }}">Add Attendance</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Attendance ID</th>
                    <th>Employee ID</th>
                    <th>Attendance</th>
                    <th>Date</th>
                    <th>Arrival Time</th>
                    <th>departure Time</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($attendance as $att)


                <tr>
                    <td>{{ $att->id }}</td>
                    <td>{{ $att->e_id }}</td>
                    <td>{{ $att->attendance }}</td>
                    <td>{{ $att->date }}</td>
                    <td>{{ $att->in }}</td>
                    <td>{{ $att->out }}</td>
                    
                    <td class="action-icon">
                        <a href="{{ route('attendance.edit',$att->id) }}"><i class="fas fa-pen"></i></a>
                        <form method="POST" class="dlt-form" action="{{ route('attendance.destroy',$att->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                 </tbody>
                 @endforeach
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection