@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Returns</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn"> {{-- Add button --}}
                <a href="{{ route('exchange.create') }}">Add Return</a> {{-- Enter the name of the add btn --}}
            </div>
    <thead class="table-head">
       <tr>
        <th>ID</th>
        <th>Product ID</th>
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
             <td>{{ $row->productID }}</td>
             <td>{{ $row->customerID }}</td>
             <td>{{ $row->salesmanID }}</td>
             <td>{{ $row->amount }}</td>
             <td>{{ $row->date }}</td>

          
             
                    <td class="action-icon">
                        <a href="{{ route('exchange.edit',$row->id) }}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <form method="POST" class="dlt-form" action="{{ route('exchange.destroy',$row->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
