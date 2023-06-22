<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Images;
use App\Models\Properties;
use App\Models\Purchase_items;

class Prd extends Component
{
    public $idprd;
    public $product, $images, $properties, $purchase_price;

    public function render()
    {
        $this->product = DB::table('product')->join('category', 'product.category_id','=', 'category.id')
                        ->where('product.id',$this->idprd)->get();


        $this->images = Images::where('prd_id', $this->idprd)->get();
//        $this->properties = Properties::where('prd_id', $this->idprd)->get();
        $this->properties = DB::table('properties')->join('purchase_items', 'properties.batch','=', 'purchase_items.batch')
            ->where('properties.prd_id',$this->idprd)->where('purchase_items.prd_id',$this->idprd)->get();


        return view('livewire.admin.product.prd');
    }
}
