<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Customer extends Component
{
    public $order1, $order2 ,$order3 ,$order4;
    public $top = null, $top1 = null;
    public $orderid;

    public function block($orderid){
        $this->orderid = $orderid;
        $this->top = 0;
    }
    public function yes(){
        $affected = DB::table('status')
            ->where('invoice_id','=', $this->orderid)
            ->update(['status' => 0]);
        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }

    public function block1($orderid){
        $this->orderid = $orderid;
        $this->top1 = 0;
    }

    public function yes1(){
        $affected = DB::table('status')
            ->where('invoice_id','=', $this->orderid)
            ->update(['status' => 1]);
        $this->top1 = null;
    }
    public function no1(){
        $this->top1 = null;
    }

    public function render()
    {
        $userid = Auth::guard('customer')->user()->phone;
        $this->order1 = DB::table('invoice')
            ->join('customer', 'invoice.cusid','=', 'customer.cus_id')
            ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
            ->select('invoice.*','status.status')
            ->where('customer.phone', $userid)
            ->Where('status.status', 1)
            ->orWhere('status.status', 2)
            ->orWhere('status.status', 3)
            ->get();
        $this->order2 = DB::table('invoice')
            ->join('customer', 'invoice.cusid','=', 'customer.cus_id')
            ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
            ->select('invoice.*','status.status')
            ->where('customer.phone', $userid)
            ->Where('status.status', 4)
            ->get();
        $this->order3 = DB::table('invoice')
            ->join('customer', 'invoice.cusid','=', 'customer.cus_id')
            ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
            ->select('invoice.*','status.status')
            ->where('customer.phone', $userid)
            ->Where('status.status', 0)
            ->get();
        $this->order4 = DB::table('invoice')
            ->join('customer', 'invoice.cusid','=', 'customer.cus_id')
            ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
            ->select('invoice.*','status.status')
            ->where('customer.phone', $userid)
            ->Where('status.status', 5)
            ->get();

        return view('livewire.client.customer');
    }
}
