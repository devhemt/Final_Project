<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;

class Menu extends Component
{
    public $categories;
    public $currentUrl,$shop;

    public function render()
    {
        $currentUrl = URL::current();
        $parsedUrl = parse_url($currentUrl);
        if(isset($parsedUrl['path'])){
            $this->currentUrl = $parsedUrl['path'];
        }
        if ($this->currentUrl == '/shop/all' || Str::contains($this->currentUrl, '/shop/')){
            $this->shop = true;
        }


        $this->categories = Category::all();
        return view('livewire.client.menu');
    }
}
