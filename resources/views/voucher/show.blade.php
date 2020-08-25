@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Vouchers</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('voucher.create') }}">Add Voucher</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Voucher Card</th>
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
                        <form method="POST" class="dlt-form" action="{{ route('voucher.destroy',$vou->id) }}">
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