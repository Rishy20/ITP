<div>
    <div class="row">
        <div class="col-md-2">
            <h6 class="variant-label">
                Size
            </h6>
        </div>
        <div class="col-md-10">
            <input type="text" wire:model="svalue" value="{{ $svalue }}" wire:change="showSize($event.target.value)" name="size" class="form-control " placeholder="Enter sizes seperated with commas" />
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
            <input type="text" name="color" value="{{ $cvalue }}" wire:model="cvalue" wire:change="showColor($event.target.value)" class="form-control size-var" placeholder="Enter colours seperated with commas" />
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
                @foreach ($size as $skey=>$svalue)
                @foreach ($color as $ckey=>$cvalue)
                <tr>
                    <td>{{ $svalue }}/{{ $cvalue }}</td>
                    <td class="price-td">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Rs.</span>
                            </div>
                            <input type="text" name="price-variant" class="form-control price-var" placeholder="0.00" />
                        </div>
                    </td>
                    <td class="qty-td">
                        <div class="input-group number-spinner">
                            <div class="input-group-prepend minus-btn">
                                <button class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                            </div>
                            <input type="text" name="qty-variant" value="0" class="form-control qty-spinner" />
                            <div class="input-group-append plus-btn">
                                <button class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                    </td>

                </tr>
                @endforeach
                @endforeach

                @elseif ($size)
                @foreach ($size as $key=>$value)

                <tr>
                    <td>{{ $value }}</td>
                    <td class="price-td">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Rs.</span>
                            </div>
                            <input type="text" name="price-variant" class="form-control price-var" placeholder="0.00" />
                        </div>
                    </td>
                    <td class="qty-td">
                        <div class="input-group number-spinner">
                            <div class="input-group-prepend minus-btn">
                                <button class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                            </div>
                            <input type="text" name="qty-variant" value="0" class="form-control qty-spinner" />
                            <div class="input-group-append plus-btn">
                                <button class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
                @else
                @foreach ($color as $key=>$value)
                <tr>
                    <td>{{ $value }}</td>
                    <td class="price-td">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Rs.</span>
                            </div>
                            <input type="text" name="price-variant" class="form-control price-var" placeholder="0.00" />
                        </div>
                    </td>
                    <td class="qty-td">
                        <div class="input-group number-spinner">
                            <div class="input-group-prepend minus-btn">
                                <button class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                            </div>
                            <input type="text" name="qty-variant" value="0" class="form-control qty-spinner" />
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


</div>

