<div>
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
                            <input type="text" wire:model.lazy="svalue" value="{{ $svalue }}" wire:change="showSize($event.target.value)" name="size" class="form-control " id="size" placeholder="Enter sizes seperated with commas" />
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
                            <input type="text" name="color" value="{{ $cvalue }}" wire:model.lazy="cvalue" wire:change="showColor($event.target.value)" class="form-control size-var " id="color" placeholder="Enter colours seperated with commas" />
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
                                            <input type="text" name="price_variant[{{ $i }}]" class="form-control price-var" value="{{ Cookie::get('price') }}" placeholder="0.00" />
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="input-group number-spinner">
                                            <div class="input-group-prepend minus-btn">
                                                <button type="button" class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" name="qty_variant[{{ $i }}]" value="0" class="form-control qty-spinner" onfocus="this.value=''" />
                                            <div class="input-group-append plus-btn">
                                                <button type="button" class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @endforeach

                                @elseif ($size)
                                <?php $i=0 ?>
                                @foreach ($size as $key=>$value)

                                <tr>
                                    <td>{{ $value }}</td>
                                    <td class="price-td">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="text" name="price_variant[{{ $i }}]" class="form-control price-var"  placeholder="0.00" />
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="input-group number-spinner">
                                            <div class="input-group-prepend minus-btn">
                                                <button type="button" class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" name="qty_variant[{{ $i }}]" value="0"   class="form-control qty-spinner" onfocus="this.value=''" />
                                            <div class="input-group-append plus-btn">
                                                <button type="button" class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                                @else
                                <?php $i=0 ?>
                                @foreach ($color as $key=>$value)
                                <tr>
                                    <td>{{ $value }}</td>
                                    <td class="price-td">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs.</span>
                                            </div>
                                            <input type="text" name="price_variant[{{ $i }}]" class="form-control price-var"  placeholder="0.00" />
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="input-group number-spinner">
                                            <div class="input-group-prepend minus-btn">
                                                <button type="button" class="btn btn-dark" data-dir="dwn"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" name="qty_variant[{{ $i }}]" value="0"  class="form-control qty-spinner" onfocus="this.value=''" />
                                            <div class="input-group-append plus-btn">
                                                <button type="button" class="btn btn-dark" data-dir="up"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php $i++ ?>
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
