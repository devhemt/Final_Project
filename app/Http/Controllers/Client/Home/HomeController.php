<?php

namespace App\Http\Controllers\Client\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        $product = DB::table('items')
            ->join('total_property','items.prd_id','total_property.itemsid')
            ->where('prd_id', $id)->get();
        $images = DB::table('images')
            ->where('itemsid', $id)->get();
        return view('client.product',[
            'product' => $product,
            'images' => $images,
            'id' => $id,
        ]);
    }

}
