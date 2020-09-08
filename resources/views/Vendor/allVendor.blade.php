@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">All Vendors</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
               <a href="{{ route('vendors.create') }}"> Add Vendor </a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Vendor Name</th>
                    <th>Company Name</th>
                    <th>Contact</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendor as $v )


                <tr>
                    <td>{{ $v->first_name . " " . $v->last_name }}</td>
                    <td>{{ $v->company_name }}</td>
                    <td>{{ $v->phone_no }}</td>
                    <td>{{ $v->city }}</td>
                    <td>{{ $v->email }}</td>
                    <td class="action-icon">
                        <a href="{{ route('vendors.edit',$v->id) }}"><i class="fas fa-pen"></i></a>

                        <form method="POST" class="dlt-form"  action="{{ route('vendors.destroy',$v->id) }}">
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
