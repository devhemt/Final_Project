<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Sidebar extends Component
{
    public $currentUrl;
    public $DE = false,$cus = false,$order = false,$account = false;

    public function move(){
        $this->redirect('/admin');
    }

    public function render()
    {
        $currentUrl = URL::current();
        $parsedUrl = parse_url($currentUrl);
        $this->currentUrl = $parsedUrl['path'];

        if($this->currentUrl == '/admin'){
            $this->DE = true;
        }

        if ($this->currentUrl == '/admin/create/customer' || Str::contains($this->currentUrl, 'admin/showcustomer')){
            $this->cus = true;
        }
        if (Str::contains($this->currentUrl, 'admin/db/')){
            $this->DE = true;
        }
        if ($this->currentUrl == '/admin/customer_order' || $this->currentUrl == '/admin/guest_order'){
            $this->order = true;
        }
        if ($this->currentUrl == '/admin/profile/create' || $this->currentUrl == '/admin/profile/showall'){
            $this->account = true;
        }

        return view('livewire.admin.sidebar');
    }
}
