<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Maskloadadmin extends Component
{
    protected $listeners = ['mask'];
    public $load = 'none';

    public function mask(){
        $this->load = null;
        $this->emit('mail');
    }

    public function render()
    {
        return view('livewire.admin.maskloadadmin');
    }
}
