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

                    <td>{{ $att->e_id ." - ".$att->fname." ".$att->lname}}</td>
                    <td>Present</td>
                    <td>{{ $att->date }}</td>
                    <td>{{ $att->in }}</td>
                    <td>{{ $att->out }}</td>

                    <td class="action-icon">
                        <a href="{{ route('attendance.edit',$att->id) }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" action="{{ route('attendance.destroy',$att->id) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
                 </tbody>
                 @endforeach
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
