@extends('layouts.main')
@section('content')
    {{-- Copy this to every page you code and type your code in this section

        * Do not create <html>,<head>,<body> tags in this section
        * Just start writing only the body of the code because this section is the body of the code

    --}}



<div class="pg-heading">
  <i class="fa fa-arrow-left pg-back"></i>
  <div class="pg-title">Purchase Order</div>
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
      Order Details
      <hr>
  </div>
  <div class="section-content" > {{-- Start of sectionContent--}}
      {{-- Start of Form --}}

      <table id="myTable"  class="table hover table-striped table-borderless table-hover all-table">
        <div class="add-btn">
          <a href="{{ route('purchase.create') }}">+ Add new</a>
        </div>
        <div class="add-btn">
            <a href="{{ route('purchase.report') }}" target="_blank">Export Purchase</a>
        </div>
        <thead class="table-head">
            <tr>
                <th>Order ID</th>
                {{-- <th>Product ID</th>
                <th>Product Name</th> --}}
                <th>Vendor Name</th>
                <th>Date</th>
                <th>Total</th>
                <th>Expected Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        @foreach($purchase as $row)
        <tbody>
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{$row->vendorID}}</td>
                <td>{{$row->created_at}}</td>
                <td>{{ $row->total }}</td>

                <td>{{ $row->expectedDate}}</td>
                <td class="action-icon">
                    <a href="{{ route('purchase.edit',$row['id'])}}"><i class="fas fa-pen"></i></a>
                    <button type="submit" class="dlt-btn" id="dlt-btn{{ $row['id'] }}"><i class="fas fa-trash-alt"></i></button>
                    <form method="POST" class="dlt-form" id="dlt-form{{ $row['id'] }}" action="{{ route('purchase.destroy',$row['id']) }}">
                        @method('DELETE')
                        @csrf

                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

<hr>

      {{-- End of Form --}}
  </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}


@endsection
