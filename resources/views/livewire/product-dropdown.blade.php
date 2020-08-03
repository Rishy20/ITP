<div>

        <div class="product-search">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
            <form class="search-bar">
                <input type="text" class="search-textbox form-control" placeholder="Find Products By Name, Number or Barcode">
            </form>
            <div class="product-dropdown">
            <div class="single-product-row">
                <table class="table table-borderless">

                @foreach($products as $pr)
                   <tr wire:click="show({{$pr->id}})">

                    <td class="pr-code">
                        {{ $pr->id }}
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


    </div>
</div>
