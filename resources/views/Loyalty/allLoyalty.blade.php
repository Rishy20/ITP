@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">All Loyalty</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('loyalty.create') }}">Add Loyalty</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Loyalty Name</th>
                    <th>Minimum Points</th>
                    <th>Minimum Spend</th>
                    <th>No. of Customers</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($loyalty as $row)
            <tbody>
                <tr>
                    <td>{{ $row['loyaltyName'] }}</td>
                    <td>{{ $row['minimumPointRequired'] }}</td>
                    <td>{{ $row['tierPoints'] }}</td>
                    <td> 10 </td>
                    <td class="action-icon">
                        <a href="{{ route('loyalty.edit',$row['id']) }}"><i class="fas fa-pen"></i></a>
                        <form method="POST" class="dlt-form" action="{{ route('loyalty.destroy',$row['id']) }}">
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
