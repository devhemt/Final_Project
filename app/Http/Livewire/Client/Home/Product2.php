<?php

namespace App\Http\Livewire\Client\Home;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product2 extends Component
{
    public $allprd = [], $sold = [],$size;
    public $products;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
        $this->sale = Product::where('status', '=', 1)
            -> orderBy('price', 'asc')
            -> limit (2)
            ->get();


        $this->rate = Product::where('tag', '=', 'fall dress')
            ->where('status', '=', 1)
            -> limit (2)
            ->get();

        $this->weeklyBest = Product::where('tag', '=', 'summer skirt')
            ->where('status', '=', 1)
            -> limit (2)
            ->get();

        $this->saleoff = Product::where('tag', '=', 'fall dress')
            -> orderBy('price', 'desc')
            -> limit (2)
            ->get();

        return view('livewire.client.home.product2');
    }
}
