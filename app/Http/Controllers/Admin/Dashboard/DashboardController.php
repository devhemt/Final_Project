<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function lowProduct($amount){
        $products = Product::join(
            DB::raw('(SELECT prd_id, SUM(amount) AS total_amount FROM properties GROUP BY prd_id) prop'),
            'product.id',
            '=',
            'prop.prd_id'
        )
            ->where('status',1)
            ->where('prop.total_amount','<=',$amount)
            ->orderBy('prop.total_amount', 'ASC')
            ->select('product.*','prop.total_amount')
            ->get();

        return view('admin.dashboard.lowproduct',[
            'products' => $products,
            'amount' => $amount
        ]);
    }

    public function getCityName($city_id){
        $jsonString = file_get_contents(public_path('data.json'));
        $data = json_decode($jsonString);
        $city = '';
        foreach ($data as $d){
            if($d->Id == $city_id){
                $city = $d->Name;
            }
        }
        return $city;
    }

    public function topCity($time){
        $now = Carbon::now();
        if ($time == 1){
            $citys = DB::table('address')
                ->join('invoice', 'address.id', '=', 'invoice.address_id')
                ->whereDay('invoice.created_at', '=', $now->day)
                ->whereMonth('invoice.created_at', '=', $now->month)
                ->whereYear('invoice.created_at', '=', $now->year)
                ->where('address.active', '=' ,1)
                ->select('address.province', DB::raw('COUNT(address.province) as city_count'))
                ->groupBy('address.province')
                ->orderByDesc('city_count')
                ->get();
        }
        if ($time == 2){
            $citys = DB::table('address')
                ->join('invoice', 'address.id', '=', 'invoice.address_id')
                ->whereMonth('invoice.created_at', '=', $now->month)
                ->whereYear('invoice.created_at', '=', $now->year)
                ->where('address.active', '=' ,1)
                ->select('address.province', DB::raw('COUNT(address.province) as city_count'))
                ->groupBy('address.province')
                ->orderByDesc('city_count')
                ->get();
        }
        if ($time == 3){
            $citys = DB::table('address')
                ->join('invoice', 'address.id', '=', 'invoice.address_id')
                ->whereYear('invoice.created_at', '=', $now->year)
                ->where('address.active', '=' ,1)
                ->select('address.province', DB::raw('COUNT(address.province) as city_count'))
                ->groupBy('address.province')
                ->orderByDesc('city_count')
                ->get();
        }
        foreach ($citys as $c){
            $c->province = $this->getCityName($c->province);
        }

        return view('admin.dashboard.topcity',[
            'citys' => $citys,
            'time' => $time
        ]);
    }

    public function revenue($time){
        $now = Carbon::now();
        return view('admin.dashboard.revenue');
    }

    public function customer($time){
        $now = Carbon::now();
        if ($time == 1){
            $customers = DB::table('customer')
                ->whereDay('customer.created_at', '=', $now->day)
                ->whereMonth('customer.created_at', '=', $now->month)
                ->whereYear('customer.created_at', '=', $now->year)
                ->leftJoin('invoice', 'customer.id', '=', 'invoice.customer_id')
                ->select('customer.name','customer.id','customer.email','customer.phone','customer.created_at', DB::raw('COUNT(invoice.id) as invoices_count'))
                ->groupBy('customer.name','customer.id','customer.email','customer.phone','customer.created_at')
                ->orderByDesc('invoices_count')
                ->get();
        }
        if ($time == 2){
            $customers = DB::table('customer')
                ->whereMonth('customer.created_at', '=', $now->month)
                ->whereYear('customer.created_at', '=', $now->year)
                ->leftJoin('invoice', 'customer.id', '=', 'invoice.customer_id')
                ->select('customer.name','customer.id','customer.email','customer.phone','customer.created_at', DB::raw('COUNT(invoice.id) as invoices_count'))
                ->groupBy('customer.name','customer.id','customer.email','customer.phone','customer.created_at')
                ->orderByDesc('invoices_count')
                ->get();
        }
        if ($time == 3){
            $customers = DB::table('customer')
                ->whereYear('customer.created_at', '=', $now->year)
                ->leftJoin('invoice', 'customer.id', '=', 'invoice.customer_id')
                ->select('customer.name','customer.id','customer.email','customer.phone','customer.created_at', DB::raw('COUNT(invoice.id) as invoices_count'))
                ->groupBy('customer.name','customer.id','customer.email','customer.phone','customer.created_at')
                ->orderByDesc('invoices_count')
                ->get();
        }
        return view('admin.dashboard.customer',[
            'time' => $time,
            'customers' => $customers
        ]);
    }

    public function topProduct($time){
        $now = Carbon::now();
        if ($time == 1){
            $topProducts = DB::table('invoice_items')
                ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id', '=', 'invoice.id')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->where('status.status','!=' ,0)
                ->where('status.status','!=' ,7)
                ->whereDay('invoice_items.created_at', '=', $now->day)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id', 'product.name', 'product.description', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id', 'product.name', 'product.description', 'product.price')
                ->orderByDesc('total_sales')
                ->get();
        }
        if ($time == 2){
            $topProducts = DB::table('invoice_items')
                ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id', '=', 'invoice.id')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->where('status.status','!=' ,0)
                ->where('status.status','!=' ,7)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id', 'product.name', 'product.description', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id', 'product.name', 'product.description', 'product.price')
                ->orderByDesc('total_sales')
                ->get();
        }
        if ($time == 3){
            $topProducts = DB::table('invoice_items')
                ->join('invoice', 'invoice.id', '=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id', '=', 'invoice.id')
                ->join('properties', 'invoice_items.property_id', '=', 'properties.id')
                ->join('product', 'properties.prd_id', '=', 'product.id')
                ->where('status.status','!=' ,0)
                ->where('status.status','!=' ,7)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->select('product.id', 'product.name', 'product.description', 'product.price', DB::raw('SUM(invoice_items.amount) as total_sales'))
                ->groupBy('product.id', 'product.name', 'product.description', 'product.price')
                ->orderByDesc('total_sales')
                ->get();
        }

        return view('admin.dashboard.topproduct',[
            'time' => $time,
            'topProducts' => $topProducts
        ]);
    }
}
