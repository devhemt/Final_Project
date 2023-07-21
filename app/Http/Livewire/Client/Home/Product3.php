<?php

namespace App\Http\Livewire\Client\Home;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product3 extends Component
{
    public $product;
    public $flag,$price;

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
        $this->product = Product::where('status', 1)
            ->orderBy('price', 'asc')
            ->limit(8)
            ->get();
        foreach ($this->product as $p){
            $this->flag[$p->id] = $this->checkSale($p->id);
            $this->price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }
        return view('livewire.client.home.product3');
    }
}
