@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Services</div>
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
                <a href="{{ route('service.report') }}" target="_blank">Export Service</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('service.create') }}">Add Service</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Service ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Return Date</th>
                    <th>Service Description</th>
                    <th>Cost</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($service as $s)
                <tr>
                   <td>{{ $s->id  }}</td>
                    <td>{{ $s->firstname .' '. $s->lastname}}</td>
                     <td>{{ $s->created_at}}</td>
                   <td>{{ $s->return_date }}</td>
                    <td>{{ $s->service_description }}</td>
                   <td>{{ $s->cost }}</td>
                    <td>{{ $s->username }}</td>
                      <td class="action-icon">
                        <a href="{{ route('service.edit',$s->id) }}"><i class="fas fa-pen"></i></a>
                        <button class="dlt-btn" id="dlt-btn{{ $s->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $s->id }}"  action="{{ route('service.destroy',$s->id) }}">
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
