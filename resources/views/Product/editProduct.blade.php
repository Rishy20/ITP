@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Add Products</div>
</div>
<form method="post" class="needs-validation" action="{{route('product.update',$p->id)}}" novalidate>

    @method('patch')
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
                            <input type="text" name="name" value="{{ $p->name }}" class="form-control" placeholder="Product Name" required/>
                            <label class="float-label">Product Name</label>
                            <div class="invalid-feedback">
                                Please enter a Product name
                            </div>

                        </div>
                        <div class="col">
                            <input type="text" name="pcode" value="{{ $p->pcode }}"   class="form-control" placeholder="Product code" required/>
                            <label class="float-label">Product code</label>
                            <div class="invalid-feedback">
                                Please enter a Product code
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <textarea name="description" class="form-control"    rows="5" placeholder="Description">{{ $p->description }}</textarea>
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
                                <option @if($b->id == $p->brand) selected @endif   value="{{$b->id}}">{{$b->name}} </option>
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
                                <option @if($i->id == $p->catID) selected @endif value="{{$i->id}}">{{$i->name}} </option>
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
                                <option @if($v->id == $p->supplierId) selected @endif  value="{{$v->id}}">{{$v->first_name}}</option>
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
                        <input type="text" name="costPrice" id="cprice" value="{{ $p->costPrice }}"   class="form-control" placeholder="Cost Price" required />
                        <label class="float-label">Cost Price</label>
                        <div class="invalid-feedback">
                            Please enter Cost Price
                        </div>


                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="sprice" value="{{ $p->sellingPrice }}"   name="sellingPrice" placeholder="Selling Price" required>
                        <label class="float-label">Selling Price</label>
                        <div class="invalid-feedback">
                            Please enter a Selling Price
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" name="discount" id="discount" value="{{ $p->discount }}"  class="form-control" placeholder="Discount" required />
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
                            <select class="form-control inv-select" name="inventory" required>
                                <option value="" disabled selected hidden>Select an Inventory</option>
                                @foreach($inv as $i)
                                <option @foreach($inven as $t)
                                @if($i->id == $t->inventory_id) selected @endif
                                @endforeach  value="{{$i->id}}">{{$i->name}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please Select a Inventory
                            </div>
                        </div>
                    </div>
                    <div class="col barcode-col">
                        <input type="text" class="form-control" value="{{ $p->barcode }}"  name="barcode" placeholder="Barcode"  >
                        <label class="float-label">Barcode</label>


                    </div>
                </div>
                <div class="row qty-row">
                    <div class="col">
                        <input type="text" name="Qty" class="form-control" value="{{ $p->Qty }}"  placeholder="Quantity" required/>
                        <label class="float-label">Quantity</label>
                        <div class="invalid-feedback">
                            Please enter Quantity
                        </div>

                    </div>


                    <div class="col">
                        <input type="text" name="reorder_level" value="{{ $p->reorder_level }}"   class="form-control" placeholder="Reorder Quantity" required />
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
    @livewire('variant',['var'=>$var])

<script>

    $(document).ready(function(){
        var variant = <?php echo json_encode($var); ?>;
        var list = document.getElementsByClassName('price-var');
        var listq = document.getElementsByClassName('qty-spinner');

        var cprice = $('#cprice').val();
            var sprice = $('#sprice').val();
            var discount = $('#discount').val();
            var profit = (sprice - discount) - cprice;
            $('#profit').val(profit);

        variant.forEach(function(index, value, array){

            list[value].value = array[value]['price'];
            listq[value].value = array[value]['quantity'];

        });

    });

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


</script>


        {{-- @livewire('add-product', ['inv' => $inv, 'cat' => $cat, 'brand' => $brand, 'vendor' => $vendor]) --}}


@endsection

