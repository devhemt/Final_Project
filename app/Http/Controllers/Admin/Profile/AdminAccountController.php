<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAccountController extends Controller
{
    public function showall(){
        return view('admin.account.showall');
    }

    public function index()
    {
        return view('admin.profile');
    }

    public function create()
    {
        return view('admin.account.createaccount');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|unique:user,phone',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $data = $request->all();
        $create = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        return redirect()->back();
    }

    public function login(Request $request)
    {
        if(Auth::guard('admin_account')->check()){
            return view('admin.profile');
        }

        if ($request->getMethod() == 'GET') {
            return view('admin.login');
        }

        $request->validate([
            'email' => 'required|email|exists:admin_account,email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin_account')->attempt($credentials)) {
            return redirect('admin/');
        } else {
            return redirect()->back();
        }
    }

    public function signOut() {
        Auth::guard('admin_account')->logout();
        Session::flush();
        return Redirect('admin/login');
    }
}
