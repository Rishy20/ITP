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
            <div class="add-btn"> {{-- Add button --}}
                <a href="{{ route('exchange.create') }}">Add Return</a> {{-- Enter the name of the add btn --}}
            </div>
    <thead class="table-head">
       <tr>
        <th>ID</th>
        <th>Product Code</th>
        <th>Customer ID</th>
        <th>Salesman ID</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Actions</th>


        </tr>
    </thead>
       <tbody>
            @foreach($exchanges as $row)
           <tr>
             <td>{{ $row->id }}</td>
             <td>{{ $row->pcode }}</td>
             <td>{{ $row->firstname." ".$row->lastname }}</td>
             <td>{{ $row->fname." ".$row->lname }}</td>
             <td>{{ $row->amount }}</td>
             <td>{{ $row->created_at }}</td>



                    <td class="action-icon">
                        <a href="{{ route('exchange.edit',$row->id) }}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row->id }}" action="{{ route('exchange.destroy',$row->id) }}">
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
