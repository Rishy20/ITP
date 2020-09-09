@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Add Products</div>
</div>
<form method="post" class="needs-validation" action="{{route('product.store')}}" novalidate>
<div class="row">
    <div class="col-md-8">


        <div class="section"> {{-- Start of Section--}}
            <div class="section-title">
                Product Information
                <hr>
            </div>
            <div class="section-content"> {{-- Start of sectionContent--}}
                {{-- Start of Form --}}

                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name" class="form-control" placeholder="Product Name" required/>
                            <label class="float-label">Product Name</label>
                            <div class="invalid-feedback">
                                Please enter a Product name
                            </div>

                        </div>
                        <div class="col">
                            <input type="text" name="pcode"  class="form-control" placeholder="Product code" required/>
                            <label class="float-label">Product code</label>
                            <div class="invalid-feedback">
                                Please enter a Product code
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <textarea name="description" class="form-control"  rows="5" placeholder="Description"></textarea>
                            <label class="float-label">Description</label>
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


                            <select class="form-control br-select"  name="brand" required>
                                <option value="" disabled selected hidden>Select a Brand</option>
                                @foreach($brand as $b)
                                <option value="{{$b->id}}">{{$b->name}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please Select a Brand
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="cat-label">Category</label>


                            <select class="form-control cat-select"  name="catID" required>
                                <option value="" disabled selected hidden>Select a Category</option>
                                @foreach($cat as $i)
                                <option value="{{$i->id}}">{{$i->name}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please Select a Product Category
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="sup-label">Supplier</label>
                            <select class="form-control sup-select" name="supplierId" required>
                                <option value="" disabled selected hidden>Select a Supplier</option>
                                @foreach($vendor as $v)
                                <option value="{{$v->id}}">{{$v->first_name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please Select a Supplier
                            </div>
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
                        <input type="text" name="costPrice" id="cprice"  class="form-control" placeholder="Cost Price" required />
                        <label class="float-label">Cost Price</label>
                        <div class="invalid-feedback">
                            Please enter Cost Price
                        </div>


                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="sprice"  name="sellingPrice" placeholder="Selling Price" required>
                        <label class="float-label">Selling Price</label>
                        <div class="invalid-feedback">
                            Please enter a Selling Price
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" name="discount" id="discount"  class="form-control" placeholder="Discount" required />
                        <label class="float-label">Discount</label>
                        <div class="invalid-feedback">
                            Please enter a Discount
                        </div>


                    </div>
                    <div class="col">
                        <input type="text" name="Profit" id="profit" class="form-control" placeholder="Profit" readonly/>
                        <label class="float-label">Profit</label>
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
                        <div class="form-group inv-col">
                            <label class="inv-label">Inventory</label>
                            <select name="inventory"class="form-control inv-select"  required>
                                <option value="" disabled selected hidden>Select an Inventory</option>
                                @foreach($inv as $i)
                                <option value="{{$i->id}}">{{$i->name}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please Select a Inventory
                            </div>
                        </div>
                    </div>
                    <div class="col barcode-col">
                        <input type="text" class="form-control" name="barcode" placeholder="Barcode" value="{{ $barcode }}" >
                        <label class="float-label">Barcode</label>


                    </div>
                </div>
                <div class="row qty-row">
                    <div class="col">
                        <input type="text" name="Qty" class="form-control" placeholder="Quantity" required/>
                        <label class="float-label">Quantity</label>
                        <div class="invalid-feedback">
                            Please enter Quantity
                        </div>

                    </div>


                    <div class="col">
                        <input type="text" name="reorder_level"  class="form-control" placeholder="Reorder Quantity" required />
                        <label class="float-label">Reorder Quantity</label>
                        <div class="invalid-feedback">
                            Please enter Reorder Quantity
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
    @livewire('variant')

<script>



    $('#sprice').change(function(){
        var cprice = $('#cprice').val();
        var sprice = $('#sprice').val();
        var discount = $('#discount').val();
        var profit = (sprice-discount)-cprice;
        $('#profit').val(profit);
    });
    $('#discount').change(function(){
        var cprice = $('#cprice').val();
        var sprice = $('#sprice').val();
        var discount = $('#discount').val();
        var profit = (sprice-discount)-cprice;
        $('#profit').val(profit);
    })

</script>


        {{-- @livewire('add-product', ['inv' => $inv, 'cat' => $cat, 'brand' => $brand, 'vendor' => $vendor]) --}}


@endsection

