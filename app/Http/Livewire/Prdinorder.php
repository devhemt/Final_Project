<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;

class Prdinorder extends Component
{
    protected $listeners = ['mail'];
    public $idinvoice,$type;
    public $invoice,$cusdetail,$prd;
    public $top = null,$top1 = null;
    public $iddelete;
    public $email = 'thucc6696@gmail.com',$data;

    public function redirectOrder()
    {
        if(Auth::guard('user')->user()->role == 4){
            return redirect('admin/canceledorder');
        }
        if(Auth::guard('user')->user()->role == 5){
            return redirect('admin/noprocessorder');
        }
        if(Auth::guard('user')->user()->role == 6){
            return redirect('admin/confirmedorder');
        }
        if(Auth::guard('user')->user()->role == 7){
            return redirect('admin/packingorder');
        }
        if(Auth::guard('user')->user()->role == 8){
            return redirect('admin/successfulorder');
        }
        if(Auth::guard('user')->user()->role == 9){
            return redirect('admin/deliveryorder');
        }
        if(Auth::guard('user')->user()->role == 1||Auth::guard('user')->user()->role == 2){
            return redirect('admin');
        }
    }

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
        $this->redirectOrder();
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
        if ($this->type == 'Have account'){
            $deleted = DB::table('detail_invoice')
                ->where('invoice_id','=', $this->idinvoice)
                ->where('itemsid','=', $this->iddelete)
                ->delete();
        }else{
            $deleted = DB::table('detail_invoice_noacc')
                ->where('invoice_id','=', $this->idinvoice)
                ->where('itemsid','=', $this->iddelete)
                ->delete();
        }

        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }
    public function block($id){
        $this->iddelete = $id;
        $this->top = 0;
    }

    public function render()
    {
        if ($this->type == 'Have account'){
            $this->invoice = DB::table('invoice')
                ->where('invoice_id', $this->idinvoice)
                ->get();

            $this->cusdetail = DB::table('customer')
                ->where('cus_id', $this->invoice[0]->cusid)
                ->get();

            $this->prd = DB::table('detail_invoice')
                ->join('items', 'items.prd_id','=', 'detail_invoice.itemsid')
                ->where('invoice_id', $this->invoice[0]->invoice_id)
                ->get();
        }else{
            $this->invoice = DB::table('invoice_noacc')
                ->where('invoice_id', $this->idinvoice)
                ->get();

            $this->cusdetail = DB::table('customer_noacc')
                ->where('cus_id', $this->invoice[0]->cusid)
                ->get();

            $this->prd = DB::table('detail_invoice_noacc')
                ->join('items', 'items.prd_id','=', 'detail_invoice_noacc.itemsid')
                ->where('invoice_id', $this->invoice[0]->invoice_id)
                ->get();
        }



        return view('livewire.admin.prdinorder');
    }
}
