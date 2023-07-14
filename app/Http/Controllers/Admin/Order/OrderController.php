<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Detail_invoice;
use App\Models\Detail_invoice_noacc;
use App\Models\Invoice;
use App\Models\Invoice_noacc;
use App\Models\Status;
use App\Models\Status_noacc;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function customer()
    {
        return view('admin.order.customerorder');
    }

    public function guest()
    {
        return view('admin.order.guestorder');
    }

    public function show($id)
    {
        return view('admin.order.order',[
            'id' => $id
        ]);
    }

    public function offline(){
        return view('admin.order.offlineorder');
    }

    public function addOffline($id){
        return view('admin.order.addoffline',[
            'invoice_id' => $id
        ]);
    }
}
