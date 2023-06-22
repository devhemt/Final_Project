<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Packingorder extends Component
{
    use WithPagination;
    protected $listeners = ['searchOut5'];
    protected $paginationTheme = 'bootstrap';
    public $checksearch = null;
    public $options = ['Have account','No account'];
    public $type = 'Have account';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchOut5($searchinput){
        $this->checksearch = $searchinput;
    }

    public function render()
    {
        if ($this->type == 'Have account'){
            if ($this->checksearch == null){
                return view('livewire.admin.order.packingorder',[
                    'order'=> DB::table('invoice')
                        ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
                        ->join('customer', 'invoice.cusid','=', 'customer.cus_id')
                        ->select('invoice.*','status.status','customer.name','customer.phone','customer.email','customer.address')
                        ->where('status.status', 3)
                        ->paginate(10),
                ]);
            }else{
                return view('livewire.admin.order.packingorder',[
                    'order'=> DB::table('invoice')
                        ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
                        ->join('customer', 'invoice.cusid','=', 'customer.cus_id')
                        ->select('invoice.*','status.status','customer.name','customer.phone','customer.email','customer.address')
                        ->where('status.status', 3)
                        ->where('phone', 'like', '%'.$this->checksearch.'%')
                        ->paginate(10),
                ]);
            }
        }else{
            if ($this->checksearch == null){
                return view('livewire.admin.order.packingorder',[
                    'order'=> DB::table('invoice_noacc')
                        ->join('status_noacc', 'invoice_noacc.invoice_id','=', 'status_noacc.invoice_id')
                        ->join('customer_noacc', 'invoice_noacc.cusid','=', 'customer_noacc.cus_id')
                        ->select('invoice_noacc.*','status_noacc.status','customer_noacc.name','customer_noacc.phone','customer_noacc.email','customer_noacc.address')
                        ->where('status_noacc.status', 3)
                        ->paginate(10),
                ]);
            }else{
                return view('livewire.admin.order.packingorder',[
                    'order'=> DB::table('invoice_noacc')
                        ->join('status_noacc', 'invoice_noacc.invoice_id','=', 'status_noacc.invoice_id')
                        ->join('customer_noacc', 'invoice_noacc.cusid','=', 'customer_noacc.cus_id')
                        ->select('invoice_noacc.*','status_noacc.status','customer_noacc.name','customer_noacc.phone','customer_noacc.email','customer_noacc.address')
                        ->where('status_noacc.status', 3)
                        ->where('phone', 'like', '%'.$this->checksearch.'%')
                        ->paginate(10),
                ]);
            }
        }
    }
}
