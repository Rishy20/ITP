<div>
    <div class="row">
        <div class="col-md-8">
        <div class="product-search">
            <div class="search-box">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>

            <form class="search-bar" wire:submit.prevent="sub">
                <input type="text" wire:model.debounce="query"  class="search-textbox form-control" placeholder="Find Products By Name, Number or Barcode">
            </form>
            <div class="load-spinner " wire:loading wire:target="query">
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
            </div>
        </div>
            <!-- Button trigger modal -->
 {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
  </button> --}}

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
            @if(!empty($query))
            <div class="outclick" wire:click="rest"></div>
            @if(!empty($products))
            <div class="product-dropdown-1">
            <div class="single-product-row">

                <table class="table table-borderless">

                @foreach($products as $pr)
                   <tr wire:click="show({{$pr->id}})"  data-toggle="modal" data-target="#exampleModalCenter">

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
        </div>
        @else
        <div class="product-dropdown-1">
            <div class="single-product-row">
                No results!
            </div>
        </div>
        @endif
        @endif
    </div>
    {{-- <div class="item-display">
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
                    <th scope="row">1</th>
                    <td>{{ $item['code']}}</td>
                    <td>{{ $item['name'] }}</td>
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

</div> --}}
<div class="col-md-4">
    <div class="price-display">

        <div class="mini-display">
            <button class="mini-display-btn btn">
                <i class="fas fa-user-circle s-icon"></i><span class="s-text"> Add a Salesman </span>
            </button>
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
