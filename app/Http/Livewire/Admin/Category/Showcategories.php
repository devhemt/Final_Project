<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class Showcategories extends Component
{
    public $isShowDelete = null, $isShowCreate = null, $isShowEdit = null, $total = null;
    public $category;
    public $iddelete, $idedit,$newCategory, $editCategory, $flag;

    protected $rules = [
        'newCategory' => 'required|unique:category,category_name',
        'editCategory' => 'unique:category,category_name'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit($id){
        $this->idedit = $id;
        $this->flag = Category::where('id',$id)->first()->category_name;
        $this->isShowEdit = 0;
    }
    public function editOld(){
        $this->validateOnly('editCategory');
        if ($this->editCategory != null && $this->editCategory != ''){
            $affected = Category::where('id', $this->idedit)
                ->update(['category_name' => $this->editCategory]);
        }
    }
    public function cancelEdit(){
        $this->isShowEdit = null;
    }

    public function yesDelete(){
        $affected = Category::where('id', $this->iddelete)
            ->update(['block' => 0]);
        $this->isShowDelete = null;
    }
    public function noDelete(){
        $this->isShowDelete = null;
    }
    public function block($id){
        $this->iddelete = $id;
        $this->isShowDelete = 0;
    }
    public function create(){
        $this->reset('newCategory');
        $this->isShowCreate = 0;
    }
    public function createNew(){
        $this->validateOnly('category_name');
        Category::create([
            'category_name' => $this->newCategory,
        ]);
        $this->isShowCreate = null;
    }
    public function cancelNew(){
        $this->isShowCreate = null;
    }


    public function render()
    {
        $this->category = Category::where('block',1)->get();
        $this->total = Category::where('block',1)->count();
        return view('livewire.admin.category.showcategories');
    }
}
