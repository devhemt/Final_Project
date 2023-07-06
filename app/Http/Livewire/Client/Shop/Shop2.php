<?php

namespace App\Http\Livewire\Client\Shop;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class Shop2 extends Component
{
    public $products,$topProducts,$limit = 8;
    public $price,$sort;
    public $options2 = ['default sort','best selling'];
    public $options1 = ['all','$0-$50','$50-$100','$100-$200','$200-more'];

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function loadMore(){
        $this->limit += 10;
    }

    public function render()
    {
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

        $this->products = DB::table('product')
            ->join('total_property', 'total_property.prd_id','=', 'product.id')
            ->select('product.*','total_property.colors')
            ->where('status','=',1)
            ->limit($this->limit)
            ->get();
//        $this->products = $this->products->where('id',1);
        foreach ($this->products as $p){
            if ($now->diffInDays(Carbon::parse((date("Y-m-d g:i:s", strtotime($p->created_at)))))<30) {
                $p->created_at = 'true';
            };
        }

        return view('livewire.client.shop.shop2');
    }
}
