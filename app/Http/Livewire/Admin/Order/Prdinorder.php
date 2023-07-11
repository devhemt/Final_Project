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
use App\Models\Status;
use App\Models\Properties;

class Prdinorder extends Component
{
    protected $listeners = ['mail'];
    public $idinvoice;
    public $invoice,$cusdetail,$prd;
    public $top = null;
    public $email = 'thucc6696@gmail.com',$data,$address,$status,$status_number;

    public function fail(){
        $affected = Status::where('invoice_id', $this->idinvoice)
            ->update(['status' => 6]);
    }
    public function return(){
        $affected = Status::where('invoice_id', $this->idinvoice)
            ->update(['status' => 7]);
    }
    public function delivery(){
        $affected = Status::where('invoice_id', $this->idinvoice)
            ->update(['status' => 4]);
    }

    public function forward(){
        $invoice_status = DB::table('invoice')
            ->join('status', 'invoice.id','=', 'status.invoice_id')
            ->where('invoice.id', $this->idinvoice)
            ->first();


        if ($invoice_status->status != 0 && $invoice_status->status != 5 && $invoice_status->status != 6 && $invoice_status->status != 7){
            $affected = Status::where('invoice_id', $this->idinvoice)
                ->update(['status' => ($invoice_status->status+1)]);
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
        if ($invoice_status->customer_id != null){
            $this->email = Customer::where('id',$invoice_status->customer_id)->first()->email;
        }else{
            $this->email = Guest::where('id',$invoice_status->guest_id)->first()->email;
        }
        $this->emit('mask');
    }
    public function back(){
        $invoice_status = DB::table('invoice')
            ->join('status', 'invoice.id','=', 'status.invoice_id')
            ->where('invoice.id', $this->idinvoice)
            ->first();


        if ($invoice_status->status != 0 && $invoice_status->status != 1 && $invoice_status->status != 6 && $invoice_status->status != 7){
            $affected = Status::where('invoice_id', $this->idinvoice)
                ->update(['status' => ($invoice_status->status-1)]);
        }
        if ($invoice_status->status == 5){
            $this->data = [
                "order" => "Your order was comfirmed",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->status == 2){
            $this->data = [
                "order" => "Your order is pending",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->status == 3){
            $this->data = [
                "order" => "Your order is confirmed",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->status == 4){
            $this->data = [
                "order" => "Your order is packing",
                "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
            ];
        }
        if ($invoice_status->customer_id != null){
            $this->email = Customer::where('id',$invoice_status->customer_id)->first()->email;
        }else{
            $this->email = Guest::where('id',$invoice_status->guest_id)->first()->email;
        }
        $this->emit('mask');
    }

    public function mail(){
        Mail::to($this->email)->send(new MailNotify($this->data));
        $this->emit('done');
    }

    public function yes(){
        $items = Invoice_items::where('invoice_id', $this->idinvoice)->get();

        foreach ($items as $item){
            $current = Properties::where('id',$item->property_id)->first()->amount;
            $affected = Properties::where('id', $item->property_id)
                ->update(['amount' => $current+$item->amount]);
        }

        $affected = Status::where('invoice_id', $this->idinvoice)
            ->update(['status' => 0]);
        $this->top = null;
        $this->data = [
            "order" => "Your order was canceled",
            "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
        ];
        $this->emit('mask');
    }
    public function no(){
        $this->top = null;
    }
    public function block(){
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
        $this->status_number = Status::where('invoice_id', $this->idinvoice)->first()->status;
        switch ($this->status_number){
            case "1":
                $this->status = "Pending";
                break;
            case "2":
                $this->status = "Confirmed";
                break;
            case "3":
                $this->status = "Packing";
                break;
            case "4":
                $this->status = "Delivery";
                break;
            case "5":
                $this->status = "Delivered";
                break;
            case "6":
                $this->status = "Delivery failed";
                break;
            case "7":
                $this->status = "Return";
                break;
            case "0":
                $this->status = "Cancelled";
                break;
        }
        $address = Address::where('id', $this->invoice->address_id)->first();
        $this->address = $this->getAddress($address->province,$address->district,$address->wards);

        if($this->invoice->guest_id == null){
            $this->cusdetail = Customer::where('id', $this->invoice->customer_id)
                ->first();
            $this->email = Customer::where('id', $this->invoice->customer_id)->first()->email;
        }else{
            $this->cusdetail = Guest::where('id', $this->invoice->guest_id)
                ->first();
            $this->email = Guest::where('id', $this->invoice->guest_id)->first()->email;
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
