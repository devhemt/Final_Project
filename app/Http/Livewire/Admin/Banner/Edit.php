<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Category;
use Livewire\Component;
use App\Models\Banner;

class Edit extends Component
{
    public $banner_id,$banner;
    public $url = [];

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
        $categories = Category::all();

        $this->url = ["shop/all"];
        foreach ($categories as $category){
            $this->url[] = 'shop/'.$category->category_name;
        }
//        dd($this->url);
        return view('livewire.admin.banner.edit');
    }
}
