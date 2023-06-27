<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Guest;

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
        $now = Carbon::now();
        if ($this->time == 'Today'){
            $current = Guest::whereDay('created_at', $now->day)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count() + Customer::whereDay('created_at', $now->day)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count();
            $past = Guest::whereDay('created_at', $now->day - 1)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count() + Customer::whereDay('created_at', $now->day - 1)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count();

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
                $this->status = 'no new customer yesterday';
                $this->class = 'text-success';
            }
            if ($current == 0 && $past !=0){
                $this->percent= 0;
                $this->status = 'no new customer today';
                $this->class = 'text-danger';
            }
            if ($current == 0 && $past ==0){
                $this->percent= 0;
                $this->status = 'no new customer yesterday and today';
                $this->class = 'text-success';
            }
            $this->amount=$current;
        }
        if ($this->time == 'This month'){
            $current = Guest::whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count() + Customer::whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->count();
            $past = Guest::whereMonth('created_at', $now->month - 1)
                    ->whereYear('created_at', $now->year)
                    ->count() + Customer::whereMonth('created_at', $now->month - 1)
                    ->whereYear('created_at', $now->year)
                    ->count();

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
                $this->status = 'no new customer last month';
                $this->class = 'text-success';
            }
            if ($current == 0 && $past !=0){
                $this->percent= 0;
                $this->status = 'no new customer this month';
                $this->class = 'text-danger';
            }
            if ($current == 0 && $past ==0){
                $this->percent= 0;
                $this->status = 'no new customer last month and this month';
                $this->class = 'text-success';
            }
            $this->amount=$current;
        }
        if ($this->time == 'This year'){
            $current = Guest::whereYear('created_at', $now->year)
                    ->count() + Customer::whereYear('created_at', $now->year)
                    ->count();
            $past = Guest::whereYear('created_at', $now->year - 1)
                    ->count() + Customer::whereYear('created_at', $now->year - 1)
                    ->count();

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
                $this->status = 'no new customer last year';
                $this->class = 'text-success';
            }
            if ($current == 0 && $past !=0){
                $this->percent= 0;
                $this->status = 'no new customer this year';
                $this->class = 'text-danger';
            }
            if ($current == 0 && $past ==0){
                $this->percent= 0;
                $this->status = 'no new customer last year and this year';
                $this->class = 'text-success';
            }
            $this->amount=$current;
        }
        return view('livewire.admin.dashboard.customerscard');
    }
}
