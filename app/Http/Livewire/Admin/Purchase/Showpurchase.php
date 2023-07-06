<?php

namespace App\Http\Livewire\Admin\Purchase;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\WithPagination;

class Showpurchase extends Component
{
    use WithPagination;
    public $isShowCreate = null, $isShowEdit = null, $total = null;
    public $suppliers;
    public $purchaseCode, $totalPay = 0, $supplier;
    public $editPurchaseCode, $editSupplier;
    public $purchase_id;
    public $edittingPC;

    protected $rules = [
        'purchaseCode' => 'required|max:200|unique:purchase,purchase_code',
        'supplier' => 'required|numeric',
        'editPurchaseCode' => 'max:200|unique:purchase,purchase_code',
        'editSupplier' => 'numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create(){
        $this->reset(['purchaseCode','totalPay','supplier']);
        $this->isShowCreate = 0;
    }
    public function createNew(){
        $this->validateOnly('purchaseCode');
        $this->validateOnly('supplier_id');
        Purchase::create([
            'purchase_code' => $this->purchaseCode,
            'supplier_id' => $this->supplier,
            'total_pay' => $this->totalPay,
        ]);
        $this->isShowCreate = null;
    }
    public function editPurchase(){
        if ($this->editPurchaseCode!=null){
            $this->validateOnly('editPurchaseCode');
        }
        if ($this->editSupplier!=null){
            $this->validateOnly('editSupplier');
        }

        if ($this->editPurchaseCode!=null){
            $affected = Purchase::where('id', $this->purchase_id)
                ->update(['purchase_code' => $this->editPurchaseCode]);
        }
        if ($this->editSupplier!=null){
            $affected = Purchase::where('id', $this->purchase_id)
                ->update(['supplier_id' => $this->editSupplier]);
        }

        $this->isShowEdit = null;
    }
    public function cancelNew(){
        $this->isShowCreate = null;
    }

    public function edit($id){
        $this->purchase_id = $id;
        $editting = Purchase::where('id',$id)->first();
        $this->edittingPC = $editting->purchase_code;
        $this->reset(['editPurchaseCode','editSupplier']);
        $this->isShowEdit = 0;
    }
    public function cancelEdit(){
        $this->isShowEdit = null;
    }

    public function render()
    {
        $this->suppliers = Supplier::get();
        $this->total = Purchase::count();
        return view('livewire.admin.purchase.showpurchase',[
            'purchase' => DB::table('purchase')
                ->join('supplier', 'purchase.supplier_id','=', 'supplier.id')
                ->select('purchase.*','supplier.name')
                ->orderByDesc('purchase.id')
                ->paginate(10),
        ]);
    }
}
