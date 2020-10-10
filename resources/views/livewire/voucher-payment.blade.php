<div>
    <div class="col">
        <div class="form-group">
            <label>Voucher Code</label>
            <input type="text" id="voucherCode" wire:model="query" name="amount" class="form-control" />
        </div>
        {{-- wire:change="getVoucher($event.target.value)" --}}
    </div>
    <div class="col">
        <div class="form-group">
            <label>Amount</label>
            <input type="text" name="amount" wire:model="amount" class="form-control" disabled />
        </div>
    </div>
</div>
