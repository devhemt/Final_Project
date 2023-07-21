<?php

namespace App\Http\Controllers\Client\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Images;

class HomeController extends Controller
{
    public function success()
    {
        return view('layout.successful');
    }
    public function fail()
    {
        return view('layout.fail');
    }

    public function index()
    {
        if (!session()->exists('access')){
            session(['access' => false]);
            $flag = true;
        }else{
            $flag = false;
        }
        return view('client.home',[
            'flag' => $flag,
        ]);

    }

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

    public function show($id)
    {
        $now = Carbon::now();
        $topProducts = DB::table('invoice_items')
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
        foreach ($topProducts as $p){
            $flag[$p->id] = $this->checkSale($p->id);
            $price[$p->id] =$p->price - (($this->getDiscount($p->id)/100) * $p->price);
        }

        $product = DB::table('product')
            ->join('total_property','product.id','total_property.prd_id')
            ->where('prd_id', $id)->get();
        $images = Images::where('prd_id', $id)->get();
        return view('client.product',[
            'product' => $product,
            'images' => $images,
            'id' => $id,
            'topProducts' => $topProducts,
            'flag' => $flag,
            'price' => $price
        ]);
    }


    public function shop($category){
        return view('client.shop',[
            'category' => $category
        ]);
    }

}
