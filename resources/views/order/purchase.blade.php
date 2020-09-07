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

<div class="section" style="height: 100%;width:100%"> {{-- Start of Section--}}
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
        <thead class="table-head">
            <tr>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>No. of products</th>
                <th>Cost Price</th>
                <th>Expected Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        @foreach($purchase as $row)
        <tbody>
            <tr>
                <td>{{ $row['id'] }}</td>
                <td>P00</td>
                <td>P_name</td>
                <td>{{ $row['qty'] }}</td>
                <td>c_price</td>
                <td>{{ $row['expectedDate'] }}</td>
                <td class="action-icon">
                    <a href="{{ route('purchase.edit',$row['id'])}}"><i class="fas fa-pen"></i></a>
                    <a href="#"><i class="fas fa-trash-alt"></i></a>
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