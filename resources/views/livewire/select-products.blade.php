<div>
    {{-- <div class="section-title">
        <span class="sp-barcode">Select Products</span>
        <div class="add-btn">
            <a class="cursor" wire:click="createPDF">Print Barcodes</a>
        </div>
        <hr class="mt-3 mb-4">

    </div> --}}
    <div class="section"> {{-- Start of Section--}}
        <div class="section-title">
            Promotion Type
            <hr>
        </div>

        <div class="section-content promotion"> {{-- Start of sectionContent--}}
            {{-- Start of Form --}}

            <form method="post" class="needs-validation" action="{{route('promotion.store')}}" novalidate>

                @csrf

                <div class="row pb-2">
                    <div class="col">
                        Select Promotion type
                    </div>

                </div>
                <div class="row pb-0 pt-2">
                    <div class="col">
                    <select class="custom-select" name="promotiontype" id="typeSel">
                        <option value="all" id="allPrd">All Products</option>
                        <option value="specific">Specific Products</option>
                    </select>
                </div>
                </div>
                <div id="allProducts" >
                <div class="row pb-2">
                    <div class="col">
                        Search Products
                    </div>

                </div>
                <div class="section-content selectProductsContent"> {{-- Start of sectionContent--}}
                    <div class="col">
                    <div class="product-search">
                        <form method="post" action="">
                            @csrf
                            <input type="text" id="prdSearch" class="search-textbox form-control p" data-toggle="dropdown" placeholder="Find Products By Name Or Code">
                            <div class="dropdown-menu product-overlay" aria-labelledby="dropdownMenuButton">
                                <table class="table table-borderless">

                                    @foreach($products as $pr)
                                    {{-- <tr  wire:click="addProduct({{$pr->id}},{{ $pr->vid }})"> --}}
                                    <tr onclick="addProduct({{ $pr->id }},{{ $pr->vid }})">
                                        <td class="pr-code">
                                            {{ $pr->pcode }}
                                        </td>
                                        <td class="pr-name">
                                            {{ $pr->name }}
                                        </td>
                                        <td class="pr-name">
                                            {{ $pr->size }}
                                        </td>
                                        <td class="pr-name">
                                            {{ $pr->color }}
                                        </td>

                                    </tr>
                                    @endforeach
                                </table>


                            </div>

                            <div class="row ">
                                <div class="item-display backend">
                                    <table class="table table-striped " id="selectedProducts">

                                            <tr class="item-table-head">

                                                <th scope="col">#</th>
                                                <th scope="col">Item Code</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Colour</th>
                                                <th></th>

                                            </tr>

                                        <tbody>
                                            @if($items)

                                            @foreach($items as $key=>$item)

                                            <tr class="item-table-row">
                                                <th scope="row">{{ $item['num']}}</th>
                                                <td>{{ $item['code']}}</td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['size']}}</td>
                                                <td>{{ $item['color'] }}</td>
                                                <td ><i class="fas fa-window-close cancel" wire:click="remove({{ $key}})"></i></td>
                                                @endforeach

                                                @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Save">
                </div>
            </div> --}}
                    </div>
                </div> {{-- End  of sectionContent--}}
            </div>
            </div>
            <div class="row submit-row mt-3">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Save">
                </div>
            </div>

        </div> {{-- End  of sectionContent--}}
    </div> {{-- End  of section--}}
    </div>
