<?php

namespace App\Http\Livewire\Client\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Comments;

class Comment extends Component
{
    public $prd_id;
    public $cmt,$count;
    public $comments;

    protected $rules = [
        'cmt'=> 'required|max:300'
    ];

    public function updated($cmt)
    {
        $this->validateOnly($cmt);
    }

    public function addCmt(){
        $validatedData = $this->validate();
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            $checkcmt = Comments::where('prd_id', $this->prd_id)
                ->where('customer_id', $userId)
                ->first();
            $checkitem = DB::table('invoice')
                ->join('invoice_items', 'invoice.id','=', 'invoice_items.invoice_id')
                ->join('properties', 'invoice_items.property_id','=', 'properties.id')
                ->where('properties.prd_id', $this->prd_id)
                ->where('invoice.customer_id', $userId)
                ->first();
            if ($checkcmt != null){
                $this->addError('noacc', 'You have commented on this product.');
            }
            if ($checkitem == null){
                $this->addError('noacc', 'You have never purchased this product.');
            }
            if ($checkitem != null && $checkcmt == null){
                $cmtin = Comments::create([
                    'prd_id' => $this->prd_id,
                    'customer_id' => $userId,
                    'status' => 0,
                    'comment' => $this->cmt
                ]);
                $this->cmt == null;
            }
        }else{
            $this->addError('noacc', 'You do not have account.');
        }

    }

    public function render()
    {
        $this->comments = DB::table('comments')
            ->join('customer', 'comments.customer_id','=', 'customer.id')
            ->select('comments.*','customer.name')
            ->where('prd_id','=', $this->prd_id)
            ->where('comments.status', '=', 1)
            ->latest()->limit(5)->get();

        $this->count = DB::table('comments')
            ->join('customer', 'comments.customer_id','=', 'customer.id')
            ->select('comments.*','customer.name')
            ->where('prd_id','=', $this->prd_id)
            ->count();

        return view('livewire.client.product.comment');
    }
}
