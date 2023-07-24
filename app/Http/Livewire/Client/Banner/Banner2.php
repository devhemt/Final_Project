<?php

namespace App\Http\Livewire\Client\Banner;

use Livewire\Component;
use App\Models\Banner;

class Banner2 extends Component
{
//    banner của slider
    public $banner1,$banner2,$banner3;
    public function render()
    {
        $this->banner1 = Banner::where('id',4)->first();
        $this->banner2 = Banner::where('id',5)->first();
        $this->banner3 = Banner::where('id',6)->first();
        return view('livewire.client.banner.banner2');
    }
}
