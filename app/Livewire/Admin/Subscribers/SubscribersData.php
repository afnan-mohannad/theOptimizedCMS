<?php

namespace App\Livewire\Admin\Subscribers;

use Livewire\Component;
use App\Models\Subscriber;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class SubscribersData extends Component
{
    use WithPagination;

    /* wire models */
    public $search;
    public $is_active;
    public $sortColumn = "id";
    public $sortDirection = "desc";
    public $checkedSubscriber = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh','deleteCheckedSubscribers'];

    public function mount()
    {
        Gate::authorize('app.subscribers.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->checkedSubscriber = [];
        $this->dispatch('resetActions');
    }

    public function updatingIsActive()
    {
        $this->resetPage();
        $this->checkedSubscriber = [];
        $this->dispatch('resetActions');
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->resetPage();
        Subscriber::flushCache();
        $this->checkedSubscriber = [];
    }

    public function render()
    {
        $keyword = $this->search;
        $is_active = $this->is_active;
        $sortColumn= $this->sortColumn;
        $sortDirection = $this->sortDirection;
        $subscribers = Subscriber::getAllSubscribers($keyword,$is_active,$sortColumn,$sortDirection,10);
        return view('livewire.admin.subscribers.subscribers-data',['data' => $subscribers]);
    }

    public function deleteSubscribers(){
        $this->dispatch('swal:deleteSubscribers',[
            'title'=>__('admin.Delete'),
            'html'=>__('admin.confirm_delete_text'),
            'yes'=>__('admin.cancel_no'),
            'no'=>__('admin.yes_delete'),
            'checkedIDs'=>$this->checkedSubscriber,
        ]);
    }
    
    public function deleteCheckedSubscribers($ids){
        Subscriber::whereKey($ids)->delete();
        $this->checkedSubscriber = [];
        $this->dispatch('resetActions');
        $this->dispatch('successDelete');
    }

    public function isChecked($subscriberId){
        return in_array($subscriberId, $this->checkedSubscriber) ? 'bg-light-info text-dark' : '';
    }
}
