<?php

namespace App\Http\Livewire\test;

use Livewire\Component;

class ShopSBP extends Component
{
    public $options = ['all','$0-$50','$50-$100','$100-$200','$200-more'];
    public $status;


    public function render()
    {
        if($this->status != null){
            $this->emit('priceSearch', $this->status);
        }

        return view('livewire.client.shop-s-b-p');
    }
}
