<?php

namespace App\Http\Controllers\Client\Home;

use App\Http\Controllers\Controller;
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
        $product = DB::table('product')
            ->join('total_property','product.id','total_property.prd_id')
            ->where('prd_id', $id)->get();
        $images = Images::where('prd_id', $id)->get();
        return view('client.product',[
            'product' => $product,
            'images' => $images,
            'id' => $id,
        ]);
    }

}
