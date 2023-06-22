<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class Showcategories extends Component
{
    public $isShowDelete = null, $isShowCreate = null, $total = null;
    public $category;
    public $iddelete,$newCategory;

    protected $rules = [
        'newCategory' => 'required|unique:category,category_name',
    ];

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
        $validatedData = $this->validate();
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
