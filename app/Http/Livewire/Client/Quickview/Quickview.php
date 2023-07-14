<?php

namespace App\Http\Livewire\Client\Quickview;

use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Cart_memory;
use App\Models\Properties;
use function PHPUnit\Framework\isEmpty;

class Quickview extends Component
{
    protected $listeners = ['idView'];
    public $prdQV;
    public $getid;
    public $name,$price,$imagein,$sizes;
    public $colorclass = null;
    public $getsize = null, $color = null;
    public $quantity = 1;
    public $check_amount = null, $check_property = null;
    public $open = null;
    public $amount;

    public function updated($quantity)
    {
        if ($this->quantity < 1){
            $this->quantity = 1;
        }
    }

    public function close(){
        $this->open = null;
    }

//    update số lượng sản phẩm mỗi 2000ms
    public function amount(){
        $this->amount = DB::table('product')
            ->join('properties', 'product.id','=', 'properties.prd_id')
            ->where('properties.prd_id', $this->getid)->sum('properties.amount');
    }

    public function getColor($input){
        $this->color = $input;
        $this->colorclass = "active";
    }

    public function addcart(){
        if($this->color != null && $this->getsize != null){
            if ($this->check_amount == 'Stock'){
                $property_id = Properties::where('prd_id',$this->getid)
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
                    if ($this->check_amount == 'Stock'){
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
                $this->emit('success');
            }
        }else{
            $this->check_property='Please select properties';
        }
        $this->emit('loadsmallcart');
    }

    public function idView($id)
    {
        $this->getid = $id;
        $this->open = "open";
        $this->getsize = null;
        $this->color = null;
        $this->quantity = 1;
        $this->amount = "countting";
    }

    public function render()
    {
        $this->prdQV = DB::table('product')
            ->join('total_property', 'product.id','=', 'total_property.prd_id')
            ->select('product.*','total_property.sizes','total_property.colors')
            ->where('product.id', $this->getid)->get();

        foreach ($this->prdQV as $p){
            $this->sizes = $p->sizes;
            $this->name = $p->name;
            $this->price = $p->price;
            $this->imagein = $p->demo_image;
        }

        if($this->getsize == null){
            $trim = trim($this->sizes);
            $size = explode(" ",$trim);
            $this->getsize = $size[0];
        }


        if($this->color != null && $this->getsize != null){
            $this->check_property = null;
            $property_amount = Properties::where('prd_id',$this->getid)
                ->where('size',$this->getsize)
                ->where('color',$this->color)
                ->sum('amount');

            if ($this->quantity >= $property_amount){
                $this->check_amount = 'Sold out';
                $this->quantity = $property_amount;
            }
            if ($this->quantity < $property_amount){
                $this->check_amount = 'Stock';
            }
        }else{
            $this->check_amount = null;
        }


        return view('livewire.client.quickview.quickview',['prdQV' => $this->prdQV,'showchose'=>$this->color,'thisid'=>$this->getid]);
    }
}
