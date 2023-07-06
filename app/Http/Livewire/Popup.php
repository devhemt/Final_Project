<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Popup extends Component
{
    protected $listeners = ['success'];
    public $show2 = '', $style2 = '';
    public $flag;

    public function hide()
    {
        $this->show2 = '';
        $this->style2 = '';
    }

    public function success(){
        $this->show2 = 'show';
        $this->style2 = 'display: block; padding-right: 17px;';
    }

    public function render()
    {
        return view('livewire.popup');
    }
}
