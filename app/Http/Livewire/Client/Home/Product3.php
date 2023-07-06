<?php

namespace App\Http\Livewire\Client\Home;

use App\Models\Product;
use Livewire\Component;

class Product3 extends Component
{
    public $product;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
        $this->product = Product::where('status', 1)
            ->orderBy('price', 'asc')
            ->limit(8)
            ->get();
        return view('livewire.client.home.product3');
    }
}
