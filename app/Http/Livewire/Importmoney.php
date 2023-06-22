<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Importmoney extends Component
{
    public $time = 'Today';
    public $amount, $percent, $status, $class;

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
        if ($this->time == 'Today'){
            $now = Carbon::now();
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
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount*$p->price_one;
            }
            foreach ($productnoacc as $p){
                $amount += $p->amount*$p->price_one;
            }
            $product1 = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereDay('detail_invoice.created_at', '=', $now->day-1)
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->get();
            $productnoacc1 = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereDay('detail_invoice_noacc.created_at', '=', $now->day-1)
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->get();
            $amount1 = 0;
            foreach ($product1 as $p){
                $amount1 += $p->amount*$p->price_one;
            }
            foreach ($productnoacc1 as $p){
                $amount1 += $p->amount*$p->price_one;
            }
            if ($amount!=0 && $amount1 !=0){
                if ($amount > $amount1){
                    $this->percent = (($amount-$amount1)/$amount1)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($amount == $amount1){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($amount < $amount1){
                    $this->percent = (($amount1-$amount)/$amount1)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($amount != 0 && $amount1 ==0){
                $this->percent= 100;
                $this->status = 'no sales yesterday';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no sales today';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no sales yesterday and today';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        if ($this->time == 'This month'){
            $now = Carbon::now();
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
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount*$p->price_one;
            }
            foreach ($productnoacc as $p){
                $amount += $p->amount*$p->price_one;
            }
            $product1 = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereMonth('detail_invoice.created_at', '=', $now->month-1)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->get();
            $productnoacc1 = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month-1)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->get();
            $amount1 = 0;
            foreach ($product1 as $p){
                $amount1 += $p->amount*$p->price_one;
            }
            foreach ($productnoacc1 as $p){
                $amount1 += $p->amount*$p->price_one;
            }
            if ($amount!=0 && $amount1 !=0){
                if ($amount > $amount1){
                    $this->percent = (($amount-$amount1)/$amount1)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($amount == $amount1){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($amount < $amount1){
                    $this->percent = (($amount1-$amount)/$amount1)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($amount != 0 && $amount1 ==0){
                $this->percent= 100;
                $this->status = 'no sales last month';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no sales this month';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no sales last month and this month';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        if ($this->time == 'This year'){
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
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount*$p->price_one;
            }
            foreach ($productnoacc as $p){
                $amount += $p->amount*$p->price_one;
            }
            $product1 = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereYear('detail_invoice.created_at', '=', $now->year-1)
                ->get();
            $productnoacc1 = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year-1)
                ->get();
            $amount1 = 0;
            foreach ($product1 as $p){
                $amount1 += $p->amount*$p->price_one;
            }
            foreach ($productnoacc1 as $p){
                $amount1 += $p->amount*$p->price_one;
            }
            if ($amount!=0 && $amount1 !=0){
                if ($amount > $amount1){
                    $this->percent = (($amount-$amount1)/$amount1)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($amount == $amount1){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($amount < $amount1){
                    $this->percent = (($amount1-$amount)/$amount1)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($amount != 0 && $amount1 ==0){
                $this->percent= 100;
                $this->status = 'no sales last year';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no sales this year';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no sales last year and this year';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        return view('livewire.admin.dashboard.importmoney');
    }
}
