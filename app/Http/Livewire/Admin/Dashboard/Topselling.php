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
                ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id', '=', 'invoice.id')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->where('status.status','!=' ,0)
                ->where('status.status','!=' ,7)
                ->whereDay('invoice_items.created_at', '=', $now->day)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id', 'product.name', 'product.demo_image', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id', 'product.name', 'product.demo_image', 'product.price')
                ->orderByDesc('total_sales')
                ->limit(5)
                ->get();
        }
        if ($this->time == 'This month'){
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
                ->limit(5)
                ->get();
        }
        if ($this->time == 'This year'){
            $this->topProducts = DB::table('invoice_items')
                ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id', '=', 'invoice.id')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->where('status.status','!=' ,0)
                ->where('status.status','!=' ,7)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id', 'product.name', 'product.demo_image', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id', 'product.name', 'product.demo_image', 'product.price')
                ->orderByDesc('total_sales')
                ->limit(5)
                ->get();
        }
        return view('livewire.admin.dashboard.topselling');
    }
}
