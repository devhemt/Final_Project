<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Images;
use App\Models\Properties;
use App\Models\Totalproperty;
use App\Models\Purchase_items;
use App\Models\Invoice_items;
use App\Models\Cart_memory;
use Illuminate\Support\Facades\Validator;

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
        if ($request->get('prd_color_name') != null){
        $request->validate([
            'prd_color_name' => 'required|max:50',
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
        $color_name = $request->get('prd_color_name');

        $flag = 0;
        $batch_amuont = 0;
        $amount = $request->get('prd_amount');
        foreach ($amount as $i) {
            $batch_amuont+= $i;
        }

        $flag_batch;
        if ($request->prd_batch == null){
            $flag_batch = 1;
        }else{
            $flag_batch = $request->get('prd_batch');
        }

        $rule = false;
        $prp = Properties::where('batch', $flag_batch)
            ->where('prd_id', $request->get('prd_id'))
            ->get();
        foreach ($prp as $p){
            $invoice_item = Invoice_items::where('property_id', $p->id)->count();
            $cart_memory = Cart_memory::where('property_id', $p->id)->count();
            if ($invoice_item != 0 || $cart_memory != 0){
                $rule = true;
            }
        }
        if ($rule){
            $check_prp = Properties::where('batch', $flag_batch)
                ->where('prd_id', $request->get('prd_id'))
                ->count();
            if (count($size)<$check_prp){
                $validator = Validator::make($request->all(), []);
                $validator->errors()->add('prd_size', 'Số lượng biến thể thay đổi ít hơn số lượng cũ có thể ảnh hưởng đến các đươn hàng');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            foreach ($prp as $p){
                $affected3 = Properties::where('id', $p->id)
                    ->update(['size' => strtoupper($size[$flag]),
                        'color' => $color[$flag],
                        'color_name' => $color_name[$flag],
                        'amount' => $amount[$flag]]);
                $flag++;
            }
            if(count($size)>$check_prp){
                for($i = $flag; $i < count($size); $i++){
                    $Properties = Properties::create([
                        'prd_id'=> $request->get('prd_id'),
                        'size' => strtoupper($size[$i]),
                        'color' => $color[$i],
                        'color_name' => $color_name[$i],
                        'batch'=> $flag_batch,
                        'amount' => $amount[$i]
                    ]);
                }
            }
        }else{
            $deletedp = Properties::where('batch', $flag_batch)
                ->where('prd_id', $request->get('prd_id'))
                ->delete();

            foreach ($size as $p){
                $Properties = Properties::create([
                    'prd_id'=> $request->get('prd_id'),
                    'size' => strtoupper($p),
                    'color' => $color[$flag],
                    'color_name' => $color_name[$flag],
                    'batch'=> $flag_batch,
                    'amount' => $amount[$flag]
                ]);
                $flag++;
            }
        }

        $affected3 = Purchase_items::where('prd_id', $request->get('prd_id'))
            ->where('batch', $flag_batch)
            ->update(['quantity' => $batch_amuont]);



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

        $purchase_id = Purchase_items::where('prd_id', $request->get('prd_id'))
            ->where('batch', $flag_batch)->first()->purchase_id;
        $purchase_item = Purchase_items::where('purchase_id', $purchase_id)->get();
        $total = 0;
        foreach ($purchase_item as $p){
            $total += $p->quantity * $p->unit_price;
        }
        $affected = Purchase::where('id', $purchase_id)
            ->update(['total_pay' => $total]);


        return redirect('admin/product/'.$request->get('prd_id'));
    }

}
