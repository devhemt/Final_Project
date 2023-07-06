<?php

namespace App\Http\Controllers\Client\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $product = DB::table('product')
            ->join('total_property','product.id','total_property.prd_id')
            ->where('prd_id', $id)->get();
        $images = Images::where('prd_id', $id)->get();
        return view('client.product',[
            'product' => $product,
            'images' => $images,
            'id' => $id,
            'topProducts' => $topProducts
        ]);
    }


    public function shop($category){
        return view('client.shop',[
            'category' => $category
        ]);
    }

}
