<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class CategoriesData extends Component
{
    use WithPagination;

    /* wire models */
    public $search;
    public $is_active;
    public $main_category_id;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedCategory = [];
    public $main_categories = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedCategories'];

    public function mount()
    {
        Gate::authorize('app.categories.index');
        $this->main_categories = Category::getForSelect();
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedCategory = [];
        $this->dispatch('resetActions');
    }

    public function updatingIsActive()
    {
        $this->resetPage();
        $this->checkedCategory = [];
        $this->dispatch('resetActions');
    }

    public function updatingMainCategoryId()
    {
        $this->resetPage();
        $this->checkedCategory = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Category::flushCache();
        $this->checkedCategory = [];
    }

    public function render()
    {
        $keyword   = $this->search;
        $is_active = $this->is_active;
        $main_category_id = $this->main_category_id;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $categories = Category::getAllCategories($keyword,$is_active,$main_category_id,$sortColumn,$sortDirection,10);
        return view('livewire.admin.categories.categories-data', ['data' => $categories]);
    }

    public function deleteCategories(){
        $this->dispatch('swal:deleteCategories',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedCategory,
        ]);
    }

    public function deleteCheckedCategories($ids){
        Category::whereKey($ids)->delete();
        $this->checkedCategory = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($categoryId){
        return in_array($categoryId, $this->checkedCategory) ? 'bg-light-info text-dark' : '';
    }
   
}
