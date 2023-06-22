<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Orderclient extends Component
{
    public $orderid,$prd,$invoice,$prdid;
    public $top = null;

    public function block($prdid){
        $this->prdid = $prdid;
        $this->top = 0;
    }
    public function yes(){
        $deleted = DB::table('detail_invoice')
            ->where('invoice_id','=', $this->orderid)
            ->where('itemsid','=', $this->prdid)
            ->delete();
        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }

    public function render()
    {
        $this->invoice = DB::table('invoice')
            ->where('invoice_id', $this->orderid)
            ->get();

        $this->prd = DB::table('detail_invoice')
            ->join('items', 'items.prd_id','=', 'detail_invoice.itemsid')
            ->where('invoice_id', $this->invoice[0]->invoice_id)
            ->get();

        return view('livewire.client.orderclient');
    }
}
