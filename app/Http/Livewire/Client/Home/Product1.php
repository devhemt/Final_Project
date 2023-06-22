<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $product1,$product2,$product3,$product4;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
        $this->product1 = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('block','=', null)
            ->where('category.categories','=', 1)
            ->orderByDesc('items.prd_id')
            ->limit(2)
            ->get();
        $this->product2 = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('block','=', null)
            ->where('category.categories','=', 2)
            ->orderByDesc('items.prd_id')
            ->limit(2)
            ->get();
        $this->product3 = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('block','=', null)
            ->where('category.categories','=', 3)
            ->orderByDesc('items.prd_id')
            ->limit(2)
            ->get();
        $this->product4 = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
            ->where('block','=', null)
            ->where('category.categories','=', 4)
            ->orderByDesc('items.prd_id')
            ->limit(2)
            ->get();
        return view('livewire.client.index');
    }
}
