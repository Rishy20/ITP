<div>
    <form method="POST" action="{{ route('inventory-counts.store') }}">
        @csrf

        <div class="section">
            <div class="section-title">
                Inventory Count Information
                <hr>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col">
                        <select wire:model="outlet" id="outlet" name="outlet" class="form-control custom-select" required>
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endforeach
                        </select>
                        <label for="outlet" class="float-label">Outlet</label>
                    </div>
                    <div class="col">
                        <input type="text" id="reference" name="reference" class="form-control" placeholder="Reference #" required>
                        <label for="reference" class="float-label">Reference #</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input wire:model="search" type="text" id="search" name="search" class="form-control" placeholder="Search Items">
                        <label for="search" class="float-label">Search Items</label>

                        <table class="table table-sm table-hover my-2" id="result_table">
                            <thead>
                            <tr class="text-center">
                                <th class="table-head col-8">
                                    <span wire:loading.remove wire:target="outlet, search">Product Name</span>
                                    <span wire:loading wire:target="outlet, search">LOADING...</span>
                                </th>
                                <th class="table-head col-4">
                                    <span wire:loading.remove wire:target="outlet, search">Qty</span>
                                    <div wire:loading wire:target="outlet, search">
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
                                    <tr style="cursor: pointer" wire:click="addCountedItem({{ $inventory_item->product_id }})">
                                        <td>{{ $inventory_item->product->name }}</td>
                                        <td class="text-right">{{ $inventory_item->qty }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="3">No items found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                        {{ $products->links() }}
                    </div>
{{--                    <div class="col">--}}
{{--                        <p>Barcode Scan</p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                Counted Items
                <hr>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="table-head col-6">
                                    <span wire:loading.remove wire:target="addCountedItem">Product Name</span>
                                    <span wire:loading wire:target="addCountedItem">LOADING...</span>
                                </th>
                                <th class="table-head col-3">
                                    <span wire:loading.remove wire:target="addCountedItem">Expected Qty</span>
                                </th>
                                <th class="table-head col-3">
                                    <span wire:loading.remove wire:target="addCountedItem">Actual Qty</span>
                                    <div wire:loading wire:target="addCountedItem">
                                        @for($i = 0; $i < 3; $i++)
                                            <span class="spinner-grow" style="width: 1.2em; height: 1.2em"></span>
                                        @endfor
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($counted_item_objects) > 0)
                                @foreach($counted_item_objects as $counted_item)
                                    <tr>
                                        <td>{{ $counted_item->product->name }}</td>
                                        <td class="text-right">{{ $counted_item->qty }}</td>
                                        <td class="text-right">
                                            <input type="number" name="actual_quantities[]" min="0" required/>
                                        </td>
                                    </tr>

                                    <input type="hidden" name="counted_items[]" value="{{ $counted_item->product->id }}"/>
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
