@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">All Services</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('service.create') }}">Add Service</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Service ID</th>
                    <th>Customer ID</th>
                    <th>Date</th>
                    <th>Return Date</th>
                    <th>Service Description</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($service as $s)
                <tr>
                    <td>{{ $s->id  }}</td>
                    <td>{{ $s->customer_id }}</td>
                    <td>{{ $s->date }}</td>
                    <td>{{ $s->return_date }}</td>
                    <td>{{ $s->service_description }}</td>
                    <td>{{ $s->cost }}</td>
                    <td class="action-icon">
                        <a href="{{ route('service.edit',$s->id) }}"><i class="fas fa-pen"></i></a>

                        <form method="POST" class="dlt-form"  action="{{ route('service.destroy',$s) }}">
                            @method('DELETE')
                            @csrf
                            <button class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
