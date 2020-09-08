<div>
    <div class="row">
        <div class="col-md-8">


            <div class="section"> {{-- Start of Section--}}
                <div class="section-title">
                    Product Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    {{-- Start of Form --}}
                    <form method="post" action="{{route('product.store')}}" wire:submit.prevent="save">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" name="name" wire:model.lazy="pname" class="form-control" placeholder="Product Name" />
                                <label class="float-label">Product Name</label>
                            </div>
                            <div class="col">
                                <input type="text" name="pcode" wire:model.lazy="pcode" class="form-control" placeholder="Product code" />
                                <label class="float-label">Product code</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <textarea name="description" class="form-control" wire:model.lazy="pdescription" rows="5" placeholder="Description"></textarea>
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
                                <select class="form-control br-select" wire:model.lazy="pbrand" name="brand">
                                    <option value="" disabled selected hidden>Select a Brand</option>
                                    @foreach($brand as $b)
                                    <option value="{{$b->id}}">{{$b->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="cat-label">Category</label>
                                <select class="form-control cat-select" wire:model.lazy="pcat" name="catID">
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
                                <select class="form-control sup-select" wire:model.lazy="psup" name="supplierId">
                                    <option value="" disabled selected hidden>Select a Supplier</option>
                                    @foreach($vendor as $v)
                                    <option value="{{$v->id}}">{{$v->first_name}}</option>
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
                            <input type="text" name="costPrice" wire:model.lazy="cprice" class="form-control" placeholder="Cost Price" />
                            <label class="float-label">Cost Price</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" wire:model.lazy="sprice" name="sellingPrice" placeholder="Selling Price">
                            <label class="float-label">Selling Price</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="discount" wire:model.lazy="pdiscount" class="form-control" placeholder="Discount" />
                            <label class="float-label">Discount</label>
                        </div>
                        <div class="col">
                            <input type="text" name="Profit" class="form-control" placeholder="Profit" />
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
                                <select class="form-control inv-select" wire:model.lazy="pinv">
                                    <option value="" disabled selected hidden>Select an Inventory</option>
                                    @foreach($inv as $i)
                                    <option value="{{$i->id}}">{{$i->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col barcode-col">
                            <input type="text" class="form-control" name="barcode" placeholder="Barcode" wire:model="barcode" ">
                            <label class="float-label">Barcode</label>
                        </div>
                    </div>
                    <div class="row qty-row">
                        <div class="col">
                            <input type="text" name="Qty" wire:model.lazy="pqty" class="form-control" placeholder="Quantity" />
                            <label class="float-label">Quantity</label>
                        </div>


                        <div class="col">
                            <input type="text" name="reorder_level" wire:model.lazy="prqty" class="form-control" placeholder="Reorder Quantity" />
                            <label class="float-label">Reorder Quantity</label>
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
                    <div class="row">
                        <div class="col-md-2">
                            <h6 class="variant-label">
                                Size
                            </h6>
                        </div>
                        <div class="col-md-10">
                            <input type="text" wire:model.lazy="svalue" value="{{ $svalue }}" wire:change="showSize($event.target.value)" name="size" class="form-control " placeholder="Enter sizes seperated with commas" />
                            {{-- <label  class="float-label">Size</label> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <h6 class="variant-label">
                                Color
                            </h6>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="color" value="{{ $cvalue }}" wire:model.lazy="cvalue" wire:change="showColor($event.target.value)" class="form-control size-var" placeholder="Enter colours seperated with commas" />
                            {{-- <label  class="float-label">Color</label> --}}

                        </div>
                    </div>



                    @if($size || $color)
                    {{-- <hr> --}}

                    <div class="row">
                        <div class="col">
                            {{-- <h6 class="variant-label">
                Preview
             </h6> --}}
                            <table class="table preview-table">
                                <tr class="first-row">

                                    <th>Variants </th>
                                    <th>Price</th>
                                    <th>Quantity</th>

                                </tr>

                                @if($size && $color)
                                <?php $i = 0?>
                                @foreach ($size as $skey=>$svalue)
                                @foreach ($color as $ckey=>$cvalue)
                                <tr>
                                    <td>{{ $svalue }}/{{ $cvalue }}</td>
                                    <td class="price-td">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="text" name="price-variant" wire:model.lazy="vprice.{{ $i }}" class="form-control price-var" placeholder="0.00" value="{{ $sprice }}"/>
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="input-group number-spinner">
                                            <div class="input-group-prepend minus-btn">
                                                <button class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" name="qty-variant" wire:model="vqty.{{ $i }}" value="0" class="form-control qty-spinner" />
                                            <div class="input-group-append plus-btn">
                                                <button class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @endforeach

                                @elseif ($size)
                                <?php $i=1 ?>
                                @foreach ($size as $key=>$value)

                                <tr>
                                    <td>{{ $value }}</td>
                                    <td class="price-td">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="text" name="pricevariant{{ $i }}" wire:model.lazy="vprice.{{ $key }}" class="form-control price-var"  value="{{ $sprice }}"  placeholder="0.00" />
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="input-group number-spinner">
                                            <div class="input-group-prepend minus-btn">
                                                <button class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" name="qtyvariant{{ $i }}" value="0"  wire:model="vqty.{{ $key }}"  class="form-control qty-spinner" />
                                            <div class="input-group-append plus-btn">
                                                <button class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                                @else
                                @foreach ($color as $key=>$value)
                                <tr>
                                    <td>{{ $value }}</td>
                                    <td class="price-td">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="text" name="price-variant" wire:model.lazy="vprice.{{ $key }}"  class="form-control price-var" value="{{ $sprice }}" placeholder="0.00" />
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="input-group number-spinner">
                                            <div class="input-group-prepend minus-btn">
                                                <button class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" name="qty-variant" value="0" wire:model="vqty.{{ $key }}"  class="form-control qty-spinner" />
                                            <div class="input-group-append plus-btn">
                                                <button class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                                @endif

                            </table>
                        </div>
                    </div>
                    @endif
                    <div class="row submit-row">
                        <div class="col">
                            <input class="btn-submit" type="submit" value="Save">
                        </div>
                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>
