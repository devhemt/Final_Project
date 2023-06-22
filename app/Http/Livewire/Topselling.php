<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Topselling extends Component
{
    public $time = 'Today';
    public $allprd = [], $sold = [],$reveneu = [],$img = [],$name = [],$price = [],$size;

    public function today(){
        $this->time = 'Today';
    }
    public function thismonth(){
        $this->time = 'This month';
    }
    public function thisyear(){
        $this->time = 'This year';
    }
    public function render()
    {
        $now = Carbon::now();
        if ($this->time == 'Today'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereDay('detail_invoice.created_at', '=', $now->day)
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->get();
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereDay('detail_invoice_noacc.created_at', '=', $now->day)
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
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
                    ->whereDay('detail_invoice.created_at', '=', $now->day)
                    ->whereMonth('detail_invoice.created_at', '=', $now->month)
                    ->whereYear('detail_invoice.created_at', '=', $now->year)
                    ->sum('amount');
                $prod_noacc = DB::table('detail_invoice_noacc')
                    ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                    ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                    ->select('detail_invoice_noacc.*')
                    ->where('status_noacc.status','=',5)
                    ->where('detail_invoice_noacc.itemsid','=',$p)
                    ->whereDay('detail_invoice_noacc.created_at', '=', $now->day)
                    ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                    ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                    ->sum('amount');
                $prod_r = DB::table('detail_invoice')
                    ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                    ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                    ->select('detail_invoice.*')
                    ->where('status.status','=',5)
                    ->where('detail_invoice.itemsid','=',$p)
                    ->whereDay('detail_invoice.created_at', '=', $now->day)
                    ->whereMonth('detail_invoice.created_at', '=', $now->month)
                    ->whereYear('detail_invoice.created_at', '=', $now->year)
                    ->get();
                $prod_noacc_r = DB::table('detail_invoice_noacc')
                    ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                    ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                    ->select('detail_invoice_noacc.*')
                    ->where('status_noacc.status','=',5)
                    ->where('detail_invoice_noacc.itemsid','=',$p)
                    ->whereDay('detail_invoice_noacc.created_at', '=', $now->day)
                    ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                    ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                    ->get();
                $sum = 0;
                foreach ($prod_r as $r){
                    $sum += ($r->price_one - $r->cost_one)* $r->amount;
                }
                foreach ($prod_noacc_r as $r){
                    $sum += ($r->price_one - $r->cost_one)* $r->amount;
                }
                $this->reveneu[$p] = $sum;
                $this->sold[$p] = 0;
                $this->sold[$p] += $prod;
                $this->sold[$p] += $prod_noacc;
            }
            arsort($this->sold);
            $this->allprd = array_keys($this->sold);
            foreach ($this->allprd as $p){
                $best = DB::table('items')
                    ->where('prd_id','=',$p)
                    ->first();
                $this->img[$p] = $best->demoimage;
                $this->name[$p] = $best->name;
                $this->price[$p] = $best->price;
            }
            $this->size = sizeof($this->allprd);
        }
        if ($this->time == 'This month'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->get();
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
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
                    ->whereMonth('detail_invoice.created_at', '=', $now->month)
                    ->whereYear('detail_invoice.created_at', '=', $now->year)
                    ->sum('amount');
                $prod_noacc = DB::table('detail_invoice_noacc')
                    ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                    ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                    ->select('detail_invoice_noacc.*')
                    ->where('status_noacc.status','=',5)
                    ->where('detail_invoice_noacc.itemsid','=',$p)
                    ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                    ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                    ->sum('amount');
                $prod_r = DB::table('detail_invoice')
                    ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                    ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                    ->select('detail_invoice.*')
                    ->where('status.status','=',5)
                    ->where('detail_invoice.itemsid','=',$p)
                    ->whereMonth('detail_invoice.created_at', '=', $now->month)
                    ->whereYear('detail_invoice.created_at', '=', $now->year)
                    ->get();
                $prod_noacc_r = DB::table('detail_invoice_noacc')
                    ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                    ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                    ->select('detail_invoice_noacc.*')
                    ->where('status_noacc.status','=',5)
                    ->where('detail_invoice_noacc.itemsid','=',$p)
                    ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                    ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                    ->get();
                $sum = 0;
                foreach ($prod_r as $r){
                    $sum += ($r->price_one - $r->cost_one)* $r->amount;
                }
                foreach ($prod_noacc_r as $r){
                    $sum += ($r->price_one - $r->cost_one)* $r->amount;
                }
                $this->reveneu[$p] = $sum;
                $this->sold[$p] = 0;
                $this->sold[$p] += $prod;
                $this->sold[$p] += $prod_noacc;
            }
            arsort($this->sold);
            $this->allprd = array_keys($this->sold);
            foreach ($this->allprd as $p){
                $best = DB::table('items')
                    ->where('prd_id','=',$p)
                    ->first();
                $this->img[$p] = $best->demoimage;
                $this->name[$p] = $best->name;
                $this->price[$p] = $best->price;
            }
            $this->size = sizeof($this->allprd);
        }
        if ($this->time == 'This year'){
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
                $prod_r = DB::table('detail_invoice')
                    ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                    ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                    ->select('detail_invoice.*')
                    ->where('status.status','=',5)
                    ->where('detail_invoice.itemsid','=',$p)
                    ->whereYear('detail_invoice.created_at', '=', $now->year)
                    ->get();
                $prod_noacc_r = DB::table('detail_invoice_noacc')
                    ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                    ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                    ->select('detail_invoice_noacc.*')
                    ->where('status_noacc.status','=',5)
                    ->where('detail_invoice_noacc.itemsid','=',$p)
                    ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                    ->get();
                $sum = 0;
                foreach ($prod_r as $r){
                    $sum += ($r->price_one - $r->cost_one)* $r->amount;
                }
                foreach ($prod_noacc_r as $r){
                    $sum += ($r->price_one - $r->cost_one)* $r->amount;
                }
                $this->reveneu[$p] = $sum;
                $this->sold[$p] = 0;
                $this->sold[$p] += $prod;
                $this->sold[$p] += $prod_noacc;
            }
            arsort($this->sold);
            $this->allprd = array_keys($this->sold);
            foreach ($this->allprd as $p){
                $best = DB::table('items')
                    ->where('prd_id','=',$p)
                    ->first();
                $this->img[$p] = $best->demoimage;
                $this->name[$p] = $best->name;
                $this->price[$p] = $best->price;
            }
            $this->size = sizeof($this->allprd);
        }
        return view('livewire.admin.dashboard.topselling');
    }
}
