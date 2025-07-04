<?php

namespace App\Livewire\Admin\Profiles;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileData extends Component
{

    public function mount()
    {
        Gate::authorize('app.profile.update');
    }

    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view('livewire.admin.profiles.profile-data',['user'=>$user]);
    }
}
