<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Cart;

class Smallcart extends Component
{
    protected $listeners = ['loadsmallcart'];
    public $cart;
    public $subtotal,$total,$amount;

    public function loadsmallcart(){

    }

    public function deleteCartItem($itemsid){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
        }else{
            $userId = Session::getId();
            Cart::session($userId);
        }
        Cart::remove($itemsid);
        $this->emit('loadtruecart');
    }

    public function render()
    {
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
        }else{
            $userId = Session::getId();
            Cart::session($userId);
        }
        $this->cart = Cart::getContent()->toArray();
        $this->subtotal = Cart::getSubTotal();
        $this->total = Cart::getTotal();

        $this->amount = 0;
        foreach ($this->cart as $c){
            $this->amount++ ;
        }
        return view('livewire.client.smallcart',['cart'=>$this->cart]);
    }
}
