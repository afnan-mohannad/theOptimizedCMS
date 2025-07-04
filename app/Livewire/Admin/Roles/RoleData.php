<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class RoleData extends Component
{
    public $roles,$permissions_count;

    protected $listeners = ['refreshData' => '$refresh'];

    public function mount()
    {
        Gate::authorize('app.users.index');
        
    }

    public function render()
    {
        $this->roles = Role::getAllRoles();
        return view('livewire.admin.roles.role-data',['roles'=>$this->roles]);
    }
}
