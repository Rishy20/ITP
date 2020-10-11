@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Vendors</div>
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
                <a href="{{ route('vendor.report') }}" target="_blank">Export Vendors</a>
                </div>
            <div class="add-btn">
               <a href="{{ route('vendors.create') }}"> Add Vendor </a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Vendor Name</th>
                    <th>Company Name</th>
                    <th>Contact</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendor as $v )


                <tr>
                    <td>{{ $v->first_name . " " . $v->last_name }}</td>
                    <td>{{ $v->company_name }}</td>
                    <td>{{ $v->phone_no }}</td>
                    <td>{{ $v->city }}</td>
                    <td>{{ $v->email }}</td>
                    <td class="action-icon">
                        <a href="{{ route('vendors.edit',$v->id) }}"><i class="fas fa-pen"></i></a>
                        <button class="dlt-btn" id="dlt-btn{{ $v->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $v->id }}" action="{{ route('vendors.destroy',$v->id) }}">
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
