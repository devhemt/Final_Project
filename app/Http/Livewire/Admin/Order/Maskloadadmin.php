<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;

class Maskloadadmin extends Component
{
    protected $listeners = ['mask','done'];
    public $load = 'none';

    public function mask(){
        $this->load = null;
        $this->emit('mail');
    }
    public function done(){
        $this->load = 'none';
    }

    public function render()
    {
        return view('livewire.admin.order.maskloadadmin');
    }
}
