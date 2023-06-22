<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class Allaccount extends Component
{
    use WithPagination;
//    protected $listeners = ['searchOut5'];
    protected $paginationTheme = 'bootstrap';
    public $accounts, $iddelete;
    public $top = null;

    public function yes(){
        $check = DB::table('user')
            ->where('user_id','=', $this->iddelete)
            ->first();

        if ($check->role != 1){
            $deleted = DB::table('user')
                ->where('user_id','=', $this->iddelete)
                ->delete();
        }

        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }
    public function block($id){
        $this->iddelete = $id;
        $this->top = 0;
    }

    public function render()
    {
        return view('livewire.admin.allaccount',[
            'accountss' => DB::table('user')
                ->paginate(10),
        ]);
    }
}
