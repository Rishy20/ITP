@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Vouchers</div>
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
                <a href="{{ route('voucher.create') }}">Add Voucher</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Voucher No.</th>
                    <th>Amount</th>
                    <th>Expiry Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($voucher as $vou)


                <tr>
                    <td>{{ $vou->id }}</td>
                    <td>{{ $vou->amount }}</td>
                    <td>{{ $vou->exp }}</td>

                    <td class="action-icon">
                        <a href="{{ route('voucher.edit',$vou->id) }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $vou->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $vou->id }}" action="{{ route('voucher.destroy',$vou->id) }}">
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
