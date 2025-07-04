<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Admin\Roles\RoleData;

class RoleDelete extends Component
{
    public $role;

    protected $listeners = ['roleDelete'];

    public function mount()
    {
        Gate::authorize('app.roles.destroy');
    }
     
   
    public function roleDelete($id)
    {
        // fill $project with the eloquent model of the same id
        $this->role = Role::find($id);
        // show delete modal
        $this->dispatch('deleteModalToggle');
    }
    public function submit()
    {
        $this->role->delete();
        $this->reset('role');

        // hide modal
        $this->dispatch('deleteModalToggle');
        // refresh projects data component
        $this->dispatch('refreshData')->to(RoleData::class);
        $this->dispatch('successDelete');
    }
    public function render()
    {
        return view('livewire.admin.roles.role-delete');
    }
}
