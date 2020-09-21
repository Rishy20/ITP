<div>
    <div id="allProducts">
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


                                </table>
                            </div>
                        </div>

                </div>
            </div> {{-- End  of sectionContent--}}
        </div>
    </div>

</div>
