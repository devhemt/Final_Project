<?php

namespace App\Http\Livewire\Client\Home;

use App\Models\Product;
use App\Models\Properties;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product4 extends Component
{
//    public $allprd = [], $sold = [],$size;
//    public $products,$prd_id,$tag;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
//        $prd_id = Product1::getId();
//        // Lấy sản phẩm hiện tại dựa trên id
////        $this->currentProduct = Product::findOrFail($id);
//
//        // Lấy danh sách các sản phẩm liên quan (related product) dựa trên cùng "tag" với sản phẩm hiện tại
//        $this->relatedProducts = Product::where('tag', $this->currentProduct->tag) // Lọc các sản phẩm có cùng tag với sản phẩm hiện tại
//        ->where('id', '<>', $this->currentProduct->id) // Loại bỏ sản phẩm hiện tại ra khỏi danh sách liên quan
//        ->orderBy('price', 'asc')
//            ->limit(8)
//            ->get();


        //top selling of month
//// Giả sử bạn có biến $prd_id chứa id của sản phẩm bạn muốn tìm các sản phẩm có cùng tag với nó
//        $prd_id = 1;
//
//// Lấy sản phẩm cần tìm các sản phẩm có cùng tag với nó
//        $this->products = Product::where('id', '!=', $prd_id)
//            ->whereHas('tags', function ($query) use ($prd_id) {
//                $query->whereIn('tag', function ($subquery) use ($prd_id) {
//                    // Lấy tag của sản phẩm có id là $prd_id
//                    $subquery->select('tag')
//                        ->from('tags')
//                        ->where('product_id', $prd_id);
//                });
//            })
//            ->limit(4)
//            ->get();
//
////dd($this);
        $now = Carbon::now();

        //top selling of month
        $this->topMonth = DB::table('invoice_items')
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

        return view('livewire.client.home.product4');
    }
}






