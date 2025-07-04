<?php

namespace App\Livewire\Admin\Messages;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class MessagesData extends Component
{
    use WithPagination;

    /* wire models */
    public $search;
    public $is_active;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedMessage = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedMessages'];

    public function mount()
    {
        Gate::authorize('app.messages.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedMessage = [];
        $this->dispatch('resetActions');
    }

    public function updatingIsActive()
    {
        $this->resetPage();
        $this->checkedMessage = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Message::flushCache();
        $this->checkedMessage = [];
    }

    public function render()
    {
        $keyword = $this->search;
        $is_active = $this->is_active;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $messages = Message::getAllMessages($keyword,$is_active,$sortColumn,$sortDirection,10);
        return view('livewire.admin.messages.messages-data',['data'=>$messages]);
    }

    public function deleteMessages(){
        $this->dispatch('swal:deleteMessages',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedMessage,
        ]);
    }
    
    public function deleteCheckedMessages($ids){
        Message::whereKey($ids)->delete();
        $this->checkedMessage = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($messageId){
        return in_array($messageId, $this->checkedMessage) ? 'bg-light-info text-dark' : '';
    }
}
