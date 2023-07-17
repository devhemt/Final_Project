<?php

namespace App\Http\Livewire\Client\Banner;

use App\Models\Banner;
use Livewire\Component;

class Banner1 extends Component
{
    public $banner1;

    public function render()
    {
        $this->banner1 = Banner::where('id',1)->first();
        return view('livewire.client.banner.banner1');
    }
}
