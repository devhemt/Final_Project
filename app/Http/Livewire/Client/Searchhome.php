<?php

namespace App\Http\Livewire\Client;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Searchhome extends Component
{
    public $search_home;
    public $results;
    public $hide = 'visibility: hidden;';

    public function resetinput()
    {
        $this->search_home = null;
    }

    public function render()
    {
        $this->results = DB::table('Product')
            ->where('name','like','%'.str_replace(' ', '',$this->search_home).'%')
            ->orderByDesc('id')
            ->get();

        if ($this->search_home != null){
            $this->hide = 'visibility: visible;';
        }else{
            $this->hide = 'visibility: hidden;';
        }
        return view('livewire.client.searchhome');
    }
}
