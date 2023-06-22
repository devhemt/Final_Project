<?php

namespace App\Http\Livewire;

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
        $this->results = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->where('items.name','like','%'.str_replace(' ', '',$this->search_home).'%')
            ->orderByDesc('items.prd_id')
            ->get();

        if ($this->search_home != null){
            $this->hide = 'visibility: visible;';
        }else{
            $this->hide = 'visibility: hidden;';
        }
        return view('livewire.client.searchhome');
    }
}
