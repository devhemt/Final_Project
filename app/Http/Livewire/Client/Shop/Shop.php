<?php

namespace App\Http\Livewire\Client\Shop;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class Shop extends Component
{
    public $category;
    public $products,$topProducts,$limit = 8;
    public $price,$sort;
    public $options2 = ['default sort','best selling'];
    public $options1 = ['all','$0-$50','$50-$100','$100-$200','$200-more'];
    public $min_price,$max_price,$sort_flag;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function loadMore(){
        $this->limit += 8;
    }

    public function render()
    {
        if($this->sort == 'default sort' || $this->sort == null){
            $this->sort_flag = false;
        }else{
            $this->sort_flag = true;
        }
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

        $now = Carbon::now();
        $this->topProducts = DB::table('invoice_items')
            ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
            ->join('status', 'status.invoice_id', '=', 'invoice.id')
            ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
            ->join('product', 'properties.prd_id', '=', 'product.id')
            ->where('status.status','!=' ,0)
            ->where('status.status','!=' ,7)
            ->whereMonth('invoice_items.created_at', '=', $now->month)
            ->whereYear('invoice_items.created_at', '=', $now->year)
            ->select('product.id', 'product.name', 'product.demo_image', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
            ->groupBy('product.id', 'product.name', 'product.demo_image', 'product.price')
            ->orderByDesc('total_sales')
            ->limit(4)
            ->get();

        if ($this->sort_flag){
            $this->products = DB::table('invoice_items')
                ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id', '=', 'invoice.id')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->join('category', 'product.category_id','=', 'category.id')
                ->join('total_property', 'total_property.prd_id','=', 'product.id')
                ->where('status.status','!=' ,0)
                ->where('status.status','!=' ,7)
                ->where('product.status','=',1)
                ->whereBetween('product.price', [$this->min_price, $this->max_price])
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id', 'product.name','product.description', 'product.demo_image', 'product.price','product.created_at','total_property.colors','category.category_name', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id', 'product.name','product.description', 'product.demo_image', 'product.price','product.created_at','total_property.colors','category.category_name')
                ->orderByDesc('total_sales')
                ->limit($this->limit)
                ->get();
        }else{
            $this->products = DB::table('product')
                ->join('category', 'product.category_id','=', 'category.id')
                ->join('total_property', 'total_property.prd_id','=', 'product.id')
                ->select('product.*','total_property.colors','category.category_name')
                ->where('product.status','=',1)
                ->whereBetween('product.price', [$this->min_price, $this->max_price])
                ->limit($this->limit)
                ->get();
        }

        if ($this->category != 'all'){
            $this->products = $this->products->where('category_name','=',$this->category);
        }

        foreach ($this->products as $p){
            if ($now->diffInDays(Carbon::parse((date("Y-m-d g:i:s", strtotime($p->created_at)))))<30) {
                $p->created_at = 'true';
            };
        }

        return view('livewire.client.shop.shop');
    }
}
