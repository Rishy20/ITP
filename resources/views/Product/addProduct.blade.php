@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Add Products</div>
</div>
<div class="row">
   <div class="col-md-8">


<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
         Product Information
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}
        <form method="post" action="">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text"  name="name" class="form-control" placeholder="Product Name" />
                    <label  class="float-label">Product Name</label>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <textarea   name="description" class="form-control" placeholder="Description"></textarea>
                    <label  class="float-label">Description</label>
                </div>
            </div>
            <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Save">
                </div>
            </div>

        {{-- End of Form --}}
    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}
</div>
<div class="col-md-4">
<div class="section"> {{-- Start of Section--}}
    <div class="section-title section-title-sub">
         Product Information
        <hr>
    </div>
    <div class="section-content">
        <div class="row">
            <input type="text" class="form-control" name="brand" placeholder="Brand">
            <label class="float-label">Brand</label>
        </div>
        <div class="row">
            <div class="form-group">
            <label>Category</label>
            <select  class="form-control">
             @foreach($cat as $i)
                <option value="{{$i->id}}">{{$i->name}} </option>
             @endforeach
            </select>
          </div>
        </div>
        <div class="row">
            <input type="text" class="form-control" name="supplier" placeholder="Supplier">
            <label class="float-label">Supplier</label>
        </div>
    </div>
</div>
</div>
</div>
<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
         Product Pricing
        <hr>
    </div>
    <div class="section-content">
        <div class="row">
            <div class="col">
                <input type="text"  name="costPrice" class="form-control" placeholder="Cost Price" />
                <label  class="float-label">Cost Price</label>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="sellingPrice" placeholder="Selling Price">
                <label class="float-label">Selling Price</label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text"  name="discount" class="form-control" placeholder="Discount" />
                <label  class="float-label">Discount</label>
            </div>
            <div class="col">
                <input type="text"  name="Profit" class="form-control" placeholder="Profit" />
                <label  class="float-label">Profit</label>
            </div>
    </div>
</div>
</div>
@endsection

{{--
    Important points to consider
    * The labels should be below the input box
    * All the input boxes should have a placeholder
    * The class name of the label should be "float-label"
    * The class name of the submit button should be "btn-submit"
    * The row containing the submit button should have a class of submit-row
--}}
