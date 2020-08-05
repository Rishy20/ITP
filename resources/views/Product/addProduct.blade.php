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
                    <textarea   name="description" class="form-control" rows="5" placeholder="Description"></textarea>
                    <label  class="float-label">Description</label>
                </div>
            </div>


        {{-- End of Form --}}
    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}
</div>
<div class="col-md-4">
<div class="section section-sub"> {{-- Start of Section--}}
    <div class="section-title section-title-sub">
         Organization
        <hr>
    </div>
    <div class="section-content">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="br-label">Brand</label>
                    <select class="form-control br-select">
                        <option value="" disabled selected hidden>Select a Brand</option>
                     @foreach($inv as $i)
                        <option value="{{$i->id}}">{{$i->name}} </option>
                     @endforeach
                    </select>
                  </div>
        </div>
    </div>
        <div class="row">
            <div class="col">
            <div class="form-group">
            <label class="cat-label">Category</label>
            <select  class="form-control cat-select">
              <option value="" disabled selected hidden>Select a Category</option>
             @foreach($cat as $i)
                <option value="{{$i->id}}">{{$i->name}} </option>
             @endforeach
            </select>
          </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="sup-label">Supplier</label>
                    <select class="form-control sup-select">
                        <option value="" disabled selected hidden>Select a Supplier</option>
                     @foreach($inv as $i)
                        <option value="{{$i->id}}">{{$i->name}} </option>
                     @endforeach
                    </select>
                  </div>
        </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
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
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <div class="section"> {{-- Start of Section--}}
            <div class="section-title">
                 Inventory
                <hr>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="inv-label">Inventory</label>
                            <select class="form-control inv-select">
                                <option value="" disabled selected hidden>Select an Inventory</option>
                             @foreach($inv as $i)
                                <option value="{{$i->id}}">{{$i->name}} </option>
                             @endforeach
                            </select>
                          </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="Barcode" placeholder="Barcode">
                        <label class="float-label">Barcode</label>
                    </div>
                    <div class="col">
                        <input type="text"  name="Quantity" class="form-control" placeholder="Quantity" />
                        <label  class="float-label">Quantity</label>
                    </div>

            </div>
        </div>
        </div>
    </div>
</div>
<div class="row mt-4 mb-5">
    <div class="col-md-8">
        <div class="section"> {{-- Start of Section--}}
            <div class="section-title">
                 Variants
                <hr>
            </div>
            <div class="section-content">
                    <livewire:product-variant/>
                    <div class="row submit-row">
                        <div class="col">
                            <input class="btn-submit" type="submit" value="Save">
                        </div>
                    </div>


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

