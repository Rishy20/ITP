<div>
    <div class="row">
        <div class="col-md-8">
        <div class="product-search">
            <div class="search-box">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>

                <form class="search-bar" wire:submit.prevent="sub">
                    <input type="text" wire:model.debounce="query"  id="prdSearch" class="search-textbox form-control"  data-toggle="dropdown"  placeholder="Find Products By Name, Number or Barcode">
                    <div class="dropdown-menu product-overlay" aria-labelledby="dropdownMenuButton">


                                <table class="table table-borderless">

                                @foreach($products as $pr)
                                   <tr wire:click="show({{$pr->id}})" >

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
                                        Rs. {{ $pr->sellingPrice }}
                                    </td>

                                </tr>
                            @endforeach
                        </table>

                      </div>
                </form>




            {{-- <div class="load-spinner " wire:loading wire:target="query">
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
            </div> --}}
            <button class="v-btn btn ">
                <i class="fas fa-gift sub-icon"></i><span class="sub-btn-txt"> Voucher</span>
            </button>
            <button class="v-btn btn ">
                <i class="fas fa-exchange-alt sub-icon"></i><span class="sub-btn-txt"> Exchange</span>
            </button>


        </div>

    </div>
    @if($size)
<div class="var-display">
    <div class="var-display-title">
        Select a Size
    </div>
    <hr>
    <div class="var-display-content">

        @foreach($size as $key => $s)
        <button class="var-btn" wire:click="selectSize({{$s}})" >{{ $s }}</button>
        @endforeach


    </div>
</div>
@endif
@if($colorSelect)
<div class="var-display">
    <div class="var-display-title">
        Select a Color
    </div>
    <hr>
    <div class="var-display-content">

        @foreach($color as $key => $c)
        <button class="var-btn" wire:click='selectColor({{$key}})'>{{ $c }}</button>
        @endforeach


    </div>
</div>
@endif
    <div class="item-display">
        <table class="table">
            <thead class="item-table-head">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item Code</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @if($items)

                @foreach($items as $item)

                <tr class="item-table-row">
                    <th scope="row">{{ $item['num']}}</th>
                    <td>{{ $item['code']}}</td>
                    <td>{{ $item['name'] }}
                        @if($item['size'] && $item['color'] )
                            <div class="size">
                                {{ $item['size'] }}/{{ $item['color'] }}
                            </div>
                        @elseif($item['size'])
                            <div class="size">
                                {{ $item['size'] }}
                            </div>
                        @elseif( $item['color'] )
                        <div class="size">
                            {{ $item['color'] }}
                        </div>
                        @endif

                    </td>
                    <td>{{ $item['qty']}}</td>
                    <td>Rs.{{ $item['price'] }}</td>
                    <td>Rs.{{ $item['discount']}}</td>
                    <td>Rs.{{ $item['total']}}</td>
                </tr>
                @endforeach

                @endif


            </tbody>
        </table>
    </div>

</div>
<div class="col-md-4">
    <div class="price-display">

        <div class="mini-display">
            <button class="mini-display-btn btn"  data-toggle="dropdown">
                <i class="fas fa-user-circle s-icon"></i>
                @if (!$sid)
                    <span class="s-text">Add a Salesman</span>
                @else
                     <span class="s-text"><span class="sid">{{ $sid }}</span><span class="sname">{{ $sname}} </span></span>
                @endif

            </button>
            <ul class="dropdown-menu">
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                @foreach($employee as $emp)
                <li wire:click="updateSalesman({{ $emp->emp_id }})"><span class="sid">{{ $emp->emp_id }}</span><span class="sname">{{ $emp->fname . ' '. $emp->lname }} </span></li>
                @endforeach

              </ul>
        </div>

        <div class="mini-display">
            <button class="mini-display-btn btn">
                <i class="fas fa-users s-icon"></i><span class="s-text"> Add a Customer </span>
            </button>
        </div>

        <hr class="price-display-rule">
        <div class="display-info">
            <span class="display-text">No of Items</span>
            <span class="display-values">{{ $noOfItems }}</span>
        </div>
        <hr class="price-display-rule">
        <div class="display-info">
            <span class="display-text">Discount</span>
            <span class="display-values">Rs.{{ $discount }}</span>
        </div>
        <hr class="price-display-rule">
        <div class="display-info">
            <span class="display-text">Subtotal</span>
            <span class="display-values">Rs.{{ $subtotal }}</span>
        </div>
        <hr class="price-display-rule">
        <div class="display-info">
            <span class="display-text">Taxes</span>
            <span class="display-values">Rs.{{ $tax }}</span>
        </div>
        <hr class="price-display-rule">
        <div class="display-info">
            <span class="display-text">Total</span>
            <span class="display-values">Rs.{{ $total }}</span>
        </div>

        <div class="pay-btn-div">
            <button class="pay-btn btn">
                <span class="pay">PAY</span>
                <span class="pay-value">Rs.{{ $total }}</span>
            </button>
        </div>

        <div class="sub-btn-div">

            <button class="sub-btn btn mr-2">
                <i class="fas fa-undo sub-icon"></i><span class="sub-btn-txt"> Retrieve Sale</span>
            </button>

            <button class="sub-btn btn mr-2">
                <i class="fas fa-parking sub-icon"></i><span class="sub-btn-txt"> Park Sale</span>
            </button>
            <button class="sub-btn btn">
                <i class="fas fa-trash-alt sub-icon"></i><span class="sub-btn-txt"> Discard Sale</span>
            </button>


        </div>
    </div>
</div>
</div>
</div>
