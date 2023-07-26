<?php

namespace App\Http\Livewire\Client\Cart;

use App\Models\Cart_memory;
use App\Models\Properties;
use App\Models\Purchase_items;
use App\Models\Invoice;
use App\Models\Status;
use App\Models\Invoice_items;
use App\Models\Guest;
use App\Models\Address;
use Carbon\Carbon;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Events\SendMailEvent;
use Livewire\Component;

class Truecart extends Component
{
    protected $listeners = ['loadtruecart'];
    public $resultCode;
    public $guest_cart, $customer_cart, $flag = null, $alert = null;
    public $totalquantity = 0;
    public $total,$totalpl,$discount = 0;
    public $checked = [];
    public $deliverymethod = 'Default delivery $5';
    public $options = ['Default delivery $5','Fast delivery $15','Super fast delivery $25'];
    public $momodirec  = false;


    public function loadtruecart(){}

    public function getDiscount($id){
        $now = Carbon::now();
        $sale = DB::table('sale')
            ->whereDay('begin', '<=', $now->day)
            ->whereMonth('begin', '<=', $now->month)
            ->whereYear('begin', '<=', $now->year)
            ->whereDay('end', '>=', $now->day)
            ->whereMonth('end', '>=', $now->month)
            ->whereYear('end', '>=', $now->year)
            ->get();
        $discount = 0;
        foreach ($sale as $s){
            if ($s->category_id == null && $s->customer_type == null){
                $discount += $s->discount;
            }
            if ($s->category_id != null && $s->customer_type == null){
                $cas_id = DB::table('product')
                    ->join('category', 'product.category_id','=', 'category.id')
                    ->select('category.id')
                    ->where('product.id','=',$id)
                    ->first()->id;
                if ($cas_id == $s->category_id){
                    $discount += $s->discount;
                }
            }
            if ($s->category_id == null && $s->customer_type != null){
                if (Auth::guard("customer")->check()){
                    $userId = Auth::guard("customer")->id();
                    $order = DB::table('invoice')
                        ->where('customer_id','=',$userId)
                        ->count();
                    if ($s->customer_type == 3){
                        $discount += $s->discount;
                    }else{
                        if ($s->customer_type == 2){
                            if ($order >= 1){
                                $discount += $s->discount;
                            }
                        }else{
                            if ($order >= 2){
                                $discount += $s->discount;
                            }
                        }
                    }
                }
            }
            return $discount;
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
                    $address_id = Address::where('customer_id',$userId)->where('active',1)->first()->id;
                    if (Invoice::latest()->first() == null){
                        $invoice_code = '#ORDER1';
                    }else{
                        $invoice_code = '#ORDER'.Invoice::latest()->first()->id+1;
                    }
                    $invoice = Invoice::create([
                        'customer_id' => $userId,
                        'address_id' => $address_id,
                        'invoice_code' => $invoice_code,
                        'pay' => $this->totalpl,
                        'true_pay' => $true_pay,
                        'payment' => 'cash',
                        'see' => 0,
                        'delivery' => $this->deliverymethod
                    ]);
                    $status = Status::create([
                        'invoice_id' => $invoice->id,
                        'status' => 1
                    ]);
                    foreach ($customer_cart as $c){
                        $prd_id = Properties::where('id',$c->property_id)->first()->prd_id;
                        $batch = Properties::where('prd_id',$prd_id)
                            ->where('size',$c->size)
                            ->where('color',$c->color)
                            ->get();
                        $amount = $c->amount;
                        foreach ($batch as $b){
                            if ($amount!=0){
                                if ($b->amount>0){
                                    if ($b->amount<=$amount){
                                        $amount -= $b->amount;
                                        Invoice_items::create([
                                            'property_id' => $b->id,
                                            'invoice_id' => $invoice->id,
                                            'size' => $c->size,
                                            'color' => $c->color,
                                            'amount' => $b->amount
                                        ]);
                                        $affected = Properties::where('prd_id',$prd_id)
                                            ->where('size',$c->size)
                                            ->where('color',$c->color)
                                            ->where('batch',$b->batch)
                                            ->update(['amount' => 0]);
                                    }else{
                                        Invoice_items::create([
                                            'property_id' => $b->id,
                                            'invoice_id' => $invoice->id,
                                            'size' => $c->size,
                                            'color' => $c->color,
                                            'amount' => $amount
                                        ]);
                                        $amount_before = Properties::where('prd_id',$prd_id)
                                            ->where('size',$c->size)
                                            ->where('color',$c->color)
                                            ->where('batch',$b->batch)
                                            ->first()->amount;

                                        $affected = Properties::where('prd_id',$prd_id)
                                            ->where('size',$c->size)
                                            ->where('color',$c->color)
                                            ->where('batch',$b->batch)
                                            ->update(['amount' => $amount_before-$amount]);
                                        $amount=0;
                                    }
                                }
                            }
                        }
                    }
                    $deleted = Cart_memory::where('customer_id',$userId)
                        ->where('check_buy',1)->delete();
                    $this->emit('loadsmallcart');
                    $email = Auth::guard("customer")->user()->email;
                    $prds = DB::table('invoice_items')
                        ->join('properties', 'properties.id','=', 'invoice_items.property_id')
                        ->join('product', 'product.id','=', 'properties.prd_id')
                        ->where('invoice_id', $invoice->id)
                        ->select('product.*','invoice_items.amount','invoice_items.size','invoice_items.color','properties.color_name','properties.batch')
                        ->get();
                    event(new SendMailEvent([
                        "prds" => $prds,
                        "email" => $email,
                        "order" => "Bạn đã đặt hàng thành công",
                        "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
                    ]));
                    $this->emit('mask');
                    $this->redirect('success');
                }
            }
        }else{
            $userId = Session::getId();
            $guest = Guest::where('session_id',$userId)->count();
            $guest_id = Guest::where('session_id',$userId)->first()->id;
            if ($guest>0){
                Cart::session($userId);
                if (!Cart::isEmpty()){
                    $guest_cart = Cart::getContent()->toArray();
                    $flagcountcheck = true;
                    $true_pay = 0;
                    foreach ($guest_cart as $c){
                        $prd_id = Properties::where('id',$c['id'])->first()->prd_id;
                        $check_amount = Properties::where('prd_id',$prd_id)
                            ->where('size',$c['attributes']['size'])
                            ->where('color',$c['attributes']['color'])
                            ->sum('amount');
                        if ($c['quantity'] > $check_amount){
                            $this->redirect('fail');
                            $flagcountcheck = false;
                        }
                    }
                    if ($flagcountcheck){
                        foreach ($guest_cart as $c){
                            $prd_id = Properties::where('id',$c['id'])->first()->prd_id;
                            $batch = Properties::where('prd_id',$prd_id)
                                ->where('size',$c['attributes']['size'])
                                ->where('color',$c['attributes']['color'])
                                ->get();
                            $amount = $c['quantity'];
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
                        $address_id = Address::where('guest_id',$guest_id)->where('active',1)->first()->id;
                        if (Invoice::latest()->first() == null){
                            $invoice_code = '#ORDER1';
                        }else{
                            $invoice_code = '#ORDER'.Invoice::latest()->first()->id+1;
                        }
                        $invoice = Invoice::create([
                            'guest_id' => $guest_id,
                            'address_id' => $address_id,
                            'invoice_code' => $invoice_code,
                            'pay' => $this->totalpl,
                            'true_pay' => $true_pay,
                            'payment' => 'cash',
                            'see' => 0,
                            'delivery' => $this->deliverymethod
                        ]);
                        $status = Status::create([
                            'invoice_id' => $invoice->id,
                            'status' => 1
                        ]);
                        foreach ($guest_cart as $c){
                            $prd_id = Properties::where('id',$c['id'])->first()->prd_id;
                            $batch = Properties::where('prd_id',$prd_id)
                                ->where('size',$c['attributes']['size'])
                                ->where('color',$c['attributes']['color'])
                                ->get();
                            $amount = $c['quantity'];
                            foreach ($batch as $b){
                                if ($amount!=0){
                                    $unit_price = Purchase_items::where('prd_id',$prd_id)
                                        ->where('batch',$b->batch)->first()->unit_price;
                                    if ($b->amount>0){
                                        if ($b->amount<=$amount){
                                            $true_pay+=$b->amount*$unit_price;
                                            $amount -= $b->amount;

                                            Invoice_items::create([
                                                'property_id' => $b->id,
                                                'invoice_id' => $invoice->id,
                                                'size' => $c['attributes']['size'],
                                                'color' => $c['attributes']['color'],
                                                'amount' => $b->amount
                                            ]);

                                            $affected = Properties::where('prd_id',$prd_id)
                                                ->where('size',$c['attributes']['size'])
                                                ->where('color',$c['attributes']['color'])
                                                ->where('batch',$b->batch)
                                                ->update(['amount' => 0]);
                                        }else{
                                            $true_pay+=$amount*$unit_price;

                                            Invoice_items::create([
                                                'property_id' => $b->id,
                                                'invoice_id' => $invoice->id,
                                                'size' => $c['attributes']['size'],
                                                'color' => $c['attributes']['color'],
                                                'amount' => $amount
                                            ]);

                                            $amount_before = Properties::where('prd_id',$prd_id)
                                                ->where('size',$c['attributes']['size'])
                                                ->where('color',$c['attributes']['color'])
                                                ->where('batch',$b->batch)
                                                ->first()->amount;

                                            $affected = Properties::where('prd_id',$prd_id)
                                                ->where('size',$c['attributes']['size'])
                                                ->where('color',$c['attributes']['color'])
                                                ->where('batch',$b->batch)
                                                ->update(['amount' => $amount_before-$amount]);

                                            $amount=0;
                                        }
                                    }
                                }
                            }
                        }
                        Cart::clear();
                        $this->emit('loadsmallcart');
                        $email = Guest::where('session_id',$userId)->first()->email;
                        $prds = DB::table('invoice_items')
                            ->join('properties', 'properties.id','=', 'invoice_items.property_id')
                            ->join('product', 'product.id','=', 'properties.prd_id')
                            ->where('invoice_id', $invoice->id)
                            ->select('product.*','invoice_items.amount','invoice_items.size','invoice_items.color','properties.color_name','properties.batch')
                            ->get();
                        event(new SendMailEvent([
                            "prds" => $prds,
                            "email" => $email,
                            "order" => "Bạn đã đặt hàng thành công",
                            "notify" => "This is an email notification of your order status in real time. You can track to know the status of your order. Thank you for choosing our products!"
                        ]));
                        $this->redirect('success');
                    }
                }
            }
        }
    }

    public function checkBuy($id){
        $flag = Cart_memory::where('id',$id)->first()->check_buy;
        if ($flag == 1){
            $affected = Cart_memory::where('id',$id)
                ->update(['check_buy' => 0]);
        }else{
            $affected = Cart_memory::where('id',$id)
                ->update(['check_buy' => 1]);
        }
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
        $this->totalquantity = 0;
        if (Auth::guard("customer")->check()){
            $this->flag = 0;
            $userId = Auth::guard("customer")->id();
            $this->total = 0;
            $this->customer_cart = DB::table('cart_memory')
                ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                ->join('product', 'product.id','=', 'properties.prd_id')
                ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.id','cart_memory.color','cart_memory.check_buy','cart_memory.property_id')
                ->where('cart_memory.customer_id',$userId)->get();

            $this->totalquantity = DB::table('cart_memory')
                ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                ->join('product', 'product.id','=', 'properties.prd_id')
                ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.color','cart_memory.property_id')
                ->where('cart_memory.customer_id',$userId)->count();

            foreach ($this->customer_cart as $c){
                $this->discount += ($this->getDiscount($c->id)/100) * $c->price * $c->amount;
                if ($c->check_buy == 1){
                    $this->total += $c->amount*$c->price;
                }
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

            $guest = Guest::where('session_id',$userId)->count();

            if ($guest>0){
                $this->momodirec = true;
            }else{
                $this->momodirec = false;
            }

            foreach ($this->guest_cart as $c){
                $prd_id = Properties::where('id',$c['id'])->first()->prd_id;
                $prd_price = Product::where('id', $prd_id)->first()->price;
                $this->discount += ($this->getDiscount($prd_id)/100) * $prd_price * $c['quantity'];
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
            $this->totalpl = $this->total+5 - $this->discount;
        }
        if ($this->deliverymethod == 'Fast delivery $15'){
            $this->totalpl = $this->total+15 - $this->discount;
        }
        if ($this->deliverymethod == 'Super fast delivery $25'){
            $this->totalpl = $this->total+25 - $this->discount;
        }

        return view('livewire.client.cart.truecart');
    }
}
