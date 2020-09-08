@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Products</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn"> {{-- Add button --}}
                <a href="{{ route('product.create',) }}">Add Product</a> {{-- Enter the name of the add btn --}}
            </div>
            <thead class="table-head">
                <tr>
                    <th>Product code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>C.Price</th>
                    <th>S.Price</th>
                    <th>Vendor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $i)


                <tr>
                    <td>{{$i->pcode}}</td>
                    <td>{{$i->name}}</td>
                    <td>{{$i->Qty}}</td>
                    <td>{{$i->costPrice}}</td>
                    <td>{{$i->sellingPrice}}</td>
                    <td>{{$i->supplierId}}</td>


                    {{-- <td> --}}
                        {{-- Start of toggle switch --}}
                        {{-- <label class="switch"> --}}
                            {{-- <input type="checkbox" checked>
                            <span class="slider round"></span> --}}
                        {{-- </label> --}}
                        {{-- End of toggle switch --}}
                    {{-- </td> --}}
                    <td class="action-icon">
                        <a href="{{ route('product.show',$i->id) }}"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        {{-- Delete Icon --}}
                        <form method="POST" class="dlt-form" action="{{ route('product.destroy',$i->id) }}">
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
