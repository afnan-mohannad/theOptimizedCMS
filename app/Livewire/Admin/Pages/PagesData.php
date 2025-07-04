<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class PagesData extends Component
{ 
    use WithPagination;
    
    /* wire models */
    public $search;
    public $status;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedPage = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedPages'];

    public function mount()
    {
        Gate::authorize('app.pages.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedPage = [];
        $this->dispatch('resetActions');
    }

    public function updatingStatus()
    {
        $this->resetPage();
        $this->checkedPage = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Page::flushCache();
        $this->checkedPage = [];
    }

    public function render()
    {
        $keyword = $this->search;
        $status  = $this->status;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $pages = Page::getAllPages($keyword,$status,$sortColumn,$sortDirection,10);
        return view('livewire.admin.pages.pages-data', ['data'=>$pages]);
    }

    public function deletePages(){ 
        $this->dispatch('swal:deletePages',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedPage,
        ]);
    }

    public function deleteCheckedPages($ids){
        Page::whereKey($ids)->delete();
        $this->checkedPage = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($pageId){
        return in_array($pageId, $this->checkedPage) ? 'bg-light-info text-dark' : '';
    }
}
