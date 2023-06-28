<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class Recentact extends Component
{
    public $time = 'Today';
    public $data1 = [], $data2 = [], $data3 = [];
    public $day, $month , $year ;


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

    public function getCityName($city_id){
        $jsonString = file_get_contents(public_path('data.json'));
        $data = json_decode($jsonString);
        $city = '';
        foreach ($data as $d){
            if($d->Id == $city_id){
                $city = $d->Name;
            }
        }
        return $city;
    }

    public function render()
    {
        $now = Carbon::now();
        $city1 = DB::table('address')
            ->join('invoice', 'address.id', '=', 'invoice.address_id')
            ->whereDay('invoice.created_at', '=', $now->day)
            ->whereMonth('invoice.created_at', '=', $now->month)
            ->whereYear('invoice.created_at', '=', $now->year)
            ->select('address.province', DB::raw('COUNT(address.province) as city_count'))
            ->groupBy('address.province')
            ->orderByDesc('city_count')
            ->limit(5)
            ->get();
        foreach ($city1 as $c) {
            $this->data1[] = [$this->getCityName($c->province),$c->city_count];
        }
        $city2 = DB::table('address')
            ->join('invoice', 'address.id', '=', 'invoice.address_id')
            ->whereMonth('invoice.created_at', '=', $now->month)
            ->whereYear('invoice.created_at', '=', $now->year)
            ->select('address.province', DB::raw('COUNT(address.province) as city_count'))
            ->groupBy('address.province')
            ->orderByDesc('city_count')
            ->limit(5)
            ->get();
        foreach ($city2 as $c) {
            $this->data2[] = [$this->getCityName($c->province),$c->city_count];
        }
        $city3 = DB::table('address')
            ->join('invoice', 'address.id', '=', 'invoice.address_id')
            ->whereYear('invoice.created_at', '=', $now->year)
            ->select('address.province', DB::raw('COUNT(address.province) as city_count'))
            ->groupBy('address.province')
            ->orderByDesc('city_count')
            ->limit(5)
            ->get();
        foreach ($city3 as $c) {
            $this->data3[] = [$this->getCityName($c->province),$c->city_count];
        }
//        dd($this->data3);


        return view('livewire.admin.dashboard.recentact');
    }
}
