<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function show()
    {
        return view('admin.supplier.showsupplier');
    }
}
