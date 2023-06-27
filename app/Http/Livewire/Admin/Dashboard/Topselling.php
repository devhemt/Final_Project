<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Topselling extends Component
{
    public $time = 'Today';
    public $topProducts;

    public function today(){
        $this->time = 'Today';
    }
    public function thismonth(){
        $this->time = 'This month';
    }
    public function thisyear(){
        $this->time = 'This year';
    }
    public function render()
    {
        $now = Carbon::now();
        if ($this->time == 'Today'){
            $this->topProducts = DB::table('invoice_items')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->select('product.id','product.brand', 'product.name', 'product.demo_image', 'product.price','invoice_items.created_at', DB::raw('COUNT(*) as total_sales'))
                ->groupBy('product.id','product.brand', 'product.name', 'product.demo_image', 'product.price','invoice_items.created_at')
                ->whereDay('invoice_items.created_at', '=', $now->day)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->orderByDesc('total_sales')
                ->limit(5)
                ->get();
        }
        if ($this->time == 'This month'){
            $this->topProducts = DB::table('invoice_items')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id','product.brand', 'product.name', 'product.demo_image', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id','product.brand', 'product.name', 'product.demo_image', 'product.price')
                ->orderByDesc('total_sales')
                ->limit(5)
                ->get();
        }
        if ($this->time == 'This year'){
            $this->topProducts = DB::table('invoice_items')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id','product.brand', 'product.name', 'product.demo_image', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id','product.brand', 'product.name', 'product.demo_image', 'product.price')
                ->orderByDesc('total_sales')
                ->limit(5)
                ->get();
        }
        return view('livewire.admin.dashboard.topselling');
    }
}
