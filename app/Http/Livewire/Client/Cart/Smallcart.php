<?php

namespace App\Http\Livewire\Client\Cart;

use App\Models\Images;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Properties;
use App\Models\Cart_memory;
use Livewire\Component;

class Smallcart extends Component
{
    protected $listeners = ['loadsmallcart'];
    public $guest_cart,$customer_cart, $flag = null;
    public $subtotal,$total,$amount;

    public function loadsmallcart(){}

    public function deleteCartItem($itemsid){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            $deleted = Cart_memory::where('property_id', $itemsid)->delete();
        }else{
            $userId = Session::getId();
            Cart::session($userId);
            Cart::remove($itemsid);
        }
        $this->emit('loadtruecart');
    }

    public function render()
    {
        $this->amount = 0;
        if (Auth::guard("customer")->check()){
            $this->flag = 0;
            $userId = Auth::guard("customer")->id();

            $this->customer_cart = DB::table('cart_memory')
                ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                ->join('product', 'product.id','=', 'properties.prd_id')
                ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.color','cart_memory.property_id')
                ->where('cart_memory.customer_id',$userId)->get();

            foreach ($this->customer_cart as $c){
                $this->amount++ ;
                $this->subtotal += $c->amount*$c->price;
            }
            $this->total = $this->subtotal;
        }else{
            $this->flag = 1;
            $userId = Session::getId();
            Cart::session($userId);
            $this->guest_cart = Cart::getContent()->toArray();
            $this->subtotal = Cart::getSubTotal();
            $this->total = Cart::getTotal();
            foreach ($this->guest_cart as $c){
                $this->amount++ ;
            }
        }

        return view('livewire.client.cart..smallcart');
    }
}
