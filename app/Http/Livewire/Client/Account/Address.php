<?php

namespace App\Http\Livewire\Client\Account;

use App\Models\Admin_account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Customer;

class Address extends Component
{
    public $current_password, $new_password, $new_password_confirmation;
    public $address,$user, $addressArr = [];
    public $city,$district,$ward,$detailed_address;
    public $new_name,$new_email,$new_phone;

    protected $rules = [
        "city" => "required|numeric",
        "district" => "required|numeric",
        "ward" => "required|numeric",
        "detailed_address" => 'required',
    ];

    public function save(){
        $this->validate();
        $auth = Auth::guard('customer')->user();
        \App\Models\Address::create([
            'customer_id' => $auth->id,
            'active' => 0,
            'province' => $this->city,
            'district' => $this->district,
            'wards' => $this->ward,
            'detailed_address' => $this->detailed_address
        ]);
        $this->addError('success_add', 'Create New Address Successfully.');
    }

    public function chose($addressId){
        $auth = Auth::guard('customer')->user();
        $affected = \App\Models\Address::where('id', $addressId)
            ->update(['active' => 1]);
        $this->address = \App\Models\Address::where('customer_id',$auth->id)->get();
        foreach ($this->address as $a){
            $affected = \App\Models\Address::where('id','!=', $addressId)
                ->where('customer_id',$auth->id)
                ->update(['active' => 0]);
        }
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

    public function changeInfor(){
        if ($this->new_name != null && $this->new_name != ''){
            $this->validate([
                'new_name' => 'max:200'
            ]);
        }
        if ($this->new_email != null && $this->new_email != ''){
            $this->validate([
                'new_email' => 'max:200|email|unique:customer,email'
            ]);
        }
        if ($this->new_phone != null && $this->new_phone != ''){
            $this->validate([
                'new_phone' => 'numeric|unique:customer,phone|digits_between:1,10'
            ]);
        }
        $auth = Auth::guard('customer')->user();
        $user =  Customer::find($auth->id);
        if ($this->new_name != null && $this->new_name != ''){
            $user->name =  $this->new_name;
        }
        if ($this->new_email != null && $this->new_email != ''){
            $user->email =  $this->new_email;
        }
        if ($this->new_phone != null && $this->new_phone != ''){
            $user->phone =  $this->new_phone;
        }
        $user->save();
        $this->addError('success_infor', 'Password Changed Successfully.');
    }

    public function changePasswordSave()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|min:8|string|max:200'
        ]);

        $auth = Auth::guard('customer')->user();

        if (!Hash::check($this->current_password, $auth->password))
        {
            $this->addError('psmatchs', 'Current Password is Invalid.');
        }

        if (strcmp($this->current_password, $this->new_password) == 0)
        {
            $this->addError('cpsamenp', 'New Password cannot be same as your current password.');
        }

        if ($this->new_password != $this->new_password_confirmation)
        {
            $this->addError('confirm', 'The re-entered password does not match the new password.');
        }
        if ($this->new_password == $this->new_password_confirmation && Hash::check($this->current_password, $auth->password) && strcmp($this->current_password, $this->new_password) != 0){
            $user =  Customer::find($auth->id);
            $user->password =  Hash::make($this->new_password);
            $user->save();
            $this->addError('success', 'Password Changed Successfully.');
        }
    }
    public function render()
    {
        $auth = Auth::guard('customer')->user();
        $this->user =  Customer::find($auth->id);
        $this->address = \App\Models\Address::where('customer_id',$auth->id)->get();
        foreach ($this->address as $a){
            $this->addressArr[$a->id] = $this->getAddress($a->province,$a->district,$a->wards);
        }
        return view('livewire.client.account.address');
    }
}
