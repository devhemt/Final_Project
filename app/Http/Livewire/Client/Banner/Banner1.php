<?php

namespace App\Http\Livewire\Client\Banner;

use App\Models\Banner;
use Livewire\Component;

class Banner1 extends Component
{
//    small banner
    public $banner1,$banner2,$banner3;

    public function render()
    {
        $this->banner1 = Banner::where('id',1)->first();
        $this->banner2 = Banner::where('id',2)->first();
        $this->banner3 = Banner::where('id',3)->first();
        return view('livewire.client.banner.banner1');
    }
}
