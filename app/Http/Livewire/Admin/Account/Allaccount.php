<?php

namespace App\Http\Livewire\Admin\Account;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class Allaccount extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $accounts, $iddelete;
    public $top = null;

    public function yes(){
        $check = DB::table('admin_account')
            ->where('id','=', $this->iddelete)
            ->first();

        if ($check->id != 1){
            $deleted = DB::table('admin_account')
                ->where('id','=', $this->iddelete)
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
        return view('livewire.admin.account.allaccount',[
            'accountss' => DB::table('admin_account')
                ->paginate(10),
        ]);
    }
}
