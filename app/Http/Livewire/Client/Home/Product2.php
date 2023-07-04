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
        $this->product = Product::where('status','=', 1)
            ->orderByDesc('id')
            ->limit(4)
            ->get();
        return view('livewire.client.home.product2');
    }
}
