<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Users\UsersData;

class UsersDelete extends Component
{
    public $user;

    protected $listeners = ['userDelete'];

    public function mount()
    {
        Gate::authorize('app.users.destroy');
    }

    public function userDelete($id)
    {
        // fill $user with the eloquent model of the same id
        $this->user = User::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }

    public function submit()
    {
        if(isset($this->user->avatar) && !empty($this->user->avatar))
            unlink('storage/'.$this->user->avatar);
        
        // delete record
        $this->user->delete();
        
        $this->reset('user');
        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(UsersData::class);
        $this->dispatch('resetSelected')->to(UsersData::class);

        $this->dispatch('successDelete');
    }


    public function render()
    {
        return view('livewire.admin.users.users-delete');
    }
}
