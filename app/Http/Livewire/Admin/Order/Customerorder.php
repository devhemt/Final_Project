<?php

namespace App\Http\Livewire\Admin\Order;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class Customerorder extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $options = ['0'=>"Cancelled", "1"=>"Pending", "2"=>"Confirmed", "3"=>"Packing", "4"=>"Delivery", "5"=>"Delivered", "6"=>"Delivery Failed", "7"=>"return", "8"=>"All Order"];
    public $type = 8, $count;

    public function render()
    {
        if ($this->type == 8){
            $this->count = DB::table('invoice')
                ->join('status', 'invoice.id','=', 'status.invoice_id')
                ->join('customer', 'invoice.customer_id','=', 'customer.id')
                ->select('invoice.*','status.status','customer.name','customer.phone','customer.email')
                ->count();
            return view('livewire.admin.order.customerorder',[
                'order'=> DB::table('invoice')
                    ->join('status', 'invoice.id','=', 'status.invoice_id')
                    ->join('customer', 'invoice.customer_id','=', 'customer.id')
                    ->select('invoice.*','status.status','customer.name','customer.phone','customer.email')
                    ->paginate(10),
            ]);
        }else{
            $this->count = DB::table('invoice')
                ->join('status', 'invoice.id','=', 'status.invoice_id')
                ->join('customer', 'invoice.customer_id','=', 'customer.id')
                ->select('invoice.*','status.status','customer.name','customer.phone','customer.email')
                ->where('status.status', $this->type)
                ->count();
            return view('livewire.admin.order.customerorder',[
                'order'=> DB::table('invoice')
                    ->join('status', 'invoice.id','=', 'status.invoice_id')
                    ->join('customer', 'invoice.customer_id','=', 'customer.id')
                    ->select('invoice.*','status.status','customer.name','customer.phone','customer.email')
                    ->where('status.status', $this->type)
                    ->paginate(10),
            ]);
        }

    }
}
