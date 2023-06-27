<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Invoice;

class Revenuecard extends Component
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
            $current = Invoice::whereDay('created_at', $now->day)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('pay') - Invoice::whereDay('created_at', $now->day)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('true_pay');
            $past = Invoice::whereDay('created_at', $now->day -1)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('pay') - Invoice::whereDay('created_at', $now->day -1)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('true_pay');

            if ($current!=0 && $past !=0){
                if ($current > $past){
                    $this->percent = (($current-$past)/$past)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($current == $past){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($current < $past){
                    $this->percent = (($past-$current)/$past)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($current != 0 && $past ==0){
                $this->percent= 100;
                $this->status = 'no revenue yesterday';
                $this->class = 'text-success';
            }
            if ($current == 0 && $past !=0){
                $this->percent= 0;
                $this->status = 'no revenue today';
                $this->class = 'text-danger';
            }
            if ($current == 0 && $past ==0){
                $this->percent= 0;
                $this->status = 'no revenue yesterday and today';
                $this->class = 'text-success';
            }
            $this->amount=$current;
        }
        if ($this->time == 'This month'){
            $current = Invoice::whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('pay') - Invoice::whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->sum('true_pay');
            $past = Invoice::whereMonth('created_at', $now->month - 1)
                    ->whereYear('created_at', $now->year)
                    ->sum('pay') - Invoice::whereMonth('created_at', $now->month - 1)
                    ->whereYear('created_at', $now->year)
                    ->sum('true_pay');

            if ($current!=0 && $past !=0){
                if ($current > $past){
                    $this->percent = (($current-$past)/$past)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($current == $past){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($current < $past){
                    $this->percent = (($past-$current)/$past)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($current != 0 && $past ==0){
                $this->percent= 100;
                $this->status = 'no revenue last month';
                $this->class = 'text-success';
            }
            if ($current == 0 && $past !=0){
                $this->percent= 0;
                $this->status = 'no revenue this month';
                $this->class = 'text-danger';
            }
            if ($current == 0 && $past ==0){
                $this->percent= 0;
                $this->status = 'no revenue last month and this month';
                $this->class = 'text-success';
            }
            $this->amount=$current;
        }
        if ($this->time == 'This year'){
            $current = Invoice::whereYear('created_at', $now->year)
                    ->sum('pay') - Invoice::whereYear('created_at', $now->year)
                    ->sum('true_pay');
            $past = Invoice::whereYear('created_at', $now->year - 1)
                    ->sum('pay') - Invoice::whereYear('created_at', $now->year - 1)
                    ->sum('true_pay');

            if ($current!=0 && $past !=0){
                if ($current > $past){
                    $this->percent = (($current-$past)/$past)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($current == $past){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($current < $past){
                    $this->percent = (($past-$current)/$past)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($current != 0 && $past ==0){
                $this->percent= 100;
                $this->status = 'no revenue last year';
                $this->class = 'text-success';
            }
            if ($current == 0 && $past !=0){
                $this->percent= 0;
                $this->status = 'no revenue this year';
                $this->class = 'text-danger';
            }
            if ($current == 0 && $past ==0){
                $this->percent= 0;
                $this->status = 'no revenue last year and this year';
                $this->class = 'text-success';
            }
            $this->amount=$current;
        }
        return view('livewire.admin.dashboard.revenuecard');
    }
}
