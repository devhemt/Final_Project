<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Images;
use App\Models\Properties;
use App\Models\Totalproperty;
use App\Models\Purchase_items;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.showproduct');
    }

    public function show($id)
    {
        return view('admin.product.product',[
            'id' => $id,
        ]);
    }

    public function edit($id)
    {
        return view('admin.product.editproduct',[
            'id'=> $id,
        ]);

    }

    public function update(Request $request)
    {
        if ($request->get('prd_name') != null){
            $request->validate([
                'prd_name' => 'required|unique:product,name|max:200',
            ]);
        }
        if ($request->get('prd_brand') != null){
            $request->validate([
                'prd_brand'=> 'required|max:200',
            ]);
        }
        if ($request->get('prd_size') != null){
            $request->validate([
                'prd_size' => 'required|max:20',
            ]);
        }
        if ($request->get('prd_color') != null){
            $request->validate([
                'prd_color' => 'required|max:20',
            ]);
        }
        if ($request->get('prd_category') != 0){
            $request->validate([
                'prd_category' => 'required|numeric',
            ]);
        }
        if ($request->get('prd_price') != null){
            $request->validate([
                'prd_price' => 'required|numeric',
            ]);
        }
        if ($request->get('prd_cost') != null){
            $request->validate([
                'prd_cost' => 'required|numeric',
            ]);
        }

        if ($request->get('prd_name') != null){
            $affected = Product::where('id', $request->get('prd_id'))
                ->update(['name' => $request->get('prd_name')]);
        }
        if ($request->get('prd_price') != null){
            $affected = Product::where('id', $request->get('prd_id'))
                ->update(['price' => $request->get('prd_price')]);
        }
        if ($request->get('prd_category') != 0){
            $affected = Product::where('id', $request->get('prd_id'))
                ->update(['category_id' => $request->get('prd_category')]);
        }
        if ($request->get('prd_tag') != null){
            $affected = Product::where('prd_id', $request->get('prd_id'))
                ->update(['tag' => $request->get('prd_tag')]);
        }
        if ($request->get('prd_brand') != null){
            $affected = Product::where('prd_id', $request->get('prd_id'))
                ->update(['brand' => $request->get('prd_brand')]);
        }
        if ($request->get('prd_description') != null){
            $affected = Product::where('prd_id', $request->get('prd_id'))
                ->update(['description' => $request->get('prd_description')]);
        }

        if ($request->prd_image != null){
            $affected = Product::where('id', $request->get('prd_id'))
                ->update(['demo_image' => $request->prd_image->getClientOriginalName()]);
            $file2 = $request->prd_image->move('images', $request->prd_image->getClientOriginalName());
        }

        if ($request->prd_images != null){
            $deleted = Images::where('prd_id', $request->get('prd_id'))->delete();

            foreach ($request->prd_images as $i){
                $images = Images::create([
                    'prd_id'=> $request->get('prd_id'),
                    'url'=> $i->getClientOriginalName()
                ]);
            }
            $file = $request->prd_images;
            foreach ($file as $f) {
                $f->move('images', $f->getClientOriginalName());
            }
        }

        $size = $request->get('prd_size');
        $color = $request->get('prd_color');
        $amount = $request->get('prd_amount');
        $flag = 0;

        $batch_amuont = 0;
        $amount = $request->get('prd_amount');
        foreach ($amount as $i) {
            $batch_amuont+= $i;
        }

        if ($request->prd_batch == null){
            $deletedp = Properties::where('batch', 1)
                ->where('prd_id', $request->get('prd_id'))
                ->delete();

            foreach ($size as $p){
                $Properties = Properties::create([
                    'prd_id'=> $request->get('prd_id'),
                    'size' => strtoupper($p),
                    'color' => $color[$flag],
                    'batch'=> 1,
                    'amount' => $amount[$flag]
                ]);
                $flag++;
            }

            $affected3 = Purchase_items::where('prd_id', $request->get('prd_id'))
                ->where('batch', 1)
                ->update(['quantity' => $batch_amuont]);
        }else{
            $deletedp = Properties::where('batch', $request->get('prd_batch'))
                ->where('prd_id', $request->get('prd_id'))
                ->delete();

            foreach ($size as $p){
                $Properties = Properties::create([
                    'prd_id'=> $request->get('prd_id'),
                    'size' => strtoupper($p),
                    'color' => $color[$flag],
                    'batch'=> $request->get('prd_batch'),
                    'amount' => $amount[$flag]
                ]);
                $flag++;
            }

            $affected3 = Purchase_items::where('prd_id', $request->get('prd_id'))
                ->where('batch', $request->get('prd_batch'))
                ->update(['quantity' => $batch_amuont]);
        }



        $sizes = [];
        $colors = [];
        $first = Properties::where('prd_id', $request->get('prd_id'))
            ->get();
        foreach ($first as $f){
            array_push($sizes, $f->size);
            array_push($colors, $f->color);
        }

        $sizeonly = array_unique($sizes);
        $sizecolap = "";
        foreach ($sizeonly as $i){
            $sizecolap.=strtoupper($i);
            $sizecolap.=" ";
        }
        $coloronly = array_unique($colors);
        $colorcolap = "";
        foreach ($coloronly as $i){
            $colorcolap.=$i;
            $colorcolap.=" ";
        }

        $affected1 = Totalproperty::where('prd_id', $request->get('prd_id'))
            ->update(['sizes' => $sizecolap]);
        $affected2 = Totalproperty::where('prd_id', $request->get('prd_id'))
            ->update(['colors' => $colorcolap]);


        if ($request->get('prd_cost') != null){
            if ($request->prd_batch == null){
                $affected = Purchase_items::where('prd_id', $request->get('prd_id'))
                    ->where('batch', 1)
                    ->update(['unit_price' => $request->get('prd_cost')]);
            }else{
                $affected = Purchase_items::where('prd_id', $request->get('prd_id'))
                    ->where('batch', $request->get('prd_batch'))
                    ->update(['unit_price' => $request->get('prd_cost')]);
            }
        }


        return redirect('admin/product/'.$request->get('prd_id'));
    }

}
