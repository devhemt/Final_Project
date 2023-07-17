<?php

namespace App\Http\Livewire\Client\Banner;

use Livewire\Component;
use App\Models\Banner;

class Banner3 extends Component
{
    public $banner;

    public function render()
    {
        $this->banner = Banner::where('id',7)->first();
        return view('livewire.client.banner.banner3');
    }
}
