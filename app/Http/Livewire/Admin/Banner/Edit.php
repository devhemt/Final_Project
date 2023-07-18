<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Banner;

class Edit extends Component
{
    public $banner_id,$banner;

    public function updated($banner_id)
    {
        if ($this->banner_id == null || $this->banner_id == ''){
            $this->banner = Banner::where('id',1)->first();
        }else{
            $this->banner = Banner::where('id',$this->banner_id)->first();
        }
    }

    public function render()
    {
        if ($this->banner_id == null || $this->banner_id == ''){
            $this->banner = Banner::where('id',1)->first();
        }
        return view('livewire.admin.banner.edit');
    }
}
