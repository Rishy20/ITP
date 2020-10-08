<?php

namespace App\Http\Livewire;

use App\Voucher;
use Livewire\Component;

class VoucherPayment extends Component
{
    public $amount = 0;
    public $query;
    public function render()
    {
        return view('livewire.voucher-payment');
    }

    public function updateQuery(){
        dd('Hello');
        $voucher = Voucher::find($this->query);
        $this->amount = $voucher->amount;
    }
    public function getVoucher($id){
        $voucher = Voucher::find($id);
        $this->amount = $voucher->amount;
    }
}
