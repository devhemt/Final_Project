<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            'phone' => 'required|unique:customer,phone',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('login');
    }

    public function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function signOut() {
        Auth::guard('customer')->logout();
        Session::flush();
        return Redirect('login');
    }


}
