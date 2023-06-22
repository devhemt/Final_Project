<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminAccountController extends Controller
{
    public function showall(){
        return view('admin.account.showall');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.account.createaccount');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
//        Auth::guard('admin_account')->logout();
//        Session::flush();
//        return Redirect('admin/login');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
