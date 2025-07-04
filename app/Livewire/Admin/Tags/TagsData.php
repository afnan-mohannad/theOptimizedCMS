<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class TagsData extends Component
{
    use WithPagination;

    /* wire models */
    public $search;
    public $is_active;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedTag = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedTags'];
    
    public function mount()
    {
        Gate::authorize('app.tags.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedTag = [];
        $this->dispatch('resetActions');
    }

    public function updatingIsActive()
    {
        $this->resetPage();
        $this->checkedTag = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Tag::flushCache();
        $this->checkedTag = [];
    }

    public function render()
    {
        $keyword   = $this->search;
        $is_active = $this->is_active;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $tags = Tag::getAllTags($keyword,$is_active,$sortColumn,$sortDirection,10);
        return view('livewire.admin.tags.tags-data', ['data' => $tags]);
    }

    public function deleteTags(){
        $this->dispatch('swal:deleteTags',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedTag,
        ]);
    }
    
    public function deleteCheckedTags($ids){
        Tag::whereKey($ids)->delete();
        $this->checkedTag = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($tagId){
        return in_array($tagId, $this->checkedTag) ? 'bg-light-info text-dark' : '';
    }
   
}
