<?php

namespace App\Http\Livewire\Admin\Comment;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Cmt extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $options = ["1"=>"Not Show", "2"=>"Show"];
    public $type = 1;

    public function render()
    {
        if ($this->type == 1){
            return view('livewire.admin.comment.cmt',[
                'comments'=> DB::table('comments')
                    ->join('product', 'product.id','=', 'comments.prd_id')
                    ->join('customer', 'comments.customer_id','=', 'customer.id')
                    ->select('comments.comment','product.product_code','product.demo_image','customer.phone','customer.name','customer.email')
                    ->where('comments.status','=',0)
                    ->orderByDesc('comments.id')
                    ->paginate(10),
            ]);
        }else{
            return view('livewire.admin.comment.cmt',[
                'comments'=> DB::table('comments')
                    ->join('product', 'product.id','=', 'comments.prd_id')
                    ->join('customer', 'comments.customer_id','=', 'customer.id')
                    ->select('comments.comment','product.product_code','product.demo_image','customer.phone','customer.name','customer.email')
                    ->where('comments.status','=',1)
                    ->orderByDesc('comments.id')
                    ->paginate(10),
            ]);
        }
    }
}
