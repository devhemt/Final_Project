<?php

namespace App\Http\Livewire\Client\Quickview;

use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Properties;

class Quickview extends Component
{
    protected $listeners = ['idView'];
    public $prdQV;
    public $getid;
    public $name,$price,$imagein;
    public $sizes,$colors,$colorclass = null;
    public $getsize;
    public $color;
    public $quantity = 1;
    public $checked = 'Stock';
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

//    update số lượng sản phẩm mỗi 500ms
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
        if($this->getsize == null){
            $trim = trim($this->sizes);
            $size = explode(" ",$trim);
            $this->getsize = $size[0];
        }
        if($this->color == null){
            $trim = trim($this->colors);
            $colorch = explode(" ",$trim);
            $this->color = $colorch[0];
        }
        // issue the same prd but not the same color and size will be solved by checkall

//        $sessionId = Session::getId();
//        dd($sessionId);
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
        }else{
            $userId = Session::getId();
            Cart::session($userId);
        }
        if ($this->quantity != 0){
            Cart::add([
                'id' => $this->getid,
                'name' => $this->name,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'attributes' => array(
                    0 => array(
                        'color' => $this->color,
                        'size' => $this->getsize,
                        'image' => $this->imagein,
                    )
                )
            ]);
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
            $this->colors = $p->colors;
            $this->name = $p->name;
            $this->price = $p->price;
            $this->imagein = $p->demo_image;
        }


        if($this->getsize == null){
            $trim = trim($this->sizes);
            $size = explode(" ",$trim);
            $this->getsize = $size[0];
        }
        if($this->color == null){
            $trim = trim($this->colors);
            $colorch = explode(" ",$trim);
            $this->color = $colorch[0];
        }

        $property_amount = Properties::where('prd_id',$this->getid)
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
        return view('livewire.client.quickview.quickview',['prdQV' => $this->prdQV,'showchose'=>$this->color,'thisid'=>$this->getid]);
    }
}
