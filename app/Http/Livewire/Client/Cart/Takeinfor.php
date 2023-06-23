<?php

namespace App\Http\Livewire\Client\Cart;

use App\Models\Detail_invoice;
use Livewire\Component;

class Takeinfor extends Component
{
    protected $listeners = ['showTakeInfor'];
    public $top = null;
    public $name, $email, $phone, $address;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
    ];


    public function showTakeInfor(){
        $this->top = 0;
    }

    public function confirm(){
        $validatedData = $this->validate();
        $this->emit('setCusNoacc',[$this->name, $this->email, $this->phone, $this->address]);
        $this->close();
    }

    public function close(){
        $this->top = null;
    }

    public function render()
    {
        return view('livewire.client.cart.takeinfor');
    }
}
