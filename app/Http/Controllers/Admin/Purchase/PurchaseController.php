<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Images;
use App\Models\Properties;
use App\Models\Totalproperty;
use App\Models\Purchase_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function show()
    {
        return view('admin.purchase.showpurchase');
    }

    public function purchaseDetail($id){
        return view('admin.purchase.purchase',[
            'purchase_id' => $id,
        ]);
    }

    public function addNewProduct($id){
        $category = Category::all();
        return view('admin.product.addproduct',[
            'purchase_id' => $id,
            'categories' => $category,
        ]);
    }

    public function addOldProduct($prd_id, $purchase_id)
    {
        $product = Product::where('id',$prd_id)->get();
        return view('admin.product.addold',[
            'prd_id'=> $prd_id,
            'purchase_id' => $purchase_id,
            'product' => $product
        ]);
    }

    public function addOld(Request $request)
    {
        $request->validate([
            'prd_id'=> 'required|numeric',
            'purchase_id'=> 'required|numeric',
            'unit_price' => 'required',
            'prd_size' => 'required|max:20',
            'prd_color' => 'required|max:20',
            'prd_amount' => 'required',
        ]);

        $batch = Purchase_items::where('prd_id',$request->get('prd_id'))
            ->latest('created_at')
            ->first();
        $quantity = 0;
        $amount = $request->get('prd_amount');
        foreach ($amount as $i) {
            $quantity+= $i;
        }

        $bt = Purchase_items::create([
            'purchase_id' => $request->get('purchase_id'),
            'prd_id'=> $request->get('prd_id'),
            'batch' => ($batch->batch+1),
            'quantity' => $quantity,
            'unit_price' => $request->get('unit_price'),
        ]);

        $size = $request->get('prd_size');
        $color = $request->get('prd_color');
        $amount = $request->get('prd_amount');
        $flag = 0;

        foreach ($size as $p){
            $Properties = Properties::create([
                'prd_id'=> $request->get('prd_id'),
                'size' => strtoupper($p),
                'color' => $color[$flag],
                'batch'=> ($batch->batch+1),
                'amount' => $amount[$flag]
            ]);
            $flag++;
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


        return redirect('admin/purchase/'.$request->get('purchase_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'prd_name' => 'required|unique:product,name|max:200',
            'purchase_id'=> 'required|numeric',
            'prd_cost_price' => 'required|numeric',
            'prd_price' => 'required|numeric',
            'prd_category' => 'required|numeric',
            'prd_tag' => 'required',
            'prd_brand'=> 'required|max:200',
            'prd_size' => 'required|max:20',
            'prd_color' => 'required|max:20',
            'prd_amount' => 'required',
            'prd_description' => 'required'
        ]);


        $items = Product::create([
            'demo_image'=> $request->prd_image->getClientOriginalName(),
            'name' => $request->get('prd_name'),
            'description' => $request->get('prd_description'),
            'price' => $request->get('prd_price'),
            'tag' => $request->get('prd_tag'),
            'brand' => $request->get('prd_brand'),
            'status' => 1,
            'category_id' => $request->get('prd_category')
        ]);
        $id = Product::where('name',$request->get('prd_name'))
            ->latest('created_at')->first();


        foreach ($request->prd_images as $i){
            $images = Images::create([
                'prd_id'=> $id->id,
                'url'=> $i->getClientOriginalName()
            ]);
        }
        $file = $request->prd_images;
        foreach ($file as $f) {
            $f->move('images', $f->getClientOriginalName());
        }
        $file2 = $request->prd_image->move('images', $request->prd_image->getClientOriginalName());


        $size = $request->get('prd_size');
        $color = $request->get('prd_color');
        $amount = $request->get('prd_amount');
        $quantity = 0;
        foreach ($amount as $a){
            $quantity+= $a;
        }
        $flag = 0;

        foreach ($size as $p){
            $Properties = Properties::create([
                'prd_id'=> $id->id,
                'size' => strtoupper($p),
                'color' => $color[$flag],
                'batch'=> 1,
                'amount' => $amount[$flag]
            ]);
            $flag++;
        }

        $sizeonly = array_unique($size);
        $sizecolap = "";
        foreach ($sizeonly as $i){
            $sizecolap.=strtoupper($i);
            $sizecolap.=" ";
        }
        $coloronly = array_unique($color);
        $colorcolap = "";
        foreach ($coloronly as $i){
            $colorcolap.=$i;
            $colorcolap.=" ";
        }

        $Totalproperty = Totalproperty::create([
            'prd_id'=> $id->id,
            'sizes' => $sizecolap,
            'colors' => $colorcolap
        ]);

        $PurchaseItems = Purchase_items::create([
            'purchase_id' => $request->get('purchase_id'),
            'prd_id' => $id->id,
            'unit_price' => $request->get('prd_cost_price'),
            'batch' => 1,
            'quantity' => $quantity
        ]);

        return redirect('/admin/purchase/'.$request->get('purchase_id'));

    }
}
