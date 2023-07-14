<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Product;
use App\Models\Properties;
use Livewire\Component;

class Offline extends Component
{
    public $invoice_id;
    public $outputBox = 'none', $oldBox = null;
    public $search, $result = [];
    public $infor,$flag = false;
    public $size = 'XXS',$color,$amount;

    public function addCart(){
        if ($this->size == null || $this->color == null || $this->amount == null){
            $this->addError('check', 'Hãy điền đầy đủ thông tin');
        }else{
            $record = Properties::where('size',$this->size)->where('color_name','like','%'.str_replace(' ', '',$this->color).'%')->count();
            if ($record == 0){
                $this->addError('check', 'Không tìm thấy sản phẩm phù hợp');
            }else{
                $total = Properties::where('size',$this->size)->where('color_name','like','%'.str_replace(' ', '',$this->color).'%')->sum('amount');
                if ($total > $this->amount){

                }else{
                    $this->addError('check', 'Số lượng vượt quá định mức');
                }
            }
        }
    }

    public function show($id){
        $this->infor = Product::where('id',$id)->first();
        $this->flag = true;
        $this->search = null;
        $this->outputBox = 'none';
    }

    public function cancelAdd(){
        $this->search = null;
        $this->oldBox = 'none';
    }

    public function updated($search)
    {
        if ($this->search != null && $this->search != ''){
            $this->outputBox = 'block';
            $this->result = Product::where('name','like','%'.str_replace(' ', '',$this->search).'%')
                ->orderByDesc('id')
                ->get();
        }else{
            $this->outputBox = 'none';
        }
    }

    public function addProduct(){
        $this->oldBox = 0;
    }

    public function render()
    {
        return view('livewire.admin.order.offline');
    }
}
