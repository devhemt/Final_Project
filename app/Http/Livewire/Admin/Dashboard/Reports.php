<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reports extends Component
{
    public $time = 'Today';
    public $data1 = [], $data2 = [], $data3 = [];
    public $day, $month = 'none', $year = 'none';


    public function today(){
        $this->time = 'Today';
        $this->day = null;
        $this->month = 'none';
        $this->year = 'none';
    }
    public function thismonth(){
        $this->time = 'This month';
        $this->day = 'none';
        $this->month = null;
        $this->year = 'none';
    }
    public function thisyear(){
        $this->time = 'This year';
        $this->day = 'none';
        $this->month = 'none';
        $this->year = null;
    }

    public function resultDay($hour){
        $now = Carbon::now();
        $sold = DB::table('invoice_items')
            ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
            ->join('status', 'status.invoice_id','=', 'invoice.id')
            ->select('invoice_items.*')
            ->where('status.status','!=',0)
            ->where('status.status','!=',6)
            ->where('status.status','!=',7)
            ->whereTime('invoice_items.created_at', '>=', $hour.':00:00')
            ->whereTime('invoice_items.created_at', '<', ($hour+1).':00:00')
            ->whereDay('invoice_items.created_at', '=', $now->day)
            ->whereMonth('invoice_items.created_at', '=', $now->month)
            ->whereYear('invoice_items.created_at', '=', $now->year)
            ->sum('amount');
        return $sold;
    }

    public function resultMonth($day){
        $now = Carbon::now();
        $sold = DB::table('invoice_items')
            ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
            ->join('status', 'status.invoice_id','=', 'invoice.id')
            ->select('invoice_items.*')
            ->where('status.status','!=',0)
            ->where('status.status','!=',6)
            ->where('status.status','!=',7)
            ->whereDay('invoice_items.created_at', '=', $day)
            ->whereMonth('invoice_items.created_at', '=', $now->month)
            ->whereYear('invoice_items.created_at', '=', $now->year)
            ->sum('amount');
        return $sold;
    }

    public function resultYear($month){
        $now = Carbon::now();
        $sold = DB::table('invoice_items')
            ->join('invoice', 'invoice.id','=', 'invoice_items.invoice_id')
            ->join('status', 'status.invoice_id','=', 'invoice.id')
            ->select('invoice_items.*')
            ->where('status.status','!=',0)
            ->where('status.status','!=',6)
            ->where('status.status','!=',7)
            ->whereMonth('invoice_items.created_at', '=', $month)
            ->whereYear('invoice_items.created_at', '=', $now->year)
            ->sum('amount');
        return $sold;
    }

    public function render()
    {
        for ($i = 0; $i < 24; $i++) {
            $this->data1[] = $this->resultDay($i);
        }
        for ($i = 1; $i < 32; $i++) {
            $this->data2[] = $this->resultMonth($i);
        }
        for ($i = 1; $i < 13; $i++) {
            $this->data3[] = $this->resultYear($i);
        }

        return view('livewire.admin.dashboard.reports');
    }
}
