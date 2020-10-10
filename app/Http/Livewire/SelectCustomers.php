<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Customer;

class SelectCustomers extends Component
{
    public $customers;

    public function mount(){
        $this->customers = Customer::all();
    }
    public function render()
    {
        return view('livewire.select-customers');
    }
}
