<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Invoice_items;
use App\Models\Product;
use App\Models\Properties;
use App\Models\Purchase_items;
use App\Models\Invoice;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Livewire\Component;

class Offline extends Component
{
    public $invoice_id;
    public $outputBox = 'none', $oldBox = null, $cusBox = null, $outputCus = 'none';
    public $search, $result = [], $searchCus, $resultCus = [] , $prd, $invoice;
    public $infor,$flag = false, $customer;
    public $size = 'XXS',$color,$amount;

    public function addCart(){
        if ($this->size == null || $this->color == null || $this->amount == null){
            $this->addError('check', 'Hãy điền đầy đủ thông tin');
        }else{
            $record = Properties::where('prd_id',$this->infor->id)->where('size',$this->size)->where('color_name','like','%'.str_replace(' ', '',$this->color).'%')->count();
            if ($record == 0){
                $this->addError('check', 'Không tìm thấy sản phẩm phù hợp');
            }else{
                $total = Properties::where('prd_id',$this->infor->id)->where('size',$this->size)->where('color_name','like','%'.str_replace(' ', '',$this->color).'%')->sum('amount');
                if ($total > $this->amount){
                    $pay = $this->infor->price * $this->amount;
                    $true_pay = 0;
                    $batch = Properties::where('prd_id',$this->infor->id)
                        ->where('size',$this->size)
                        ->where('color_name','like','%'.str_replace(' ', '',$this->color).'%')
                        ->get();
                    $amount = $this->amount;
                    foreach ($batch as $b){
                        if ($amount!=0){
                            $unit_price = Purchase_items::where('prd_id',$this->infor->id)
                                ->where('batch',$b->batch)->first()->unit_price;
                            if ($b->amount>0){
                                if ($b->amount<=$amount){
                                    $true_pay+=$b->amount*$unit_price;
                                    $amount -= $b->amount;
                                }else{
                                    $true_pay+=$amount*$unit_price;
                                    $amount=0;
                                }
                            }
                        }
                    }
                    $before = Invoice::where('id',$this->invoice_id)->first();
                    $affected = Invoice::where('id',$this->invoice_id)
                        ->update(['pay' => $before->pay + $pay, 'true_pay' => $before->true_pay + $true_pay]);
                    $amount = $this->amount;
                    foreach ($batch as $b){
                        if ($amount!=0){
                            if ($b->amount>0){
                                if ($b->amount<=$amount){
                                    $amount -= $b->amount;
                                    Invoice_items::create([
                                        'property_id' => $b->id,
                                        'invoice_id' => $this->invoice_id,
                                        'size' => $b->size,
                                        'color' => $b->color,
                                        'amount' => $b->amount
                                    ]);
                                    $affected = Properties::where('prd_id',$this->infor->id)
                                        ->where('size',$b->size)
                                        ->where('color',$b->color)
                                        ->where('batch',$b->batch)
                                        ->update(['amount' => 0]);
                                }else{
                                    Invoice_items::create([
                                        'property_id' => $b->id,
                                        'invoice_id' => $this->invoice_id,
                                        'size' => $b->size,
                                        'color' => $b->color,
                                        'amount' => $amount
                                    ]);
                                    $amount_before = Properties::where('prd_id',$this->infor->id)
                                        ->where('size',$b->size)
                                        ->where('color',$b->color)
                                        ->where('batch',$b->batch)
                                        ->first()->amount;

                                    $affected = Properties::where('prd_id',$this->infor->id)
                                        ->where('size',$b->size)
                                        ->where('color',$b->color)
                                        ->where('batch',$b->batch)
                                        ->update(['amount' => $amount_before-$amount]);
                                    $amount=0;
                                }
                            }
                        }
                    }
                }else{
                    $this->addError('check', 'Số lượng vượt quá định mức');
                }
            }
        }
        $this->oldBox = 'none';
        $this->flag = false;
    }

    public function addCus($id){
        $address_id = Address::where('customer_id',$id)->where('active',1)->first()->id;
        $affected = Invoice::where('id',$this->invoice_id)
            ->update(['customer_id' => $id, 'address_id' => $address_id]);
        $this->cancelCus();
    }

    public function show($id){
        $this->infor = Product::where('id',$id)->first();
        $this->flag = true;
        $this->search = null;
        $this->outputBox = 'none';
    }
    public function cancelAdd(){
        $this->search = null;
        $this->outputBox = 'none';
        $this->oldBox = 'none';
    }
    public function cancelCus(){
        $this->searchCus = null;
        $this->outputCus = 'none';
        $this->cusBox = 'none';
    }
    public function updated($search, $searchCus)
    {
        if ($this->search != null && $this->search != ''){
            $this->outputBox = 'block';
            $this->result = Product::where('name','like','%'.str_replace(' ', '',$this->search).'%')
                ->orderByDesc('id')
                ->get();
        }else{
            $this->outputBox = 'none';
        }

        if ($this->searchCus != null && $this->searchCus != ''){
            $this->outputCus = 'block';
            $this->resultCus = Customer::where('phone','like','%'.str_replace(' ', '',$this->searchCus).'%')
                ->orderByDesc('id')
                ->get();
        }else{
            $this->outputCus = 'none';
        }
    }
    public function addProduct(){
        $this->oldBox = 0;
    }
    public function addCustomer(){
        $this->cusBox = 0;
    }

    public function render()
    {
        $this->invoice = Invoice::where('id', $this->invoice_id)->first();

        if($this->invoice->customer_id != null){
            $this->customer = Customer::where('id',$this->invoice->customer_id)->first();
        }

        $this->prd = DB::table('invoice_items')
            ->join('properties', 'properties.id','=', 'invoice_items.property_id')
            ->join('product', 'product.id','=', 'properties.prd_id')
            ->where('invoice_id', $this->invoice_id)
            ->select('product.*','invoice_items.size','invoice_items.color','invoice_items.amount','properties.batch')
            ->get();

        return view('livewire.admin.order.offline');
    }
}
