@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('product.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
    <div class="pg-title">Add Products</div>
    <div class="demo-btn">
        Demo
    </div>
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
                            <input type="text" name="name" class="form-control" placeholder="Product Name" required />
                            <label class="float-label">Product Name</label>
                            <div class="invalid-feedback">
                                Please enter a Product name
                            </div>

                        </div>
                        <div class="col">
                            <input type="text" name="pcode" class="form-control" placeholder="Product code" required />
                            <label class="float-label">Product code</label>
                            <div class="invalid-feedback">
                                Please enter a Product code
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Description"></textarea>
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


                                <select id="brand" class="form-control br-select" name="brand" required>
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


                                <select id="cat" class="form-control cat-select" name="catID" required>
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
                                <select id="sup" class="form-control sup-select" name="supplierId" required>
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
                            <input type="text" name="costPrice" id="cprice" class="form-control" placeholder="Cost Price" required />
                            <label class="float-label">Cost Price</label>
                            <div class="invalid-feedback">
                                Please enter Cost Price
                            </div>


                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="sprice" name="sellingPrice" placeholder="Selling Price" required>
                            <label class="float-label">Selling Price</label>
                            <div class="invalid-feedback">
                                Please enter a Selling Price
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount" required />
                            <label class="float-label">Discount</label>
                            <div class="invalid-feedback">
                                Please enter a Discount
                            </div>


                        </div>
                        <div class="col">
                            <input type="text" name="Profit" id="profit" class="form-control" placeholder="Profit" readonly />
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
                                <select id="inventory" name="inventory" class="form-control inv-select" required>
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
                            <input type="text" class="form-control" name="barcode" placeholder="Barcode" value="{{ $barcode }}">
                            <label class="float-label">Barcode</label>


                        </div>
                    </div>
                    <div class="row qty-row">
                        <div class="col">
                            <input type="text" name="Qty" class="form-control" placeholder="Quantity" required />
                            <label class="float-label">Quantity</label>
                            <div class="invalid-feedback">
                                Please enter Quantity
                            </div>

                        </div>


                        <div class="col">
                            <input type="text" name="reorder_level" class="form-control" placeholder="Reorder Quantity" required />
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
    @livewire('variant',['var'=>null])

    <script>
        $('#sprice').change(function() {
            var cprice = $('#cprice').val();
            var sprice = $('#sprice').val();
            var discount = $('#discount').val();
            var profit = (sprice - discount) - cprice;
            $('#profit').val(profit);

            var list = document.getElementsByClassName('price-var');
            var sprice = $('#sprice').val();
            var n;
                for (n = 0; n < list.length; ++n) {
                    list[n].value = sprice;
                }

        });

        $('#size').change(function() {

            var list = document.getElementsByClassName('price-var');
            var sprice = $('#sprice').val();
            var n;
            setTimeout(function() {
                for (n = 0; n < list.length; ++n) {
                    list[n].value = sprice;
                }
            }, 750)

        });

        $('#color').change(function() {

            var list = document.getElementsByClassName('price-var');
            var sprice = $('#sprice').val();
            var n;
            setTimeout(function() {
                for (n = 0; n < list.length; ++n) {
                    list[n].value = sprice;
                }
            }, 750)

        });

        $('#discount').change(function() {
            var cprice = $('#cprice').val();
            var sprice = $('#sprice').val();
            var discount = $('#discount').val();
            var profit = (sprice - discount) - cprice;
            $('#profit').val(profit);
        });





$(".demo-btn").click(function(){
        $("input[name='name']").val("Nike pro");
        $("input[name='pcode']").val("IGN2000");
        $("#description").val("Nike Pro is our iconic innovation that uses pressurized air in a durable, flexible membrane to provide lightweight cushioning. The air compresses on impact and then immediately returns to its original shape and volume, ready for the next impact.");
        $("#brand").val("3");
        $("#cat").val("22");
        $("#sup").val("7");
        $("input[name='costPrice']").val("5000");
        $("input[name='sellingPrice']").val("6500");
        $("input[name='discount']").val("500");
        $("#profit").val("1000");
        $("#inventory").val("5");

        $("input[name='Qty']").val("20");
        $("input[name='reorder_level']").val("5");



    });

    //Validate only numberic values
    $('input[name="costPrice"],input[name="sellingPrice"],input[name="discount"]').keyup(function(e)
                                {
        if (/\D/g.test(this.value))
        {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });



    </script>


    {{-- @livewire('add-product', ['inv' => $inv, 'cat' => $cat, 'brand' => $brand, 'vendor' => $vendor]) --}}


    @endsection
