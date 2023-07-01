<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Lowproduct extends Component
{
    public $lowProducts;

    public function close(){
        $this->top = null;
    }
    public function open(){
        $this->top = 0;
    }

    public function render()
    {
        $this->lowProducts = Product::join(
            DB::raw('(SELECT prd_id, SUM(amount) AS total_amount FROM properties GROUP BY prd_id) prop'),
            'product.id',
            '=',
            'prop.prd_id'
        )
            ->where('status',1)
            ->where('prop.total_amount','<=',10)
            ->orderBy('prop.total_amount', 'ASC')
            ->select('product.*','prop.total_amount')
            ->limit(5)->get();

        return view('livewire.admin.dashboard.lowproduct');
    }
}
