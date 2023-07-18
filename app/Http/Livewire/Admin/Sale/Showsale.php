<?php

namespace App\Http\Livewire\Admin\Sale;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class Showsale extends Component
{
    public $isShowCreate = null,$top = null,$salename,$discount,$begin_date,$begin_time,$end_date,$end_time;
    public $categories,$category,$cus_type;
    public $flag = true, $type, $delete_id;

    public function create(){
        $this->isShowCreate = 0;
    }
    public function cancelNew(){
        $this->isShowCreate = null;
    }
    public function updated($category)
    {
        if ($this->category == null || $this->category == 0){
            $this->flag = true;
        }else{
            $this->flag = false;
            $this->cus_type = null;
        }
    }

    public function createNew(){
        $timesbegin = Carbon::parse($this->begin_date.' '.$this->begin_time)->toDateTimeString();
        $timesend = Carbon::parse($this->end_date.' '.$this->end_time)->toDateTimeString();
        if ($this->category == null || $this->category == 0){
            if ($this->cus_type != null){
                Sale::create([
                    'customer_type' => $this->cus_type,
                    'sale_name' => $this->salename,
                    'discount' => $this->discount,
                    'begin' => $timesbegin,
                    'end' => $timesend
                ]);
            }else{
                Sale::create([
                    'sale_name' => $this->salename,
                    'discount' => $this->discount,
                    'begin' => $timesbegin,
                    'end' => $timesend
                ]);
            }
        }else{
            Sale::create([
                'category_id' => $this->category,
                'sale_name' => $this->salename,
                'discount' => $this->discount,
                'begin' => $timesbegin,
                'end' => $timesend
            ]);
        }


        $this->isShowCreate = null;
    }

    public function delete($id){
        $this->delete_id = $id;
        $this->top = 0;

    }
    public function yes(){
        Sale::where('id',$this->delete_id)->delete();
        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }

    public function render()
    {
        $sale = Sale::all();
        foreach ($sale as $s){
            if ($s->category_id == null && $s->customer_type == null){
                $this->type[$s->id] = 'All product';
            }
            if ($s->category_id != null && $s->customer_type == null){
                $this->type[$s->id] = 'For category';
            }
            if ($s->category_id == null && $s->customer_type != null){
                $this->type[$s->id] = 'For customer';
            }
        }
        $this->categories = $category = Category::all();
        return view('livewire.admin.sale.sale',[
            'sales' => Sale::orderByDesc('id')
                ->paginate(10),
        ]);
    }
}
