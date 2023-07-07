<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use Livewire\Component;

class Menu extends Component
{
    public $categories;

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.client.menu');
    }
}
