<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Banner;

class Edit extends Component
{
    public $content;

    public function render()
    {
        $this->content = Banner::where('id',4)->first()->content;
        return view('livewire.admin.banner.edit');
    }
}
