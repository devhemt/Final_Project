<?php

namespace App\Http\Controllers\Client\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart_memory;
use App\Models\Detail_invoice;
use App\Models\Detail_invoice_noacc;
use App\Models\Guest;
use App\Models\Invoice;
use App\Models\Invoice_items;
use App\Models\Invoice_noacc;
use App\Models\Properties;
use App\Models\Purchase_items;
use App\Models\Status;
use App\Models\Status_noacc;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('client.cart');
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function test(Request $request){
//        if ($request->resultCode == 0)
        if ($request->resultCode == 0){
            if (Auth::guard("customer")->check()){
                $userId = Auth::guard("customer")->id();
                $check_cart = Cart_memory::where('customer_id',$userId)
                    ->where('check_buy',1)->count();
                if ($check_cart > 0){
                    $customer_cart = Cart_memory::where('customer_id',$userId)
                        ->where('check_buy',1)->get();
                    $all = DB::table('cart_memory')
                        ->join('properties', 'properties.id','=', 'cart_memory.property_id')
                        ->join('product', 'product.id','=', 'properties.prd_id')
                        ->select('product.*','cart_memory.amount','cart_memory.size','cart_memory.color','cart_memory.property_id')
                        ->where('cart_memory.customer_id',$userId)->get();
                    $flagcountcheck = true;
                    $true_pay = 0;
                    $total = 0;
                    foreach ($all as $c){
                        $total += $c->amount*$c->price;
                    }
                    foreach ($customer_cart as $c){
                        $prd_id = Properties::where('id',$c->property_id)->first()->prd_id;
                        $check_amount = Properties::where('prd_id',$prd_id)
                            ->where('size',$c->size)
                            ->where('color',$c->color)
                            ->sum('amount');
                        if ($c->amount > $check_amount){
                            return redirect('fail');
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
                        if (session('delivery') == 'Default delivery $5'){
                            $total += 5;
                        }
                        if (session('delivery') == 'Fast delivery $15'){
                            $total += 15;
                        }
                        if (session('delivery') == 'Super fast delivery $25'){
                            $total += 25;
                        }
                        $address_id = Address::where('customer_id',$userId)->where('active',1)->first()->id;
                        $invoice_code = '#ORDER'.Invoice::latest()->first()->id+1;
                        $invoice = Invoice::create([
                            'customer_id' => $userId,
                            'address_id' => $address_id,
                            'invoice_code' => $invoice_code,
                            'pay' => $total,
                            'true_pay' => $true_pay,
                            'payment' => 'momo',
                            'see' => 0,
                            'delivery' => session('delivery')
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
                        return redirect('success');
                    }
                }
            }else{
                $userId = Session::getId();
                $guest = Guest::where('session_id',$userId)->count();
                $guest_id = Guest::where('session_id',$userId)->first()->id;
                if ($guest>0){
                    Cart::session($userId);
                    $total = Cart::getTotal();
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
                                return redirect('fail');
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
                            if (session('delivery') == 'Default delivery $5'){
                                $total += 5;
                            }
                            if (session('delivery') == 'Fast delivery $15'){
                                $total += 15;
                            }
                            if (session('delivery') == 'Super fast delivery $25'){
                                $total += 25;
                            }
                            $address_id = Address::where('guest_id',$guest_id)->where('active',1)->first()->id;
                            $invoice_code = '#ORDER'.Invoice::latest()->first()->id+1;
                            $invoice = Invoice::create([
                                'guest_id' => $guest_id,
                                'address_id' => $address_id,
                                'invoice_code' => $invoice_code,
                                'pay' => $total,
                                'true_pay' => $true_pay,
                                'payment' => 'momo',
                                'see' => 0,
                                'delivery' => session('delivery')
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
                            return redirect('success');
                        }
                    }
                }else{
                    return redirect('fail');
                }
            }
        }
        return redirect()->to('cart');
    }

    public function store(Request $request)
    {
        session(['delivery' => $request->delivery]);

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->get('amount')*23000;
        $orderId = time() ."";
        $redirectUrl = "http://127.0.0.1:8000/test";
        $ipnUrl = "http://127.0.0.1:8000/test";
        $extraData = "";



        $requestId = time() . "";
        $requestType = "payWithATM";
//        $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
//        header('Location: ' . $jsonResult['payUrl']);
    }
}
