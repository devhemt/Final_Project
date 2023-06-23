<?php

namespace App\Http\Livewire\Client\Home;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Product;

class Product1 extends Component
{
    public $product;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
        $this->product = Product::where('status','=', 1)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
        return view('livewire.client.home.product1');
    }
}
