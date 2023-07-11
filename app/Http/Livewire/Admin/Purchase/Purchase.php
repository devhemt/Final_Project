<?php

namespace App\Http\Livewire\Admin\Purchase;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Product;

class Purchase extends Component
{
    public $purchase_id;
    public $thisPurchase, $products;
    public $outputBox = 'none', $oldBox = null;
    public $search, $result = [], $oldProductId, $oldProduct = [];

    public function cancelAdd(){
        $this->search = null;
        $this->oldBox = 'none';
    }

    public function updated($search)
    {
        if ($this->search != null && $this->search != ''){
            $this->outputBox = 'block';
            $this->result = Product::where('name','like','%'.str_replace(' ', '',$this->search).'%')
                ->orderByDesc('id')
                ->get();
        }else{
            $this->outputBox = 'none';
        }
    }

    public function addOldProduct(){
        $this->oldBox = 0;
    }

    public function addNewProduct(){
        return redirect()->to('/admin/purchase/addnewproduct/'.$this->purchase_id);
    }

    public function render()
    {
        $this->thisPurchase = DB::table('purchase')
            ->join('supplier', 'purchase.supplier_id','=', 'supplier.id')
            ->select('purchase.*','supplier.name')
            ->where('purchase.id',$this->purchase_id)
            ->get();

        $this->products = DB::table('purchase')
            ->join('purchase_items', 'purchase.id','=', 'purchase_items.purchase_id')
            ->join('product', 'purchase_items.prd_id','=', 'product.id')
            ->join('category', 'product.category_id','=', 'category.id')
            ->select('purchase_items.quantity','purchase_items.unit_price','product.name','product.id','product.product_code','product.demo_image','category.category_name')
            ->where('purchase.id',$this->purchase_id)
            ->get();
        return view('livewire.admin.purchase.purchase');
    }
}
