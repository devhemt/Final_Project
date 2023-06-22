<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Images;
use App\Models\Purchase_items;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Editprd extends Component
{
    public $idprd;
    public $product, $count, $images, $p1, $batch, $cost;
    public $options, $categories;
    public $type = null;

    public function render()
    {
        $this->product = DB::table('product')
            ->join('category','product.category_id','category.id')
            ->where('product.id', $this->idprd)->get();

        $this->options = Purchase_items::where('prd_id',$this->idprd)->get();
        $this->images = Images::where('prd_id', $this->idprd)->get();
        $this->categories = Category::all();
        $this->batch = $this->type;

        if ($this->type == null){
            $this->p1 = DB::table('properties')
                ->where('prd_id', $this->idprd)
                ->where('batch','=', 1)
                ->get()->toArray();
            $this->count = DB::table('properties')
                ->where('prd_id', $this->idprd)
                ->where('batch','=', 1)
                ->get()->count();
            $this->cost = Purchase_items::where('prd_id',$this->idprd)->where('batch',1)->first()->unit_price;
        }else{
            $this->p1 = DB::table('properties')
                ->where('prd_id', $this->idprd)
                ->where('batch','=', $this->type)
                ->get()->toArray();
            $this->count = DB::table('properties')
                ->where('prd_id', $this->idprd)
                ->where('batch','=', $this->type)
                ->get()->count();
            $this->cost = Purchase_items::where('prd_id',$this->idprd)->where('batch',$this->type)->first()->unit_price;
        }


        return view('livewire.admin.product.editprd');
    }
}
