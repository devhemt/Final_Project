<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Orderclient extends Component
{
    public $orderid,$prd,$invoices,$prdid,$address;

    public function getAddress($city_id,$district_id,$warn_id){
        $jsonString = file_get_contents(public_path('data.json'));
        $data = json_decode($jsonString);
        $city = '';
        $district = '';
        $warn = '';
        foreach ($data as $d){
            if($d->Id == $city_id){
                $city = $d->Name;
                foreach ($d->Districts as $di){
                    if ($di->Id == $district_id){
                        $district = $di->Name;
                        foreach ($di->Wards as $w){
                            if ($w->Id == $warn_id){
                                $warn = $w->Name;
                            }
                        }
                    }
                }
            }
        }

        return [$city,$district,$warn];
    }

    public function render()
    {
        $this->invoices = DB::table('invoice')
            ->where('id', $this->orderid)
            ->get();
        $address_id = DB::table('invoice')
            ->where('id', $this->orderid)
            ->first()->address_id;
        $address = Address::where('id', $address_id)->first();
        $this->address = $this->getAddress($address->province,$address->district,$address->wards);

        $this->prd = DB::table('invoice_items')
            ->join('properties', 'properties.id','=', 'invoice_items.property_id')
            ->join('product', 'product.id','=', 'properties.prd_id')
            ->where('invoice_id', $this->orderid)
            ->select('product.*','invoice_items.amount','invoice_items.size','invoice_items.color','properties.batch')
            ->get();
        return view('livewire.client.order.orderclient');
    }
}
