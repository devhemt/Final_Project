<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Showproduct extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $total;
    public $top = null;
    public $iddelete;


    public function yes(){
        $affected = Product::where('id', $this->iddelete)
            ->update(['sell' => 0]);
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
        $this->total = Product::count();
        return view('livewire.admin.product.showproduct',[
            'products' => Product::join(
                DB::raw('(SELECT prd_id, SUM(amount) AS total_amount FROM properties GROUP BY prd_id) prop'),
                'product.id',
                '=',
                'prop.prd_id'
            )
                ->where('status',1)
                ->orderBy('prop.total_amount', 'ASC')
                ->select('product.*','prop.total_amount')
                ->paginate(10),
        ]);
    }
}
