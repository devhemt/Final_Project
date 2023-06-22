<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Customerscard extends Component
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
            $product = DB::table('customer')
                ->whereDay('created_at', '=', $now->day)
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc = DB::table('customer_noacc')
                ->whereDay('created_at', '=', $now->day)
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $amount = $product+$productnoacc;

            $product1 = DB::table('customer')
                ->whereDay('created_at', '=', $now->day-1)
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc1 = DB::table('customer_noacc')
                ->whereDay('created_at', '=', $now->day-1)
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $amount1 = $product1+$productnoacc1;

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
                $this->status = 'no new customers yesterday';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no new customers today';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no new customers yesterday and today';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        if ($this->time == 'This month'){
            $now = Carbon::now();
            $product = DB::table('customer')
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc = DB::table('customer_noacc')
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $amount = $product+$productnoacc;

            $product1 = DB::table('customer')
                ->whereMonth('created_at', '=', $now->month-1)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc1 = DB::table('customer_noacc')
                ->whereMonth('created_at', '=', $now->month-1)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $amount1 = $product1+$productnoacc1;

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
                $this->status = 'no new customers last month';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no new customers this month';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no new customers last month and this month';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        if ($this->time == 'This year'){
            $now = Carbon::now();
            $product = DB::table('customer')
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc = DB::table('customer_noacc')
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $amount = $product+$productnoacc;

            $product1 = DB::table('customer')
                ->whereYear('created_at', '=', $now->year-1)
                ->count();
            $productnoacc1 = DB::table('customer_noacc')
                ->whereYear('created_at', '=', $now->year-1)
                ->count();
            $amount1 = $product1+$productnoacc1;

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
                $this->status = 'no new customers last year';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no new customers this year';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no new customers last year and this year';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        return view('livewire.admin.dashboard.customerscard');
    }
}
