@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Bank Accounts</div>
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
                <a href="{{ route('bank.create') }}">Add Bank Accounts</a> {{-- Enter the name of the add btn --}}
            </div>
    <thead class="table-head">
       <tr>

        <th>Number</th>
        <th>Name</th>
        <th>Type</th>
        <th>Bank Name</th>
        <th>Branch Name</th>
        <th>Actions</th>


        </tr>
    </thead>
       <tbody>
            @foreach($banks as $row)
           <tr>

             <td>{{ $row->number }}</td>
             <td>{{ $row->name }}</td>
             <td>{{ $row->type }}</td>
             <td>{{ $row->bankname }}</td>
             <td>{{ $row->branchname }}</td>



                    <td class="action-icon">
                        <a href="{{ route('bank.edit',$row->id) }}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" action="{{ route('bank.destroy',$row->id) }}">
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
