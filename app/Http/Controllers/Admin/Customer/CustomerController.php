<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function create()
    {
        return view('admin.customer.create');
    }

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

    public function show($type){
        if ($type == 1){
            $customers = DB::table('customer')
                ->join('address', 'address.customer_id' , '=' ,'customer.id')
                ->leftJoin('invoice', 'customer.id', '=', 'invoice.customer_id')
                ->select(
                    'address.id as address_id',
                    'customer.name',
                    'customer.id',
                    'customer.email',
                    'customer.phone',
                    'customer.created_at',
                    DB::raw('COUNT(invoice.id) as invoices_count')
                )
                ->groupBy(
                    'address.id',
                    'customer.name',
                    'customer.id',
                    'customer.email',
                    'customer.phone',
                    'customer.created_at'
                )
                ->havingRaw('COUNT(invoice.id) >= 2')
                ->get();
        }
        if ($type == 2){
            $customers = DB::table('customer')
                ->join('address', 'address.customer_id' , '=' ,'customer.id')
                ->leftJoin('invoice', 'customer.id', '=', 'invoice.customer_id')
                ->select(
                    'address.id as address_id',
                    'customer.name',
                    'customer.id',
                    'customer.email',
                    'customer.phone',
                    'customer.created_at',
                    DB::raw('COUNT(invoice.id) as invoices_count')
                )
                ->groupBy(
                    'address.id',
                    'customer.name',
                    'customer.id',
                    'customer.email',
                    'customer.phone',
                    'customer.created_at'
                )
                ->havingRaw('COUNT(invoice.id) = 1')
                ->get();
        }
        if ($type == 3){
            $customers = DB::table('customer')
                ->join('address', 'address.customer_id' , '=' ,'customer.id')
                ->leftJoin('invoice', 'customer.id', '=', 'invoice.customer_id')
                ->select(
                    'address.id as address_id',
                    'customer.name',
                    'customer.id',
                    'customer.email',
                    'customer.phone',
                    'customer.created_at',
                    DB::raw('COUNT(invoice.id) as invoices_count')
                )
                ->groupBy(
                    'address.id',
                    'customer.name',
                    'customer.id',
                    'customer.email',
                    'customer.phone',
                    'customer.created_at'
                )
                ->havingRaw('COUNT(invoice.id) = 0')
                ->get();
        }
        $address = [];
        foreach ($customers as $customer){
            $infor = Address::where('id',$customer->address_id)->first();
            $address[$customer->id] = $this->getAddress($infor->province,$infor->district,$infor->wards);
        }
        return view('admin.customer.showcustomer',[
            'type' => $type,
            'customers' => $customers,
            'address' => $address
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'required|numeric|unique:customer,phone|digits_between:1,20',
            'password' => 'required|min:6',
            "city" => "required|numeric",
            "district" => "required|numeric",
            "ward" => "required|numeric",
            "detailed_address" => 'required',
        ]);

        $data = $request->all();
        $cus = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'])
        ]);

        Address::create([
            'customer_id' => $cus->id,
            'active' => 1,
            'province' => $data['city'],
            'district' => $data['district'],
            'wards' => $data['ward'],
            'detailed_address' => $data['detailed_address']
        ]);

        return redirect('admin');
    }
}
