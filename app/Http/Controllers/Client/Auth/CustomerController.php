<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Guest;
use App\Models\Address;


class CustomerController extends Controller
{
    public function view($id){
        return view('client.order',[
            'id' => $id
        ]);
    }

    public function login(Request $request)
    {
        if(Auth::guard('customer')->check()){
            return view('client.account');
        }

        if ($request->getMethod() == 'GET') {
            return view('client.auth.login');
        }

        $request->validate([
            'email' => 'required|email|exists:customer,email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect()->back();
        }
    }

    public function registration()
    {
        return view('client.auth.create_acc');
    }

    public function customRegistration(Request $request)
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
        $check = $this->create($data);

        return redirect('login');
    }

    public function create(array $data)
    {
        $cus = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'])
        ]);

        Address::create([
            'customer_id' => $cus->id,
            'province' => $data['city'],
            'district' => $data['district'],
            'wards' => $data['ward'],
            'detailed_address' => $data['detailed_address']
        ]);

        return true;
    }

    public function signOut() {
        Auth::guard('customer')->logout();
        Session::flush();
        return Redirect('login');
    }

    public function createGuest(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'required|numeric|unique:customer,phone|digits_between:1,20',
            "city" => "required|numeric",
            "district" => "required|numeric",
            "ward" => "required|numeric",
            "detailed_address" => 'required',
        ]);
        $data = $request->all();

        $session_id  = Session::getId();
        $guest = Guest::create([
            'session_id'=> $session_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        Address::create([
            'guest_id' => $guest->id,
            'province' => $data['city'],
            'district' => $data['district'],
            'wards' => $data['ward'],
            'detailed_address' => $data['detailed_address']
        ]);

        return redirect('cart');
    }

}
