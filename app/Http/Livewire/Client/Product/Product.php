<?php

namespace App\Http\Livewire\Client\Product;

use App\Models\Cart_memory;
use App\Models\Properties;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Product extends Component
{
    public $prd_id,$product;
    public $name,$price,$imagein;
    public $sizes;
    public $getsize;
    public $color;
    public $quantity = 1;
    public $checked = 'Stock', $check_property = null;
    public $amount = "countting";

    public function amount(){
        $this->amount = DB::table('product')
            ->join('properties', 'product.id','=', 'properties.prd_id')
            ->where('product.id', $this->prd_id)->sum('properties.amount');
    }

    public function getColor($input){
        $this->color = $input;
        $this->colorclass = "active";

    }

    public function addcart(){
        if($this->color != null && $this->getsize != null){
            $property_id = Properties::where('prd_id',$this->prd_id)
                ->where('size',$this->getsize)
                ->where('color',$this->color)
                ->first()->id;
            if (Auth::guard("customer")->check()){
                $userId = Auth::guard("customer")->id();

                $checkin = Cart_memory::where('customer_id',$userId)
                    ->where('property_id',$property_id)
                    ->count();

                if ($checkin==0){
                    $create_cart = Cart_memory::create([
                        'customer_id' => $userId,
                        'property_id' => $property_id,
                        'size' => $this->getsize,
                        'color' => $this->color,
                        'amount' => $this->quantity,
                        'check_buy' => 1
                    ]);
                }else{
                    $amount = Cart_memory::where('customer_id',$userId)
                        ->where('property_id',$property_id)
                        ->first()->amount;
                    $affected = Cart_memory::where('customer_id',$userId)
                        ->where('property_id',$property_id)
                        ->update(['amount' => $amount+1]);
                }


            }else{
                if ($this->checked == 'Stock'){
                    $userId = Session::getId();
                    Cart::session($userId);
                    if ($this->quantity != 0){
                        Cart::add([
                            'id' => $property_id,
                            'name' => $this->name,
                            'price' => $this->price,
                            'quantity' => $this->quantity,
                            'attributes' => array(
                                'color' => $this->color,
                                'size' => $this->getsize,
                                'image' => $this->imagein,
                            )
                        ]);
                    }
                }
            }
        }else{
            $this->check_property='Please select properties';
        }
        $this->emit('loadsmallcart');
    }

    public function render()
    {
        $this->product = DB::table('product')
            ->join('total_property','product.id','total_property.prd_id')
            ->select('product.*','total_property.sizes','total_property.colors')
            ->where('product.id', $this->prd_id)->get();
        foreach ($this->product as $p){
            $this->sizes = $p->sizes;
            $this->price = $p->price;
            $this->name = $p->name;
            $this->imagein = $p->demo_image;
        }
        if($this->getsize == null){
            $trim = trim($this->sizes);
            $size = explode(" ",$trim);
            $this->getsize = $size[0];
        }

        if($this->color != null && $this->getsize != null){
            $this->check_property = null;
            $property_amount = Properties::where('prd_id',$this->prd_id)
                ->where('size',$this->getsize)
                ->where('color',$this->color)
                ->sum('amount');

            if ($this->quantity >= $property_amount){
                $this->checked = 'Sold out';
                $this->quantity = $property_amount;
            }
            if ($this->quantity < $property_amount){
                $this->checked = 'Stock';
            }
        }else{
            $this->checked = null;
        }
        return view('livewire.client.product.product');
    }
}
