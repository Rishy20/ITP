@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Returns</div>


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
                <a href="{{ route('return.report') }}" target="_blank">Export Returns</a>
            </div>
            <div class="add-btn"> {{-- Add button --}}
                <a href="{{ route('return.create') }}">Create Return</a> {{-- Enter the name of the add btn --}}
            </div>
            <thead class="table-head">

                <tr>
                    <th>Return No.</th>
                    <th style="max-width: 600px; width: 600px">Remarks</th>
                    <th>Vendor</th>
                    <th>Date</th>
                    <th>Action</th
                </tr>
            </thead>
            <tbody>
                @foreach($returns as $i)
                <tr >

                    <td onclick="window.location='{{route("return.show",$i->id)}}';">{{$i->id}}</td>
                    <td onclick="window.location='{{route("return.show",$i->id)}}';">{{$i->remarks}}</td>
                    <td onclick="window.location='{{route("return.show",$i->id)}}';">{{$i->first_name .' '.$i->last_name}}</td>
                    <td onclick="window.location='{{route("return.show",$i->id)}}';">{{$i->date}}</td>
                    <td class="action-icon">
                        <a href="{{route('return.edit',$i->id)}}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $i->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $i->id }}" action="{{ route('return.destroy',$i->id)}}">
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
