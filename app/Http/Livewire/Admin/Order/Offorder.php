<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Invoice;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Offorder extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function create(){
        if (Invoice::latest()->first() == null){
            $invoice_code = '#ORDER1';
        }else{
            $invoice_code = '#ORDER'.Invoice::latest()->first()->id+1;
        }
        $invoice = Invoice::create([
            'invoice_code' => $invoice_code,
            'pay' => 0,
            'true_pay' => 0,
            'payment' => 'offline',
            'see' => 0,
            'delivery' => 'none'
        ]);
        $status = Status::create([
            'invoice_id' => $invoice->id,
            'status' => 8
        ]);

        $this->redirect('/admin/offline/add/'.$invoice->id);
    }

    public function render()
    {
        return view('livewire.admin.order.offorder',[
            'order'=> DB::table('invoice')
                ->join('status', 'invoice.id','=', 'status.invoice_id')
                ->where('status.status', 8)
                ->paginate(10),
        ]);
    }
}
