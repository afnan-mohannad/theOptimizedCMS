<?php

namespace App\Livewire\Admin\Subscribers;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Subscribers\SubscribersData;

class SubscribersDelete extends Component
{
    public $subscriber;

    protected $listeners = ['subscriberDelete'];

    public function mount()
    {
        Gate::authorize('app.subscribers.destroy');
    }
    
    public function subscriberDelete($id)
    {
        // fill $subscriber with the eloquent model of the same id
        $this->subscriber = Subscriber::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        // delete record
        $this->subscriber->delete();
        $this->reset('subscriber');
        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh subscribers data component
        $this->dispatch('refreshData')->to(SubscribersData::class);
        $this->dispatch('successDelete');
    }
    
    public function render()
    {
        return view('livewire.admin.subscribers.subscribers-delete');
    }
}
