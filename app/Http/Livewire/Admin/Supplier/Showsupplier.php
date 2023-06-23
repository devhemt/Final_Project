<?php

namespace App\Http\Livewire\Admin\Supplier;

use Livewire\Component;
use App\Models\Supplier;

class Showsupplier extends Component
{
    public $isShowCreate = null, $isShowEdit = null, $total = null;
    public $supplier, $supplier_id;
    public $newSupplierName,$newSupplierPhone,$newSupplierEmail,$newSupplierAddress;
    public $editSupplierName,$editSupplierPhone,$editSupplierEmail,$editSupplierAddress;
    public $name, $phone, $email, $address;

    protected $rules = [
        'newSupplierName' => 'required|max:200',
        'newSupplierPhone' => 'required|unique:supplier,phone|digits_between:1,20|numeric',
        'newSupplierEmail' => 'required|unique:supplier,email|max:200|email',
        'newSupplierAddress' => 'required',
        'editSupplierName' => 'max:200',
        'editSupplierPhone' => 'unique:supplier,phone|digits_between:1,20|numeric',
        'editSupplierEmail' => 'unique:supplier,email|max:200|email',
    ];

    public function create(){
        $this->reset(['newSupplierName', 'newSupplierAddress','newSupplierEmail','newSupplierPhone']);
        $this->isShowCreate = 0;
    }
    public function createNew(){
        $this->validateOnly('newSupplierName');
        $this->validateOnly('newSupplierAddress');
        $this->validateOnly('newSupplierEmail');
        $this->validateOnly('newSupplierPhone');
        Supplier::create([
            'name' => $this->newSupplierName,
            'phone' => $this->newSupplierPhone,
            'email' => $this->newSupplierEmail,
            'address' => $this->newSupplierAddress,
        ]);
        $this->isShowCreate = null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editSupplier(){
        if ($this->editSupplierName!=null){
            $this->validateOnly('editSupplierName');
        }
        if ($this->editSupplierEmail!=null){
            $this->validateOnly('editSupplierEmail');
        }
        if ($this->editSupplierPhone!=null){
            $this->validateOnly('editSupplierPhone');
        }
        if ($this->editSupplierName!=null){
            $affected = Supplier::where('id', $this->supplier_id)
                ->update(['name' => $this->editSupplierName]);
        }
        if ($this->editSupplierAddress!=null){
            $affected = Supplier::where('id', $this->supplier_id)
                ->update(['address' => $this->editSupplierAddress]);
        }
        if ($this->editSupplierEmail!=null){
            $affected = Supplier::where('id', $this->supplier_id)
                ->update(['email' => $this->editSupplierEmail]);
        }
        if ($this->editSupplierPhone!=null){
            $affected = Supplier::where('id', $this->supplier_id)
                ->update(['phone' => $this->editSupplierPhone]);
        }

        $this->isShowEdit = null;
    }
    public function cancelNew(){
        $this->isShowCreate = null;
    }
    public function cancelEdit(){
        $this->isShowEdit = null;
    }
    public function edit($id){
        $this->supplier_id = $id;
        $supplier = Supplier::where('id',$id)->first();
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
        $this->reset(['editSupplierName', 'editSupplierAddress','editSupplierEmail','editSupplierPhone']);
        $this->isShowEdit = 0;
    }

    public function render()
    {
        $this->supplier = Supplier::get();
        $this->total = Supplier::count();
        return view('livewire.admin.supplier.showsupplier');
    }
}
