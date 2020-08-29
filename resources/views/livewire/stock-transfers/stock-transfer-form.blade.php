<div>
    <form method="post" action="">
        @csrf
        <div class="section">
            <div class="section-title">
                Transfer Information
                <hr>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col">
                        <select wire:model="source" id="source" name="source" class="form-control custom-select">
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endforeach
                        </select>
                        <label for="source" class="float-label">Source Outlet</label>
                    </div>
                    <div class="col">
                        <select wire:model="destination" id="destination" name="destination" class="form-control custom-select">
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endforeach
                        </select>
                        <label for="destination" class="float-label">Destination Outlet</label>
                    </div>
                    <div class="col">
                        <input type="text" id="reference" name="reference" class="form-control" placeholder="Reference #">
                        <label for="reference" class="float-label">Reference #</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input wire:model="search" type="text" id="search" name="search" class="form-control" placeholder="Search Items">
                        <label for="search" class="float-label">Search Items</label>

                        <table class="table table-hover my-2">
                            <thead>
                                <tr class="text-center">
                                    <th class="table-head col-6">
                                        <span wire:loading.remove wire:target="source, destination, search">Product Name</span>
                                        <span wire:loading wire:target="source, destination, search">LOADING...</span>
                                    </th>
                                    <th class="table-head col-3">
                                        <span wire:loading.remove wire:target="source, destination, search">Source Qty</span>
                                    </th>
                                    <th class="table-head col-3">
                                        <span wire:loading.remove wire:target="source, destination, search">Dest. Qty</span>
                                        <div wire:loading wire:target="source, destination, search">
                                            @for($i = 0; $i < 3; $i++)
                                                <span class="spinner-grow" style="width: 1.2em; height: 1.2em"></span>
                                            @endfor
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($inventory_items) > 0)
                                    @foreach($inventory_items as $inventory_item)
                                            <tr style="cursor: pointer" wire:click="addTransferItem({{ $inventory_item->product_id }})">
                                                <td>{{ $inventory_item->product->name }}</td>
                                                <td class="text-right">{{ $inventory_item->qty }}</td>
                                                <td class="text-right">{{ $inventory_item->destination_qty }}</td>
                                            </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="3">No items found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{ $products->links() }} {{-- Pagination links for search results --}}
                    </div>
                    <div class="col">
                        <p>Barcode Scan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                Transfer Items
                <hr>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="table-head col-6">
                                        <span wire:loading.remove wire:target="addTransferItem">Product Name</span>
                                        <span wire:loading wire:target="addTransferItem">LOADING...</span>
                                    </th>
                                    <th class="table-head col-2">
                                        <span wire:loading.remove wire:target="addTransferItem">Quantity</span>
                                    </th>
                                    <th class="table-head col-2">
                                        <span wire:loading.remove wire:target="addTransferItem">Source Qty</span>
                                        <div wire:loading wire:target="addTransferItem">
                                            @for($i = 0; $i < 3; $i++)
                                                <span class="spinner-grow" style="width: 1.2em; height: 1.2em"></span>
                                            @endfor
                                        </div>
                                    </th>
                                    <th class="table-head col-2">
                                        <span wire:loading.remove wire:target="addTransferItem">Dest. Qty</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($transfer_item_objects) > 0)
                                    @foreach($transfer_item_objects as $transfer_item)
                                        <tr>
                                            <td>{{ $transfer_item->product->name }}</td>
                                            <td class="text-right">5</td>
                                            <td class="text-right">{{ $transfer_item->qty }}</td>
                                            <td class="text-right">{{ $transfer_item->destination_qty }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">No items added...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row submit-row">
                    <div class="col">
                        <input class="btn-submit" type="submit" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
