<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reports extends Component
{
    public $time = 'Today';
    public $charttime, $sales, $revenue, $customers ;
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

    public function resultDay($hour,$type){
        $now = Carbon::now();
        if ($type == 'sales'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereDay('detail_invoice.created_at', '=', $now->day)
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->whereTime('detail_invoice.created_at', '<=', $hour.':00:00')
                ->whereTime('detail_invoice.created_at', '>', ($hour-4).':00:00')
                ->sum('amount');
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereTime('detail_invoice_noacc.created_at', '<=', $hour.':00:00')
                ->whereTime('detail_invoice_noacc.created_at', '>', ($hour-4).':00:00')
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->whereDay('detail_invoice_noacc.created_at', '=', $now->day)
                ->sum('amount');
            return $product+$productnoacc;
        }
        if ($type == 'revenue'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereTime('detail_invoice.created_at', '<=', $hour.':00:00')
                ->whereTime('detail_invoice.created_at', '>', ($hour-4).':00:00')
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->whereDay('detail_invoice.created_at', '=', $now->day)
                ->get();
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereTime('detail_invoice_noacc.created_at', '<=', $hour.':00:00')
                ->whereTime('detail_invoice_noacc.created_at', '>', ($hour-4).':00:00')
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                ->whereDay('detail_invoice_noacc.created_at', '=', $now->day)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->get();
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount*$p->price_one;
            }
            foreach ($productnoacc as $p){
                $amount += $p->amount*$p->price_one;
            }
            return $amount;
        }
        if ($type == 'customers'){
            $product = DB::table('customer')
                ->whereTime('created_at', '<=', $hour.':00:00')
                ->whereTime('created_at', '>', ($hour-4).':00:00')
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->whereDay('created_at', '=', $now->day)
                ->count();
            $productnoacc = DB::table('customer_noacc')
                ->whereTime('created_at', '<=', $hour.':00:00')
                ->whereTime('created_at', '>', ($hour-4).':00:00')
                ->whereMonth('created_at', '=', $now->month)
                ->whereDay('created_at', '=', $now->day)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            return $product+$productnoacc;
        }
    }

    public function resultMonth($day,$type){
        $now = Carbon::now();
        if ($type == 'sales'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereDay('detail_invoice.created_at', '<=', $day)
                ->whereDay('detail_invoice.created_at', '>', ($day-5))
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->sum('amount');
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereDay('detail_invoice_noacc.created_at', '<=', $day)
                ->whereDay('detail_invoice_noacc.created_at', '>', ($day-5))
                ->whereMonth('detail_invoice_noacc.created_at', '=', $now->month)
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->sum('amount');
            return $product+$productnoacc;
        }
        if ($type == 'revenue'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereDay('detail_invoice.created_at', '<=', $day)
                ->whereDay('detail_invoice.created_at', '>', ($day-5))
                ->whereMonth('detail_invoice.created_at', '=', $now->month)
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->get();
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereDay('detail_invoice_noacc.created_at', '<=', $day)
                ->whereDay('detail_invoice_noacc.created_at', '>', ($day-5))
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
            return $amount;
        }
        if ($type == 'customers'){
            $product = DB::table('customer')
                ->whereDay('created_at', '<=', $day)
                ->whereDay('created_at', '>', ($day-5))
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc = DB::table('customer_noacc')
                ->whereDay('created_at', '<=', $day)
                ->whereDay('created_at', '>', ($day-5))
                ->whereMonth('created_at', '=', $now->month)
                ->whereYear('created_at', '=', $now->year)
                ->count();
            return $product+$productnoacc;
        }
    }

    public function resultYear($month,$type){
        $now = Carbon::now();
        if ($type == 'sales'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereMonth('detail_invoice.created_at', '<=', $month)
                ->whereMonth('detail_invoice.created_at', '>', ($month-2))
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->sum('amount');
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereMonth('detail_invoice_noacc.created_at', '<=', $month)
                ->whereMonth('detail_invoice_noacc.created_at', '>', ($month-2))
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->sum('amount');
            return $product+$productnoacc;
        }
        if ($type == 'revenue'){
            $product = DB::table('detail_invoice')
                ->join('invoice', 'invoice.invoice_id','=', 'detail_invoice.invoice_id')
                ->join('status', 'status.invoice_id','=', 'invoice.invoice_id')
                ->select('detail_invoice.*')
                ->where('status.status','=',5)
                ->whereMonth('detail_invoice.created_at', '<=', $month)
                ->whereMonth('detail_invoice.created_at', '>', ($month-2))
                ->whereYear('detail_invoice.created_at', '=', $now->year)
                ->get();
            $productnoacc = DB::table('detail_invoice_noacc')
                ->join('invoice_noacc', 'invoice_noacc.invoice_id','=', 'detail_invoice_noacc.invoice_id')
                ->join('status_noacc', 'status_noacc.invoice_id','=', 'invoice_noacc.invoice_id')
                ->select('detail_invoice_noacc.*')
                ->where('status_noacc.status','=',5)
                ->whereMonth('detail_invoice_noacc.created_at', '<=', $month)
                ->whereMonth('detail_invoice_noacc.created_at', '>', ($month-2))
                ->whereYear('detail_invoice_noacc.created_at', '=', $now->year)
                ->get();
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount*$p->price_one;
            }
            foreach ($productnoacc as $p){
                $amount += $p->amount*$p->price_one;
            }
            return $amount;
        }
        if ($type == 'customers'){
            $product = DB::table('customer')
                ->whereMonth('created_at', '<=', $month)
                ->whereMonth('created_at', '>', ($month-2))
                ->whereYear('created_at', '=', $now->year)
                ->count();
            $productnoacc = DB::table('customer_noacc')
                ->whereMonth('created_at', '<=', $month)
                ->whereMonth('created_at', '>', ($month-2))
                ->whereYear('created_at', '=', $now->year)
                ->count();
            return $product+$productnoacc;
        }
    }

    public function render()
    {
        $this->charttime1 = ["0h", "4h","8h","12h","16h","20h","24h"];
        $this->sales1 = [0,$this->resultDay(4,'sales'),$this->resultDay(8,'sales'),$this->resultDay(12,'sales'),$this->resultDay(16,'sales'),$this->resultDay(20,'sales'),$this->resultDay(24,'sales')];
        $this->revenue1 = [0,$this->resultDay(4,'revenue'),$this->resultDay(8,'revenue'),$this->resultDay(12,'revenue'),$this->resultDay(16,'revenue'),$this->resultDay(20,'revenue'),$this->resultDay(24,'revenue')];
        $this->customers1 = [0,$this->resultDay(4,'customers'),$this->resultDay(8,'customers'),$this->resultDay(12,'customers'),$this->resultDay(16,'customers'),$this->resultDay(20,'customers'),$this->resultDay(24,'customers')];

        $this->charttime2 = ["1th", "5thh","10thh","15th","20th","25th","30th"];
        $this->sales2 = [0,$this->resultMonth(5,'sales'),$this->resultMonth(10,'sales'),$this->resultMonth(15,'sales'),$this->resultMonth(20,'sales'),$this->resultMonth(25,'sales'),$this->resultMonth(30,'sales')];
        $this->revenue2 = [0,$this->resultMonth(5,'revenue'),$this->resultMonth(10,'revenue'),$this->resultMonth(15,'revenue'),$this->resultMonth(20,'revenue'),$this->resultMonth(25,'revenue'),$this->resultMonth(30,'revenue')];
        $this->customers2 = [0,$this->resultMonth(5,'customers'),$this->resultMonth(10,'customers'),$this->resultMonth(15,'customers'),$this->resultMonth(20,'customers'),$this->resultMonth(25,'customers'),$this->resultMonth(30,'customers')];

        $this->charttime3 = ['Jan', 'Feb', 'Apr', 'Jun', 'Aug', 'Oct', 'Dec'];
        $this->sales3 = [0,$this->resultYear(2,'sales'),$this->resultYear(4,'sales'),$this->resultYear(6,'sales'),$this->resultYear(8,'sales'),$this->resultYear(10,'sales'),$this->resultYear(12,'sales')];
        $this->revenue3 = [0,$this->resultYear(2,'revenue'),$this->resultYear(4,'revenue'),$this->resultYear(6,'revenue'),$this->resultYear(8,'revenue'),$this->resultYear(10,'revenue'),$this->resultYear(12,'revenue')];
        $this->customers3 = [0,$this->resultYear(2,'customers'),$this->resultYear(4,'customers'),$this->resultYear(6,'customers'),$this->resultYear(8,'customers'),$this->resultYear(10,'customers'),$this->resultYear(12,'customers')];

        return view('livewire.admin.dashboard.reports');
    }
}
