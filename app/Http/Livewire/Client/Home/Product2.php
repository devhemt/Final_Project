<?php

namespace App\Http\Livewire\Client\Home;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product2 extends Component
{
    public $allprd = [], $sold = [],$size;
    public $products;
    public $flag,$price;
    public $sale, $topDay, $topMonth, $topWeek, $lastest;

    public function checkSale($id){
        $now = Carbon::now();
        $sale = DB::table('sale')
            ->whereDay('begin', '<=', $now->day)
            ->whereMonth('begin', '<=', $now->month)
            ->whereYear('begin', '<=', $now->year)
            ->whereDay('end', '>=', $now->day)
            ->whereMonth('end', '>=', $now->month)
            ->whereYear('end', '>=', $now->year)
            ->get();
        foreach ($sale as $s){
            if ($s->category_id == null && $s->customer_type == null){
                return true;
            }
            if ($s->category_id != null && $s->customer_type == null){
                $cas_id = DB::table('product')
                    ->join('category', 'product.category_id','=', 'category.id')
                    ->select('category.id')
                    ->where('product.id','=',$id)
                    ->first()->id;
                if ($cas_id == $s->category_id){
                    return true;
                }
            }
            if ($s->category_id == null && $s->customer_type != null){
                if (Auth::guard("customer")->check()){
                    $userId = Auth::guard("customer")->id();
                    $order = DB::table('invoice')
                        ->where('customer_id','=',$userId)
                        ->count();
                    if ($s->customer_type == 3){
                        return true;
                    }else{
                        if ($s->customer_type == 2){
                            if ($order >= 1){
                                return true;
                            }
                        }else{
                            if ($order >= 2){
                                return true;
                            }
                        }
                    }
                }
            }

            return false;
        }
    }
    public function getDiscount($id){
        $now = Carbon::now();
        $sale = DB::table('sale')
            ->whereDay('begin', '<=', $now->day)
            ->whereMonth('begin', '<=', $now->month)
            ->whereYear('begin', '<=', $now->year)
            ->whereDay('end', '>=', $now->day)
            ->whereMonth('end', '>=', $now->month)
            ->whereYear('end', '>=', $now->year)
            ->get();
        $discount = 0;
        foreach ($sale as $s){
            if ($s->category_id == null && $s->customer_type == null){
                $discount += $s->discount;
            }
            if ($s->category_id != null && $s->customer_type == null){
                $cas_id = DB::table('product')
                    ->join('category', 'product.category_id','=', 'category.id')
                    ->select('category.id')
                    ->where('product.id','=',$id)
                    ->first()->id;
                if ($cas_id == $s->category_id){
                    $discount += $s->discount;
                }
            }
            if ($s->category_id == null && $s->customer_type != null){
                if (Auth::guard("customer")->check()){
                    $userId = Auth::guard("customer")->id();
                    $order = DB::table('invoice')
                        ->where('customer_id','=',$userId)
                        ->count();
                    if ($s->customer_type == 3){
                        $discount += $s->discount;
                    }else{
                        if ($s->customer_type == 2){
                            if ($order >= 1){
                                $discount += $s->discount;
                            }
                        }else{
                            if ($order >= 2){
                                $discount += $s->discount;
                            }
                        }
                    }
                }
            }
            return $discount;
        }
    }

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
        foreach ($this->sale as $p){
            $this->flag[$p->id] = $this->checkSale($p->id);
            $this->price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }

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
        foreach ($this->topDay as $p){
            $this->flag[$p->id] = $this->checkSale($p->id);
            $this->price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }

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
        foreach ($this->topWeek as $p){
            $this->flag[$p->id] = $this->checkSale($p->id);
            $this->price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }

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
        foreach ($this->topMonth as $p){
            $this->flag[$p->id] = $this->checkSale($p->id);
            $this->price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }

        // latest products
        $this->latest = Product::where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
        foreach ($this->latest as $p){
            $this->flag[$p->id] = $this->checkSale($p->id);
            $this->price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }

        return view('livewire.client.home.product2');
    }
}
