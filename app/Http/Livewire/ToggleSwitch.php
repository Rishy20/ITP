<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;


class ToggleSwitch extends Component
{
    public $status;
    public $userId;

    public function mount($s,$id){
        $this->status = $s;
        $this->userId = $id;
    }
    public function render()
    {
        return view('livewire.toggle-switch');
    }
    public function submit($value){
        $user = User::findOrFail($this->userId);
        $user->status = $value;
        $user->save();
        $this->status = $value;
    }

}
