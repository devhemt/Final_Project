<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index(){
        return view('admin.sale.addsale');
    }

    public function detail($id){
        return view('admin.sale.detail',[
            'sale_id' => $id
        ]);
    }
}
