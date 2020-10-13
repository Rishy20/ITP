@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Loyalty</div>
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
            <div class="add-btn">
                <a href="{{ route('loyalty.create') }}">Add Loyalty</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('loyalty.report') }}" target="_blank">Export Loyalty</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Loyalty Name</th>
                    <th>Minimum Points</th>
                    <th>Minimum Spend</th>
                    <th>No. of Customers</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($loyalty as $row)
            <tbody>
                <tr>
                    <td>{{ $row->loyaltyName}}</td>
                    <td>{{ $row->minimumPointRequired }}</td>
                    <td>{{ $row->tierPoints }}</td>
                    <td> {{$row->count}} </td>
                    <td class="action-icon">
                        <a href="{{ route('loyalty.edit',$row->id) }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row->id }}" action="{{ route('loyalty.destroy',$row->id )}}">
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
