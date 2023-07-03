<?php

namespace App\Http\Livewire\Admin\Order;

use App\Mail\MailNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Invoice;
use App\Models\Guest;
use App\Models\Customer;
use App\Models\Invoice_items;
use App\Models\Address;

class Prdinorder extends Component
{
    protected $listeners = ['mail'];
    public $idinvoice,$type;
    public $invoice,$cusdetail,$prd;
    public $top = null,$top1 = null;
    public $iddelete;
    public $email = 'thucc6696@gmail.com',$data,$address;

    public function forward(){
        if ($this->type == 'Have account'){
            $invoice_status = DB::table('invoice')
                ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
                ->join('customer', 'customer.cus_id','=', 'invoice.cusid')
                ->select('invoice.*','status.status','customer.email')
                ->where('invoice.invoice_id', $this->idinvoice)
                ->first();
        }else{
            $invoice_status = DB::table('invoice_noacc')
                ->join('status_noacc', 'invoice_noacc.invoice_id','=', 'status_noacc.invoice_id')
                ->join('customer_noacc', 'customer_noacc.cus_id','=', 'invoice_noacc.cusid')
                ->select('invoice_noacc.*','status_noacc.status','customer_noacc.email')
                ->where('invoice_noacc.invoice_id', $this->idinvoice)
                ->first();
        }


        if ($invoice_status->status != 0 && $invoice_status->status != 5){
            if ($this->type == 'Have account'){
                $status = DB::table('status')
                    ->where('invoice_id','=', $this->idinvoice)
                    ->first();
                $affected = DB::table('status')
                    ->where('invoice_id','=', $this->idinvoice)
                    ->update(['status' => ($status->status+1)]);
            }else{
                $status = DB::table('status_noacc')
                    ->where('invoice_id','=', $this->idinvoice)
                    ->first();
                $affected = DB::table('status_noacc')
                    ->where('invoice_id','=', $this->idinvoice)
                    ->update(['status' => ($status->status+1)]);
            }
        }
        if ($invoice_status->status == 1){
            $this->data = [
                "order" => "Your order was comfirmed",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->status == 2){
            $this->data = [
                "order" => "Your order is packing",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->status == 3){
            $this->data = [
                "order" => "Your order is delivery",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->status == 4){
            $this->data = [
                "order" => "Your order was successful",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        $this->emit('mask');
//        $this->email = $invoice_status->email;

    }

    public function mail(){
        Mail::to($this->email)->send(new MailNotify($this->data));
//        redirect
    }

    public function yes1(){
        if ($this->type == 'Have account'){
            $invoice_status = DB::table('invoice')
                ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
                ->join('customer', 'customer.cus_id','=', 'invoice.cusid')
                ->select('invoice.*','status.status','customer.email')
                ->where('invoice.invoice_id', $this->idinvoice)
                ->first();
        }else{
            $invoice_status = DB::table('invoice_noacc')
                ->join('status_noacc', 'invoice_noacc.invoice_id','=', 'status_noacc.invoice_id')
                ->join('customer_noacc', 'customer_noacc.cus_id','=', 'invoice_noacc.cusid')
                ->select('invoice_noacc.*','status_noacc.status','customer_noacc.email')
                ->where('invoice_noacc.invoice_id', $this->idinvoice)
                ->first();
        }
        if ($this->type == 'Have account'){
            $affected = DB::table('status')
                ->where('invoice_id','=', $this->idinvoice)
                ->update(['status' => 0]);
        }else{
            $affected = DB::table('status_noacc')
                ->where('invoice_id','=', $this->idinvoice)
                ->update(['status' => 0]);
        }

        $this->data = [
            "order" => "Your order was canceled",
            "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
        ];
//        $this->email = $invoice_status->email;
        $this->emit('mask');
    }
    public function no1(){
        $this->top1 = null;
    }
    public function block1(){
        $this->top1 = 0;
    }

    public function yes(){
        $deleted = DB::table('detail_invoice')
            ->where('invoice_id','=', $this->idinvoice)
            ->where('itemsid','=', $this->iddelete)
            ->delete();
        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }
    public function block($id){
        $this->iddelete = $id;
        $this->top = 0;
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

    public function render()
    {
        $this->invoice = Invoice::where('id', $this->idinvoice)
            ->first();
        $address = Address::where('id', $this->invoice->address_id)->where('active',1)->first();
        $this->address = $this->getAddress($address->province,$address->district,$address->wards);

        if($this->invoice->guest_id == null){
            $this->cusdetail = Customer::where('id', $this->invoice->customer_id)
                ->first();
        }else{
            $this->cusdetail = Guest::where('id', $this->invoice->guest_id)
                ->first();
        }

        $this->prd = DB::table('invoice_items')
            ->join('properties', 'properties.id','=', 'invoice_items.property_id')
            ->join('product', 'product.id','=', 'properties.prd_id')
            ->where('invoice_id', $this->idinvoice)
            ->select('product.*','invoice_items.*','properties.batch')
            ->get();

        return view('livewire.admin.order.prdinorder');
    }
}
