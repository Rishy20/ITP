@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">All Payment</div>
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
    <div class="section-title">
        Payment for Vendor's
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('vendorPayment.create') }}">+ Add Vendor Payment</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('vendorPayment.report') }}" target="_blank">Export Loyalty</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Payment ID</th>
                    <th>Payment Type</th>
                    <th>Vendor ID</th>
                    <th>Bank ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($vendorPayment as $row)
            <tbody>
                <tr>
                    <td>{{ $row['id'] }}</td>
                    <td>{{ $row['paymentType'] }}</td>
                    <td>{{ $row['vendorID'] }}</td>
                    <td>{{ $row['bankID'] }}</td>
                    <td>{{ $row['amount'] }}</td>
                    <td>{{ $row['date'] }}</td>
                    <td class="action-icon">
                        <a href="{{ route('vendorPayment.edit',$row['id']) }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" id="dlt-btn{{ $row['id'] }}" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row['id']}}" action="{{ route('vendorPayment.destroy',$row['id']) }}">
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
