<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Quickview extends Component
{
    protected $listeners = ['idView'];
    public $prdQV;
    public $getid,$thisid;
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

    public function amount(){
        $this->amount = DB::table('items')
            ->join('properties', 'items.prd_id','=', 'properties.itemsid')
            ->where('prd_id', $this->getid)->sum('properties.amount');
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
                'id' => $this->thisid,
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
        $this->prdQV = DB::table('items')
            ->join('total_property', 'items.prd_id','=', 'total_property.itemsid')
            ->select('items.*','total_property.sizes','total_property.colors')
            ->where('prd_id', $this->getid)->get();
        foreach ($this->prdQV as $p){
            $this->thisid = $p->prd_id;
            $this->sizes = $p->sizes;
            $this->colors = $p->colors;
            $this->name = $p->name;
            $this->price = $p->price;
            $this->imagein = $p->demoimage;
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
        $detail = DB::table('properties')
            ->where('itemsid','=',$this->thisid)
            ->where('size','=',$this->getsize)
            ->where('color','=',$this->color)
            ->sum('amount');

        if ($this->quantity >= $detail){
            $this->checked = 'Sold out';
            $this->quantity = $detail;
        }
        if ($this->quantity < $detail){
            $this->checked = 'Stock';
        }
        return view('livewire.client.quickview',['prdQV' => $this->prdQV,'showchose'=>$this->color,'thisid'=>$this->thisid]);
    }
}
