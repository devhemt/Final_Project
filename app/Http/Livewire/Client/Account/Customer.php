<?php

namespace App\Http\Livewire\Client\Account;

use App\Models\Invoice_items;
use App\Models\Properties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Customer extends Component
{
    public $order1, $order2 ;
    public $top = null, $top1 = null;
    public $orderid, $customer;

    public function block($orderid){
        $this->orderid = $orderid;
    }
    public function yes(){
        $items = Invoice_items::where('invoice_id', $this->orderid)->get();

        foreach ($items as $item){
            $current = Properties::where('id',$item->property_id)->first()->amount;
            $affected = Properties::where('id', $item->property_id)
                ->update(['amount' => $current+$item->amount]);
        }

        $affected = DB::table('status')
            ->where('invoice_id','=', $this->orderid)
            ->update(['status' => 0]);
        $this->top = null;
    }

    public function render()
    {
        $userid = Auth::guard('customer')->user()->id;
        $this->customer = \App\Models\Customer::where('id', $userid)
            ->first();
        $this->order1 = DB::table('invoice')
            ->join('customer', 'invoice.customer_id','=', 'customer.id')
            ->join('status', 'invoice.id','=', 'status.invoice_id')
            ->select('invoice.*','status.status')
            ->where('customer.id', $userid)
            ->Where('status.status', 1)
            ->orWhere('status.status', 2)
            ->orWhere('status.status', 3)
            ->orWhere('status.status', 5)
            ->get();
        $this->order2 = DB::table('invoice')
            ->join('customer', 'invoice.customer_id','=', 'customer.id')
            ->join('status', 'invoice.id','=', 'status.invoice_id')
            ->select('invoice.*','status.status')
            ->where('customer.id', $userid)
            ->Where('status.status', 4)
            ->orWhere('status.status', 0)
            ->orWhere('status.status', 6)
            ->orWhere('status.status', 7)
            ->get();

        return view('livewire.client.account.customer');
    }
}
