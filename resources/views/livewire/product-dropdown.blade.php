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
                <li wire:click="updateSalesman({{ $emp->id }})"><span class="sid">{{ $emp->id }}</span><span class="sname">{{ $emp->fname . ' '. $emp->lname }} </span></li>
                @endforeach
              </ul>
        </div>

        <div class="mini-display">
            <button class="mini-display-btn btn"  data-toggle="dropdown">
                <i class="fas fa-users s-icon"></i>
                @if (!$cusid)
                <span class="s-text">Add a Customer</span>
            @else
                 <span class="s-text"><span class="sid">{{ $cusphone }}</span><span class="sname">{{ $cusname}} </span></span>
            @endif
            </button>
            <ul class="dropdown-menu">
                <input class="form-control" id="cusSearch" type="text" placeholder="Search..">
                @foreach($customer as $cus)
                <li wire:click="updateCustomer({{ $cus->id }})"><span class="sid">{{ $cus->phone }}</span><span class="sname">{{ $cus->firstname . ' '. $cus->lastname }} </span></li>
                @endforeach
              </ul>
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

        <div class="pay-btn-div" id="payBtn">
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

{{-- /****** Add Expense Model ******/ --}}
<div class="full-pg" id="fadeBg"></div>
<div class="pos-sub-display" id="posSubExpense">

    <div class="pos-sub-display-title">
        <span class="title">Expense</span>
        <button class="close-btn" id="closeBtn"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" action="{{route('expense.store')}}"  >
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type</label>
                        <select name="type" class="form-control" id="exampleFormControlSelect1">
                            <option value="Stationary">Stationary</option>
                            <option value="Food">Food</option>
                            <option value="Electricity">Electricity</option>
                            <option value="Telephone">Telephone</option>
                            <option value="Petty Cash">Petty Cash</option>
                            <option value="Water">Water</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" />
                    </div>
                </div>
            </div>


            <div class="form-group pl-2 pr-2">
                <div class="row">
                    <label>Description</label>
                </div>
                <div class="row">
                    <textarea name="description" class="pos-sub-txtArea" rows=5></textarea>
                </div>
            </div>
            <input type="text" value="1" name="userId" hidden>
            <div class="action-btn-row">

                <input type="submit" class="add-sub-btn" value="Add"/>

            </div>
        </form>
    </div>
</div>
{{-- End of Add Expense Model --}}
<div class="full-pg" id="fadeBgPay"></div>
<div class="pos-sub-display pos-pay" id="posSubPay">

    <div class="pos-sub-display-title">
        <span class="title">Pay</span>
        <button class="close-btn" id="closeBtnPay"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form>
            <div class="row mt-2">
               <div class="col-md-5">
                   <h4 class="pos-pay-total pt-3">Amount To Pay</h4>
               </div>
               <div class="col-md-7">
                   <div class="total-rect">
                    <div class="total-rect-value"> Rs.{{ $total }}</div>
                   </div>
               </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-5">
                    <h4 class="pos-pay-total pt-3">Amount Tendered</h4>
                </div>
                <div class="col-md-7">
                    <div class="total-rect">
                        <span class="rs-pay">Rs.</span><input type="text" class="amnt-tend" value="{{ $total }}" />
                    </div>
                </div>
             </div>
             <div class="row mt-5">
                <div class="col">
                    <button class="payment-btn" wire:click="makeSale">Cash</button>
                </div>
                <div class="col">
                    <button class="payment-btn">Card</button>
                </div>
                <div class="col">
                    <button class="payment-btn">Loyalty</button>
                </div>
                <div class="col">
                    <button class="payment-btn">Voucher</button>
                </div>
                <div class="col">
                    <button class="payment-btn">Split</button>
                </div>
             </div>

    </div>
</div>
</div>
