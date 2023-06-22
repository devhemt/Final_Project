<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Shop extends Component
{
    protected $listeners = ['bestSell','default','CategorySearch','searchResult','priceSearch'];

    public $product;
    public $bestsell = false;
    public $categorysearch = false;
    public $cateId;
    public $searchflag = false;
    public $search;
    public $min_price,$max_price,$price = null;

    public function priceSearch($price){
        $this->price = $price;
    }

    public function searchResult($autoSearch)
    {
        $this->search = $autoSearch;
    }

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function CategorySearch($category){
        $this->cateId = $category;
    }

    public function bestSell(){
        $this->bestsell = true;
    }

    public function default(){
        $this->bestsell = false;
    }

    public function render()
    {
        if($this->price == 'all' || $this->price == null){
            $this->min_price = 0;
            $this->max_price = 10000;
        }
        if($this->price == '$0-$50'){
            $this->min_price = 0;
            $this->max_price = 50;
        }
        if($this->price == '$50-$100'){
            $this->min_price = 50;
            $this->max_price = 100;
        }
        if($this->price == '$100-$200'){
            $this->min_price = 100;
            $this->max_price = 200;
        }
        if($this->price == '$200-more'){
            $this->min_price = 200;
            $this->max_price = 10000;
        }

        if ($this->cateId == 0){
            $this->categorysearch = false;
        }else{
            $this->categorysearch = true;
        }
        if ($this->search == null){
            $this->searchflag = false;
        }else{
            $this->searchflag = true;
        }

        if ($this->bestsell == false && $this->categorysearch == true && $this->searchflag == true) {
            $this->product = DB::table('items')
                ->join('category', 'items.prd_id','=', 'category.prdid')
                ->select('items.*','category.categories')
                ->where('items.name','like','%'.str_replace(' ', '',$this->search).'%')
                ->where('category.categories', $this->cateId)
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
                ->orderByDesc('items.prd_id')
                ->limit(20)
                ->get();
        }

        if ($this->bestsell && $this->categorysearch == true && $this->searchflag == true) {
            $this->product = DB::table('items')
                ->join('category', 'items.prd_id','=', 'category.prdid')
                ->select('items.*','category.categories')
                ->where('items.name','like', '%'.str_replace(' ', '',$this->search).'%')
                ->where('category.categories', $this->cateId)
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
                ->limit(20)
                ->get()
                ->sortBy('prd_id')
            ;
        }

        if ($this->bestsell == false && $this->categorysearch == false && $this->searchflag == true) {
            $this->product = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('items.name','like','%'.str_replace(' ', '',$this->search).'%')
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
            ->orderByDesc('items.prd_id')
            ->limit(20)
            ->get();
        }

        if ($this->bestsell && $this->categorysearch == false && $this->searchflag == true) {
            $this->product = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('items.name','like', '%'.str_replace(' ', '',$this->search).'%')
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
                ->limit(20)
            ->get()
            ->sortBy('prd_id')
            ;
        }

        if ($this->bestsell == false && $this->categorysearch == true && $this->searchflag == false) {
            $this->product = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('category.categories', $this->cateId)
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
            ->orderByDesc('items.prd_id')
            ->limit(20)
            ->get();
        }

        if ($this->bestsell && $this->categorysearch == true && $this->searchflag == false) {
            $this->product = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('category.categories', $this->cateId)
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
            ->limit(20)
            ->get()
            ->sortBy('prd_id')
            ;
        }

        if ($this->bestsell == false && $this->categorysearch == false && $this->searchflag == false) {
            $this->product = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
            ->orderByDesc('items.prd_id')
            ->limit(20)
            ->get();
        }


        if ($this->bestsell && $this->categorysearch == false && $this->searchflag == false) {
            $this->product = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
                ->whereBetween('items.price', [$this->min_price, $this->max_price])
            ->limit(20)
            ->get()
            ->sortBy('prd_id')
            ;
        }

        foreach ($this->product as $p){
            $now = Carbon::now();
            if ($now->diffInDays(Carbon::parse((date("Y-m-d g:i:s", strtotime($p->created_at)))))<30) {
                $p->created_at = 'true';
            };
        }

        $this->bestsell;
        return view('livewire.client.shop',['product'=>$this->product]);
    }


}
