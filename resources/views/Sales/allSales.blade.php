@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Sales</div>
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
            {{-- <div class="add-btn">
                <a href="{{ route('user.create') }}">Add User</a>
            </div> --}}
            <thead class="table-head">
                <tr>
                    <th>Sale Id</th>
                    <th>Staff Name</th>
                    <th>Customer Name</th>
                    <th>Amount</th>
                    <th>Discount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale as $s)


                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->fname.' '.$s->lname }}</td>
                    <td>{{ $s->firstname.' '.$s->lastname }}</td>
                    <td>{{ $s->amount }}</td>
                    <td>{{ $s->discount }}</td>
                    <td>{{ $s->updated_at }}</td>

                    <td class="action-icon">
                        <a href="{{ route('sale.edit',$s->id) }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" action="{{ route('sale.destroy',$s->id) }}">
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
