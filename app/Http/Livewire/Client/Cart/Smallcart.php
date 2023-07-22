<?php

namespace App\Http\Livewire\Client\Cart;

use App\Models\Images;
use App\Models\Product;
use Carbon\Carbon;
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
    public $subtotal,$total,$amount,$discount = 0;

    public function loadsmallcart(){}

    public function getDiscount($id){
        $now = Carbon::now();
        $sale = DB::table('sale')
            ->whereDay('begin', '<=', $now->day)
            ->whereMonth('begin', '<=', $now->month)
            ->whereYear('begin', '<=', $now->year)
            ->whereDay('end', '>=', $now->day)
            ->whereMonth('end', '>=', $now->month)
            ->whereYear('end', '>=', $now->year)
            ->get();
        $discount = 0;
        foreach ($sale as $s){
            if ($s->category_id == null && $s->customer_type == null){
                $discount += $s->discount;
            }
            if ($s->category_id != null && $s->customer_type == null){
                $cas_id = DB::table('product')
                    ->join('category', 'product.category_id','=', 'category.id')
                    ->select('category.id')
                    ->where('product.id','=',$id)
                    ->first()->id;
                if ($cas_id == $s->category_id){
                    $discount += $s->discount;
                }
            }
            if ($s->category_id == null && $s->customer_type != null){
                if (Auth::guard("customer")->check()){
                    $userId = Auth::guard("customer")->id();
                    $order = DB::table('invoice')
                        ->where('customer_id','=',$userId)
                        ->count();
                    if ($s->customer_type == 3){
                        $discount += $s->discount;
                    }else{
                        if ($s->customer_type == 2){
                            if ($order >= 1){
                                $discount += $s->discount;
                            }
                        }else{
                            if ($order >= 2){
                                $discount += $s->discount;
                            }
                        }
                    }
                }
            }
            return $discount;
        }
    }

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
        $discount = 0;
        if (Auth::guard("customer")->check()){
            $this->flag = 0;
            $userId = Auth::guard("customer")->id();

            $this->customer_cart = DB::table('cart_memory')
                ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                ->join('product', 'product.id','=', 'properties.prd_id')
                ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.color','cart_memory.property_id')
                ->where('cart_memory.customer_id',$userId)->get();

            foreach ($this->customer_cart as $c){
                $discount += ($this->getDiscount($c->id)/100) * $c->price * $c->amount;
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
                $prd_id = Properties::where('id',$c['id'])->first()->prd_id;
                $prd_price = Product::where('id', $prd_id)->first()->price;
                $discount += ($this->getDiscount($prd_id)/100) * $prd_price * $c['quantity'];
                $this->amount++ ;
            }
        }
        $this->discount = $discount;
        $this->total = $this->subtotal - $this->discount;

        return view('livewire.client.cart..smallcart');
    }
}
