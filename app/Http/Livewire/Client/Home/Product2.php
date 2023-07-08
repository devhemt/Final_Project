<?php

namespace App\Http\Livewire\Client\Home;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product2 extends Component
{
    public $allprd = [], $sold = [],$size;
    public $products;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
        $now = Carbon::now();

        // Cheapest product - TOP SALE
        $this->sale = Product::where('status', '=', 1)
            -> orderBy('price', 'asc')
            ->limit(2)
            ->get();

        //Top selling of day
            $this->topDay = DB::table('invoice_items')
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
                ->limit(2)
                ->get();

        //Top selling of week
        $ngayDauTuan = Carbon::now()->startOfWeek()->format('d');
        $this->topWeek = DB::table('invoice_items')
            ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
            ->join('status', 'status.invoice_id', '=', 'invoice.id')
            ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
            ->join('product', 'properties.prd_id', '=', 'product.id')
            ->where('status.status','!=' ,0)
            ->where('status.status','!=' ,7)
            ->whereDay('invoice_items.created_at', '>=', $ngayDauTuan)
            ->whereDay('invoice_items.created_at', '<=', $now->day)
            ->whereMonth('invoice_items.created_at', '=', $now->month)
            ->whereYear('invoice_items.created_at', '=', $now->year)
            ->select('product.id', 'product.name', 'product.demo_image', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
            ->groupBy('product.id', 'product.name', 'product.demo_image', 'product.price')
            ->orderByDesc('total_sales')
            ->limit(2)
            ->get();

        //top selling of month nè
        $this->topMonth = DB::table('invoice_items')
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
            ->limit(2)
            ->get();

        // latest products
        $this->latest = Product::where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        return view('livewire.client.home.product2');
    }
}
