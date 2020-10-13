@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Promotion Details</div>
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
                <a href="{{ route('promotion.create')}}">Add Promotion</a> {{-- Enter the name of the add btn --}}
            </div>
            {{-- <div class="add-btn">
                <a href="{{ route('voucher.report') }}" target="_blank">Export Promotions</a>
                </div> --}}
            <thead class="table-head">
                <tr>
                <th>ID</th>
                <th>Promotion Name</th>
                <th>Promotion Type</th>
                <th>Discount Type</th>
                <th>Discount</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>

                </tr>
            </thead>
            <tbody>
            @foreach($prms as $row)
                <tr>
                <td> {{ $row->id }} </td>
                <td> {{ $row->promotionname }} </td>
                <td> {{ $row->promotiontype }} </td>
                <td> {{ $row->discounttype }} </td>
                <td> {{ $row->discount }} </td>
                <td> {{ $row->startdate }} </td>
                <td> {{ $row->enddate }} </td>

                    <td class="action-icon">
                    <a href = "{{ route('promotion.edit', $row->id)}}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row->id }}" action="{{route('promotion.destroy',$row->id)}}">
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
