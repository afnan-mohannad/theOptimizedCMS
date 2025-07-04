<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User; 
use Livewire\Component;
use App\Mail\WelcomeEmail;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use App\Livewire\Admin\Users\UsersData;
use Illuminate\Validation\Rules\Password;

class UsersCreate extends Component
{
    use WithFileUploads; 

    public $name, $email, $password, $password_confirmation, $role, $avatar, $status, $roles, $bio;

    public function mount()
    {
        Gate::authorize('app.users.create');
        $this->roles = Role::getForSelect();
        $this->status = true;
    }

    public function removePicture()
    {
        $this->avatar = null;
    }


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'password_confirmation' => 'required|same:password',
            'role' => ['required'],
            'avatar' => ['required','image','mimes:png,jpg,svg'],
            'bio' => ['required', 'string', 'max:255', 'min:50']
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('admin.Name'),
            'email' => __('admin.users.Email'),
            'password' => __('admin.users.Password'),
            'password_confirmation' => __('admin.users.Password Confirmation'),
            'role' => __('admin.Role'),
            'avatar'=>__('admin.users.Avatar'),
            'bio' => __('admin.users.bio')
        ];
    }

    public function submit()
    {
        try {
            $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();

            //store user data
            $user = User::storeUser(
                $this->role,
                $this->name,
                $this->email,
                $this->password,
                $this->status,
                $this->bio
            );

            // upload avatar
            $avatar_name = time() . '.' . $this->avatar->getClientOriginalExtension();
            $this->avatar->storeAs('users/avatars', $avatar_name, 'public');
            $user->avatar = 'users/avatars/' . $avatar_name;
            $user->save();

            DB::commit();

            // hide modal
            $this->dispatch('createModalToggle');
            // refresh user data component
            $this->dispatch('refreshData')->to(UsersData::class);
        }catch(QueryException $e){
            DB::rollback();
            Log::error($e->getMessage());
        }
    }
    
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
        }
        return view('livewire.admin.users.users-create');
    }
}