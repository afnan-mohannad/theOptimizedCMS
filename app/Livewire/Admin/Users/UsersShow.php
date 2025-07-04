<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class UsersShow extends Component
{
    public $user, $name, $email, $password, $role, $avatar, $status, $bio;

    protected $listeners = ['userShow'];

    public function userShow($id)
    {
        // fill $user with the eloquent model of the same id
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->avatar = $user->avatar;
        $this->bio = $user->bio;
        $this->dispatch('showModalToggle');
    }

    public function render()
    {
        return view('livewire.admin.users.users-show');
    }
}
