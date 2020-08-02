<?php

namespace App\Http\Livewire;

use Carbon\Carbon;

use Livewire\Component;

class Time extends Component
{

    public $time;

    public function mount()
    {
        $carbon = Carbon::now('Asia/Colombo');
        $this->time = $carbon->format('l d/m/Y H:i:s');
    }

    public function render()
    {
        return view('livewire.time');
    }

}
