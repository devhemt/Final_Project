<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Salescard extends Component
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
        $now = Carbon::now();
        if ($this->time == 'Today'){
            $current_product = DB::table('invoice_items')
                ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.id')
                ->select('invoice_items.*')
                ->where('status.status','!=',0)
                ->where('status.status','!=',6)
                ->where('status.status','!=',7)
                ->whereDay('invoice_items.created_at', '=', $now->day)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->sum('amount');

            $yesterday_product = DB::table('invoice_items')
                ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.id')
                ->select('invoice_items.*')
                ->where('status.status','!=',0)
                ->where('status.status','!=',6)
                ->where('status.status','!=',7)
                ->whereDay('invoice_items.created_at', '=', $now->day - 1)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->sum('amount');

            if ($current_product!=0 && $yesterday_product !=0){
                if ($current_product > $yesterday_product){
                    $this->percent = (($current_product-$yesterday_product)/$yesterday_product)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($current_product == $yesterday_product){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($current_product < $yesterday_product){
                    $this->percent = (($yesterday_product-$current_product)/$yesterday_product)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($current_product != 0 && $yesterday_product ==0){
                $this->percent= 100;
                $this->status = 'no sales yesterday';
                $this->class = 'text-success';
            }
            if ($current_product == 0 && $yesterday_product !=0){
                $this->percent= 0;
                $this->status = 'no sales today';
                $this->class = 'text-danger';
            }
            if ($current_product == 0 && $yesterday_product ==0){
                $this->percent= 0;
                $this->status = 'no sales yesterday and today';
                $this->class = 'text-success';
            }
            $this->amount=$current_product;
        }
        if ($this->time == 'This month'){
            $current_product = DB::table('invoice_items')
                ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.id')
                ->select('invoice_items.*')
                ->where('status.status','!=',0)
                ->where('status.status','!=',6)
                ->where('status.status','!=',7)
                ->whereMonth('invoice_items.created_at', '=', $now->month)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->sum('amount');

            $yesterday_product = DB::table('invoice_items')
                ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.id')
                ->select('invoice_items.*')
                ->where('status.status','!=',0)
                ->where('status.status','!=',6)
                ->where('status.status','!=',7)
                ->whereMonth('invoice_items.created_at', '=', $now->month - 1)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->sum('amount');

            if ($current_product!=0 && $yesterday_product !=0){
                if ($current_product > $yesterday_product){
                    $this->percent = (($current_product-$yesterday_product)/$yesterday_product)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($current_product == $yesterday_product){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($current_product < $yesterday_product){
                    $this->percent = (($yesterday_product-$current_product)/$yesterday_product)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($current_product != 0 && $yesterday_product ==0){
                $this->percent= 100;
                $this->status = 'no sales last month';
                $this->class = 'text-success';
            }
            if ($current_product == 0 && $yesterday_product !=0){
                $this->percent= 0;
                $this->status = 'no sales this month';
                $this->class = 'text-danger';
            }
            if ($current_product == 0 && $yesterday_product ==0){
                $this->percent= 0;
                $this->status = 'no sales last month and this month';
                $this->class = 'text-success';
            }
            $this->amount=$current_product;
        }
        if ($this->time == 'This year'){
            $current_product = DB::table('invoice_items')
                ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.id')
                ->select('invoice_items.*')
                ->where('status.status','!=',0)
                ->where('status.status','!=',6)
                ->where('status.status','!=',7)
                ->whereYear('invoice_items.created_at', '=', $now->year)
                ->sum('amount');

            $yesterday_product = DB::table('invoice_items')
                ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.id')
                ->select('invoice_items.*')
                ->where('status.status','!=',0)
                ->where('status.status','!=',6)
                ->where('status.status','!=',7)
                ->whereYear('invoice_items.created_at', '=', $now->year - 1)
                ->sum('amount');

            if ($current_product!=0 && $yesterday_product !=0){
                if ($current_product > $yesterday_product){
                    $this->percent = (($current_product-$yesterday_product)/$yesterday_product)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($current_product == $yesterday_product){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($current_product < $yesterday_product){
                    $this->percent = (($yesterday_product-$current_product)/$yesterday_product)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($current_product != 0 && $yesterday_product ==0){
                $this->percent= 100;
                $this->status = 'no sales last year';
                $this->class = 'text-success';
            }
            if ($current_product == 0 && $yesterday_product !=0){
                $this->percent= 0;
                $this->status = 'no sales this year';
                $this->class = 'text-danger';
            }
            if ($current_product == 0 && $yesterday_product ==0){
                $this->percent= 0;
                $this->status = 'no sales last year and this year';
                $this->class = 'text-success';
            }
            $this->amount=$current_product;
        }
        return view('livewire.admin.dashboard.salescard');
    }
}
