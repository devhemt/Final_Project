<?php

namespace App\Http\Livewire\Client\Cart;

use App\Models\Cart_memory;
use App\Models\Properties;
use App\Models\Purchase_items;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Truecart extends Component
{
    protected $listeners = ['loadtruecart','setCusNoacc'];
    public $resultCode;
    public $guest_cart, $customer_cart, $flag = null, $alert = null;
    public $totalquantity = 0;
    public $total,$totalpl;
    public $checked = [];
    public $deliverymethod = 'Default delivery $5';
    public $options = ['Default delivery $5','Fast delivery $15','Super fast delivery $25'];
    public $momodirec  = false;
    public $name, $email, $phone, $address;


    public function loadtruecart(){}
    public function setCusNoacc($datas){
        $this->name = $datas[0];
        $this->email = $datas[1];
        $this->phone = $datas[2];
        $this->address = $datas[3];
        $userId = Session::getId();

        $usernoacc = DB::table('customer_noacc')
            ->where('sessionid','=',$userId)
            ->count();
        if ($usernoacc == 0){
            $cusnoacc = Customer_noacc::create([
                'sessionid'=> $userId,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address
            ]);
        }
    }

    public function deleteCartItem($itemsid){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            $deleted = Cart_memory::where('property_id', $itemsid)->delete();
        }else{
            $userId = Session::getId();
            Cart::session($userId);
            Cart::remove($itemsid);
        }
        $this->emit('loadsmallcart');
    }

    public function register(){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            $check_cart = Cart_memory::where('customer_id',$userId)
                ->where('check_buy',1)->count();
            if ($check_cart > 0){
                $customer_cart = Cart_memory::where('customer_id',$userId)
                    ->where('check_buy',1)->get();
                $flagcountcheck = true;
                $true_pay = 0;
                foreach ($customer_cart as $c){
                    $prd_id = Properties::where('id',$c->property_id)->first()->prd_id;
                    $check_amount = Properties::where('prd_id',$prd_id)
                        ->where('size',$c->size)
                        ->where('color',$c->color)
                        ->sum('amount');
                    if ($c->amount > $check_amount){
                        $this->redirect('fail');
                        $flagcountcheck = false;
                    }
                }
                if ($flagcountcheck){
                    foreach ($customer_cart as $c){
                        $prd_id = Properties::where('id',$c->property_id)->first()->prd_id;
                        $batch = Properties::where('prd_id',$prd_id)
                            ->where('size',$c->size)
                            ->where('color',$c->color)
                            ->get();
                        $amount = $c->amount;
                        foreach ($batch as $b){
                            if ($amount!=0){
                                $unit_price = Purchase_items::where('prd_id',$prd_id)
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
                    }
                }
                dd($true_pay);

                $this->redirect('success');
            }
        }else{
            if ($this->name != null && $this->email != null && $this->phone != null && $this->address != null){
//                dd($userId = Session::getId());
                $userId = Session::getId();
                Cart::session($userId);
                $this->total = Cart::getTotal();
                if (Cart::isEmpty()){
                    dd("mua hang di");
                }else{
                    $cartin = Cart::getContent()->toArray();
                    $flagcountcheck = false;
                    foreach ($cartin as $c){
                        $detail = DB::table('properties')
                            ->where('itemsid','=',$c['id'])
                            ->where('size','=',$c['attributes'][0]['size'])
                            ->where('color','=',$c['attributes'][0]['color'])
                            ->get();

                        $totalamount = 0;
                        foreach ($detail as $d){
                            $totalamount += $d->amount;
                        }
                        if ($c['quantity']>$totalamount){
                            $flagcountcheck = true;
                        }
                    }
                    if ($flagcountcheck){
                        $this->redirect('fail');
                    }
                    $usernoacc = DB::table('customer_noacc')
                        ->where('sessionid','=',$userId)
                        ->latest()
                        ->get();
                    $items = Invoice_noacc::create([
                        'cusid' => $usernoacc[0]->cus_id,
                        'pay' => $this->total,
                        'payment' => 'cash',
                        'delivery' => $this->deliverymethod
                    ]);
                    $idinvoice = DB::table('invoice_noacc')->latest('created_at')->first();
                    $status = Status_noacc::create([
                        'invoice_id'=> $idinvoice->invoice_id,
                        'status'=> 1,
                    ]);

                    foreach ($cartin as $c){
                        $prdbatch = DB::table('batch_price')
                            ->where('prdid','=',$c['id'])
                            ->get();
                        $length = count($prdbatch);
                        $check = 0;
                        $start;
                        $end;
                        $input1;
                        for ($i=1;$i<=$length;$i++){
                            $check += $this->checkBatch($c['id'],$i);
                            if ($this->checkInvoice($c['id'])<$check){
                                $start = $i;
                                $input1 = $check - $this->checkInvoice($c['id']);
                            }
                            if (($this->checkInvoice($c['id'])+$c['quantity'])<=$check){
                                $end = $i;
                                if ($start == $end){
                                    $batch1 = DB::table('batch_price')
                                        ->where('prdid','=',$c['id'])
                                        ->where('batch','=',$start)
                                        ->get();

                                    $cost1 = $batch1['0']->cost;
                                    $detail1 = Detail_invoice_noacc::create([
                                        'itemsid'=> $c['id'],
                                        'invoice_id'=> $idinvoice->invoice_id,
                                        'size'=> $c['attributes'][0]['size'],
                                        'color'=> $c['attributes'][0]['color'],
                                        'amount'=> $c['quantity'],
                                        'price_one'=> $c['price'],
                                        'cost_one'=> $cost1,
                                    ]);
                                    $change = DB::table('properties')
                                        ->where('size','=', $c['attributes'][0]['size'])
                                        ->where('color','=', $c['attributes'][0]['color'])
                                        ->where('batch','=', $start )
                                        ->decrement('amount', $c['quantity']);
                                }else{
                                    $input2 = $c['quantity'] - $input1;
                                    $batch1 = DB::table('batch_price')
                                        ->where('prdid','=',$c['id'])
                                        ->where('batch','=',$start)
                                        ->get();
                                    $cost1 = $batch1['0']->cost;
                                    $batch2 = DB::table('batch_price')
                                        ->where('prdid','=',$c['id'])
                                        ->where('batch','=',$end)
                                        ->get();
                                    $cost2 = $batch2['0']->cost;
                                    $detail1 = Detail_invoice_noacc::create([
                                        'itemsid'=> $c['id'],
                                        'invoice_id'=> $idinvoice->invoice_id,
                                        'size'=> $c['attributes'][0]['size'],
                                        'color'=> $c['attributes'][0]['color'],
                                        'amount'=> $input1,
                                        'price_one'=> $c['price'],
                                        'cost_one'=> $cost1,
                                    ]);
                                    $detail2 = Detail_invoice_noacc::create([
                                        'itemsid'=> $c['id'],
                                        'invoice_id'=> $idinvoice->invoice_id,
                                        'size'=> $c['attributes'][0]['size'],
                                        'color'=> $c['attributes'][0]['color'],
                                        'amount'=> $input2,
                                        'price_one'=> $c['price'],
                                        'cost_one'=> $cost2,
                                    ]);
                                    $change1 = DB::table('properties')
                                        ->where('size','=', $c['attributes'][0]['size'])
                                        ->where('color','=', $c['attributes'][0]['color'])
                                        ->where('batch','=', $start )
                                        ->decrement('amount', $input1);
                                    $change2 = DB::table('properties')
                                        ->where('size','=', $c['attributes'][0]['size'])
                                        ->where('color','=', $c['attributes'][0]['color'])
                                        ->where('batch','=', $end )
                                        ->decrement('amount', $input2);
                                }
                                Cart::clear();
                                $this->emit('loadsmallcart');
                                break;
                            }
                        }

                    }
                    $this->redirect('success');
                }

            }else{
                $this->emit('showTakeInfor');
            }
        }
    }

    public function momonoacc(){
        $this->emit('showTakeInfor');
    }

    public function minus($id){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            $thiscart = Cart_memory::where('customer_id',$userId)
                ->where('property_id',$id)->first();
            $minus = $thiscart->amount - 1;

            if ($minus == 0){
                $affected = Cart_memory::where('customer_id',$userId)
                    ->where('property_id',$id)
                    ->update(['amount' => 1]);
            }else{
                $prd_id = Properties::where('id',$thiscart->property_id)->first()->prd_id;
                $check_amount = Properties::where('prd_id',$prd_id)
                    ->where('size',$thiscart->size)
                    ->where('color',$thiscart->color)
                    ->sum('amount');

                if ($minus > $check_amount){
                    $this->checked[$id] = 'Sold out';
                }
                if ($minus <= $check_amount){
                    $this->checked[$id] = 'Stock';
                    $affected = Cart_memory::where('customer_id',$userId)
                        ->where('property_id',$id)
                        ->update(['amount' => $minus]);
                }
            }
        }else{
            $userId = Session::getId();
            Cart::session($userId);
            $thiscart = Cart::get($id);
            $minus = $thiscart['quantity'] - 1;

            if ($minus == 0){
                Cart::update($id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => 1
                    ),
                ));
            }else{
                $prd_id = Properties::where('id',$thiscart['id'])->first()->prd_id;
                $check_amount = Properties::where('prd_id',$prd_id)
                    ->where('size',$thiscart['attributes']['size'])
                    ->where('color',$thiscart['attributes']['color'])
                    ->sum('amount');

                if ($minus >= $check_amount){
                    $this->checked[$id] = 'Sold out';
                    Cart::update($id, array(
                        'quantity' => array(
                            'relative' => false,
                            'value' => $check_amount
                        ),
                    ));
                }
                if ($minus < $check_amount){
                    $this->checked[$id] = 'Stock';
                    Cart::update($id, array(
                        'quantity' => -1,
                    ));
                }

            }
        }
        $this->emit('loadsmallcart');
    }

    public function plus($id){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            $thiscart = Cart_memory::where('customer_id',$userId)
                ->where('property_id',$id)->first();

            $plus = $thiscart->amount + 1;

            $prd_id = Properties::where('id',$thiscart->property_id)->first()->prd_id;
            $check_amount = Properties::where('prd_id',$prd_id)
                ->where('size',$thiscart->size)
                ->where('color',$thiscart->color)
                ->sum('amount');

            if ($plus > $check_amount){
                $this->checked[$id] = 'Sold out';
            }
            if ($plus <= $check_amount){
                $this->checked[$id] = 'Stock';
                $affected = Cart_memory::where('customer_id',$userId)
                    ->where('property_id',$id)
                    ->update(['amount' => $plus]);
            }
        }else{
            $userId = Session::getId();
            Cart::session($userId);
            $thiscart = Cart::get($id);
            $plus = $thiscart['quantity'] + 1;

            $prd_id = Properties::where('id',$thiscart['id'])->first()->prd_id;
            $check_amount = Properties::where('prd_id',$prd_id)
                ->where('size',$thiscart['attributes']['size'])
                ->where('color',$thiscart['attributes']['color'])
                ->sum('amount');

            if ($plus > $check_amount){
                $this->checked[$id] = 'Sold out';
            }
            if ($plus <= $check_amount){
                $this->checked[$id] = 'Stock';
                Cart::update($id, array(
                    'quantity' => 1,
                ));

            }
        }
        $this->emit('loadsmallcart');
    }

    public function render()
    {
        alert()->warning('WarningAlert','Your cart is empty.');


        $this->totalquantity = 0;
        if (Auth::guard("customer")->check()){
            $this->flag = 0;
            $userId = Auth::guard("customer")->id();
            $this->total = 0;
            $this->customer_cart = DB::table('cart_memory')
                ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                ->join('product', 'product.id','=', 'properties.prd_id')
                ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.color','cart_memory.property_id')
                ->where('cart_memory.customer_id',$userId)->get();

            $this->totalquantity = DB::table('cart_memory')
                ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                ->join('product', 'product.id','=', 'properties.prd_id')
                ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.color','cart_memory.property_id')
                ->where('cart_memory.customer_id',$userId)->count();

            foreach ($this->customer_cart as $c){
                $this->total = $c->amount*$c->price;
                $prd_id = Properties::where('id',$c->property_id)->first()->prd_id;
                $check_amount = Properties::where('prd_id',$prd_id)
                    ->where('size',$c->size)
                    ->where('color',$c->color)
                    ->sum('amount');
                if ($c->amount>$check_amount){
                    $this->checked[$c->property_id] = 'The product in the order has exceeded the number of products left in stock';
                }
            }

            $this->momodirec = true;
        }else{
            $this->flag = 1;
            $userId = Session::getId();
            Cart::session($userId);
            $this->guest_cart = Cart::getContent()->toArray();
            $this->total = Cart::getTotal();

            foreach ($this->guest_cart as $c){
                $this->totalquantity++ ;
            }

            if ($this->name != null && $this->email != null && $this->phone != null && $this->address != null){
                $this->momodirec = true;
            }else{
                $this->momodirec = false;
            }

            foreach ($this->guest_cart as $c){
                $prd_id = Properties::where('id',$c['id'])->first()->prd_id;
                $check_amount = Properties::where('prd_id',$prd_id)
                    ->where('size',$c['attributes']['size'])
                    ->where('color',$c['attributes']['color'])
                    ->sum('amount');

                if ($c['quantity']>$check_amount){
                    $this->checked[$c['id']] = 'The product in the order has exceeded the number of products left in stock';
                }
            }
        }

        if ($this->deliverymethod == 'Default delivery $5'){
            $this->totalpl = $this->total+5;
        }
        if ($this->deliverymethod == 'Fast delivery $15'){
            $this->totalpl = $this->total+15;
        }
        if ($this->deliverymethod == 'Super fast delivery $25'){
            $this->totalpl = $this->total+25;
        }


        return view('livewire.client.cart.truecart');
    }
}
