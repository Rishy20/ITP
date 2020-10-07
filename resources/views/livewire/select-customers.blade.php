<div>
    <div id="allProducts">
        <div class="row pb-2">
            {{-- <div class="col">
                Search Products
            </div> --}}

        </div>
        <div class="section-content selectProductsContent"> {{-- Start of sectionContent--}}
            <div class="col">
                <div class="product-search">
                    <form method="post" action="">
                        @csrf
                        <input type="text" id="cusSearch" class="search-textbox form-control p" data-toggle="dropdown" placeholder="Find Customers">
                        <div class="dropdown-menu product-overlay" aria-labelledby="dropdownMenuButton">
                            <table class="table table-borderless">

                                @foreach($customers as $c)
                                {{-- <tr  wire:click="addProduct({{$pr->id}},{{ $pr->vid }})"> --}}
                                <tr onclick="addCustomer({{ $c->id }})">
                                    <td class="pr-code">
                                        {{ $c->id }}
                                    </td>
                                    <td class="pr-name">
                                        {{ $c->firstname .' '. $c->lastname }}
                                    </td>
                                    <td class="pr-name">
                                        {{ $c->city }}
                                    </td>
                                    <td class="pr-name">
                                        {{ $c->phone }}
                                    </td>

                                </tr>
                                @endforeach
                            </table>


                        </div>

                        <div class="row ">
                            <div class="item-display backend">
                                <table class="table table-striped " id="selectedCustomers">

                                    <tr class="item-table-head">

                                        <th scope="col">#</th>
                                        <th scope="col">Customer Id</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Phone</th>
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
