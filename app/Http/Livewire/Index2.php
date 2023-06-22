<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index2 extends Component
{
    public $allprd = [], $sold = [],$size;
    public $products;

    public function showQuickView($id) {
        $this->emit('idView', $id);
    }

    public function render()
    {
        $now = Carbon::now();
        $product = DB::table('detail_invoice')
            ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
            ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
            ->select('detail_invoice.*')
            ->where('status.status','=',5)
            ->whereYear('detail_invoice.created_at', '=', $now->year)
            ->get();
        $productnoacc = DB::table('detail_invoice_noacc')
            ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
            ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
            ->select('detail_invoice_noacc.*')
            ->where('status_noacc.status','=',5)
            ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
            ->get();
        foreach ($product as $p){
            array_push($this->allprd,$p->itemsid);
        }
        foreach ($productnoacc as $p){
            array_push($this->allprd,$p->itemsid);
        }
        array_unique($this->allprd);
        foreach ($this->allprd as $p){
            $prod = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->where('detail_invoice.itemsid','=',$p)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->sum('amount');
            $prod_noacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->where('detail_invoice_noacc.itemsid','=',$p)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->sum('amount');
            $this->sold[$p] = 0;
            $this->sold[$p] += $prod;
            $this->sold[$p] += $prod_noacc;
        }
        arsort($this->sold);
        $this->allprd = array_keys($this->sold);
        $this->size = sizeof([$this->allprd]);


        $this->products = DB::table('items')
            ->join('category', 'items.prd_id','=', 'category.prdid')
            ->select('items.*','category.categories')
//            ->Where('prd_id','=',$this->allprd[0])
//            ->orWhere('prd_id','=',$this->allprd[1])
//            ->orWhere('prd_id','=',$this->allprd[2])
//            ->orWhere('prd_id','=',$this->allprd[3])
            ->get();
        return view('livewire.client.index2');
    }
}
