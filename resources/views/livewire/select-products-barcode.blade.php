<div>
    <div class="section-title">
        <span class="sp-barcode">Select Products</span>
        <div class="add-btn">
            <a class="cursor" wire:click="createPDF" >Print Barcodes</a>
        </div>
        <hr class="mt-3 mb-4">

    </div>
    <div class="section-content selectProductsContent"> {{-- Start of sectionContent--}}
        <div class="product-search">
        <form method="post" action="">
            @csrf
            <input type="text"  id="prdSearch" class="search-textbox form-control"  data-toggle="dropdown"  placeholder="Find Products By Name, Number or Barcode">
            <div class="dropdown-menu product-overlay" aria-labelledby="dropdownMenuButton">
            <table class="table table-borderless">

                @foreach($products as $pr)
                   <tr wire:click="addProduct({{$pr->id}})" >

                    <td class="pr-code">
                        {{ $pr->pcode }}
                    </td>
                    <td class="pr-name">
                        {{ $pr->name }}
                    </td>
                    <td class="pr-qty">
                        {{ $pr->Qty }}
                    </td>
                    <td class="pr-price">
                       {{ $pr->barcode }}
                    </td>

                </tr>
            @endforeach
        </table>


            </div>

            <div class="row ">
                <div class="item-display">
                    <table class="table">
                        <thead class="item-table-head">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Barcode</th>
                                <th scope="col">Label Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($items)

                            @foreach($items as $key=>$item)

                            <tr class="item-table-row">
                                <th scope="row">{{ $item['num']}}</th>
                                <td>{{ $item['code']}}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['qty']}}</td>
                                <td>{{ $item['barcode'] }}</td>
                                <td><input class="barcode-qty form-control"  type="text" value="{{ $item['qty']}}" wire:change="updateQty($event.target.value, {{ $item['num'] }})"> </td>
                            </tr>
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
