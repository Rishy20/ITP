<div>
    <div class="row">
        <div class="col">
            <select wire:model="source" id="source" name="source" class="form-control custom-select" wire:select=>
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

            <table class="table table-sm table-hover my-2">
                <thead>
                    <tr class="text-center">
                        <th class="table-head col-6">
                            <span wire:loading.remove>Product Name</span>
                            <span wire:loading class="align-items-start">LOADING...</span>
                        </th>
                        <th class="table-head col-3">
                            <span wire:loading.remove>Source Qty</span>
                        </th>
                        <th class="table-head col-3">
                            <span wire:loading.remove>Dest. Qty</span>
                            <div wire:loading>
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
                            <tr style="cursor: pointer">
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
