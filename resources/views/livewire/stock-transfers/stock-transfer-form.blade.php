<div>
    <form method="POST" action="{{ route('stock-transfers.store') }}" id="transfer_form">
        @csrf

        <div class="section">
            <div class="section-title">
                Transfer Information
                <hr>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col">
                        <select wire:model="source" id="source" name="source" class="form-control custom-select" required>
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endforeach
                        </select>
                        <label for="source" class="float-label">Source Outlet</label>
                    </div>

                    <button class="btn btn-secondary align-self-center" id="swap_inventories" wire:click="swapInventories"
                            style="background-color: #058de9">
                        <i class="fa fa-exchange-alt"></i>
                    </button>

                    <div class="col">
                        <select wire:model="destination" id="destination" name="destination" class="form-control custom-select" required>
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endforeach
                        </select>
                        <label for="destination" class="float-label">Destination Outlet</label>
                    </div>
                    <div class="col">
                        <input type="text" id="reference" name="reference" class="form-control" placeholder="Reference #" required>
                        <label for="reference" class="float-label">Reference #</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">

                        <table id="inventory_items" class="table table-sm table-striped table-borderless table-hover all-table">
                            <thead>
                                <tr class="text-center">
                                    <th class="table-head">Product Code</th>
                                    <th class="table-head">Product Name</th>
                                    <th class="table-head">Source Qty</th>
                                    <th class="table-head">Dest. Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($inventory_items) > 0)
                                    @foreach($inventory_items as $inventory_item)
                                        <tr style="cursor: pointer" class="inventory_item" onclick='addItem(@json($inventory_item))'>
                                            <td class="text-left">{{ $inventory_item->product->pcode }}</td>
                                            <td class="text-left">{{ $inventory_item->product->name }}</td>
                                            <td class="text-right">{{ $inventory_item->qty }}</td>
                                            <td class="text-right">{{ $inventory_item->destination_qty }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">No items found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="text-center" id="spinner" hidden>
                            <div class="spinner-border my-5" role="status"
                                 style="color: #058de9; width: 3em; height: 3em">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

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
                        <table class="table table-sm table-striped table-borderless table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="table-head">Product Code</th>
                                    <th class="table-head">Product Name</th>
                                    <th class="table-head">Transfer Qty</th>
                                    <th class="table-head">Source Qty</th>
                                    <th class="table-head">Destination Qty</th>
                                </tr>
                            </thead>
                            <tbody id="trans-items">
                                <tr id="no_items_added">
                                    <td class="text-center" colspan="5">No items added...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row submit-row">
                    <div class="col">
                        <input class="btn-submit" type="submit" value="Save">

                        <div class="float-right">
                            <input type="checkbox" name="completed" id="completed">
                            <label for="completed" class="mr-4 mt-2">Mark as completed</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        let transfer_items = [];
        let inventory_items_table;

        function addItem(item) {
            let exist = false;

            if (transfer_items.length > 0) {
                for (let i = 0; i < transfer_items.length; i++) {
                    if (item['product_id'] === transfer_items[i]['product_id']) {
                        exist = true;
                        break;
                    }
                }

                if (!exist) {
                    transfer_items.push(item);
                    addTableRow(item);
                    addHiddenInput(item);
                } else {
                    document.getElementById('trans_qty_' + item['product_id']).stepUp(1);
                }
            } else {
                transfer_items.push(item);
                addTableRow(item);
                addHiddenInput(item);
            }
        }

        function addTableRow(item) {
            let trans_items_tbody = document.getElementById('trans-items');
            document.getElementById('no_items_added').setAttribute('hidden', '');

            let tr = document.createElement('tr');
            let item_code = document.createElement('td');
            let item_name = document.createElement('td');
            let item_trans_qty = document.createElement('td');
            let item_source_qty = document.createElement('td');
            let item_dest_qty = document.createElement('td');

            item_trans_qty.setAttribute('class', 'text-right');
            item_source_qty.setAttribute('class', 'text-right');
            item_dest_qty.setAttribute('class', 'text-right');

            let item_trans_qty_input = document.createElement('input');
            item_trans_qty_input.setAttribute('type', 'number');
            item_trans_qty_input.setAttribute('name', 'quantities[]');
            item_trans_qty_input.setAttribute('min', '1');
            item_trans_qty_input.setAttribute('max', item['qty']);
            item_trans_qty_input.setAttribute('required', '');
            item_trans_qty_input.setAttribute('class', 'text-right');
            item_trans_qty_input.setAttribute('id', 'trans_qty_' + item['product_id']);
            item_trans_qty_input.setAttribute('style', 'width: 72px');
            item_trans_qty_input.stepUp(1);

            item_code.innerHTML = item['product']['pcode'];
            item_name.innerHTML = item['product']['name'];
            item_source_qty.innerHTML = item['qty'];
            item_dest_qty.innerHTML = item['destination_qty'];

            item_trans_qty.appendChild(item_trans_qty_input);
            tr.append(item_code, item_name, item_trans_qty, item_source_qty, item_dest_qty);
            trans_items_tbody.appendChild(tr);
        }

        function addHiddenInput(item) {
            let form = document.getElementById('transfer_form');

            let trans_item_ids = document.createElement('input');
            trans_item_ids.setAttribute('type', 'hidden');
            trans_item_ids.setAttribute('name', 'transfer_items[]');
            trans_item_ids.setAttribute('value', item['product_id']);

            form.appendChild(trans_item_ids);
        }

        $(document).ready(function () {
            inventory_items_table = $('#inventory_items').DataTable({
                "order": [], "dom": '<"top"f><t><"bottom"lip>',
                language: {
                    search: "_INPUT_" , searchPlaceholder: "🔎 Search"
                }
            });
        })

        document.getElementById('source').addEventListener("change", function () {
            inventory_items_table.destroy();
            document.getElementById('inventory_items').setAttribute('hidden', '');
            document.getElementById('source').setAttribute('disabled', '');
            document.getElementById('destination').setAttribute('disabled', '');
            document.getElementById('swap_inventories').setAttribute('disabled', '');
            document.getElementById('spinner').removeAttribute('hidden');
        }, false)

        document.getElementById('destination').addEventListener("change", function () {
            inventory_items_table.destroy();
            document.getElementById('inventory_items').setAttribute('hidden', '');
            document.getElementById('source').setAttribute('disabled', '');
            document.getElementById('destination').setAttribute('disabled', '');
            document.getElementById('swap_inventories').setAttribute('disabled', '');
            document.getElementById('spinner').removeAttribute('hidden');
        }, false)

        document.getElementById('swap_inventories').addEventListener("click", function () {
            inventory_items_table.destroy();
            document.getElementById('inventory_items').setAttribute('hidden', '');
            document.getElementById('source').setAttribute('disabled', '');
            document.getElementById('destination').setAttribute('disabled', '');
            document.getElementById('swap_inventories').setAttribute('disabled', '');
            document.getElementById('spinner').removeAttribute('hidden');
        }, false)

        window.addEventListener('contentChanged', event => {
            inventory_items_table = $('#inventory_items').DataTable({
                "order": [], "dom": '<"top"f><t><"bottom"lip>',
                language: {
                    search: "_INPUT_" , searchPlaceholder: "🔎 Search"
                }
            });

            transfer_items = [];
        });
    </script>
</div>
