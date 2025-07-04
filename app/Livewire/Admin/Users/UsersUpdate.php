<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class UsersUpdate extends Component 
{
    use WithFileUploads;

    public $user, $name, $email, $password, $password_confirmation, $role, $avatar, $status, $roles ,$bio;
    
    protected $listeners = ['userUpdate'];
    
    public function mount()
    {
        Gate::authorize('app.users.edit');
        $this->roles = Role::getForSelect();
    }

    public function removePicture()
    {
        $this->avatar = null;
        if(!empty($this->user->avatar))
            unlink('storage/'.$this->user->avatar);
        $this->user->avatar = '';
        $this->user->save();
    }

    public function userUpdate($id)
    {
        // fill $user with the eloquent model of the same id
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->role->id;
        $this->status = $this->user->status;
        $this->avatar = $this->user->avatar;
        $this->bio = $this->user->bio;
        $this->resetValidation();
        // show edit modal
        $this->dispatch('updateModalToggle');
    } 

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'role' => ['required'],
            'avatar' => ['nullable'],
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
            'avatar'=> __('admin.users.Avatar'),
            'bio'=> __('admin.users.bio')
        ];
    }
    public function submit()
    {
        try {
            $data = $this->validate($this->rules(), [], $this->attributes());

            DB::beginTransaction();

            User::updateUser(
                $this->user,
                $this->role,
                $this->name,
                $this->email,
                $this->status,
                $this->bio
            );
            
            if(isset($this->password) && !empty($this->password))
                User::updatePassword($this->user,$this->password);

            if ($this->avatar != $this->user->avatar) {
                if(isset($this->user->avatar) && $this->user->avatar != null)
                    unlink('storage/'.$this->user->avatar);
                $user_avatar = time() . '.' . $this->avatar->getClientOriginalExtension();
                $this->avatar->storeAs('users/avatars', $user_avatar, 'public');
                $this->user->avatar = 'users/avatars/' . $user_avatar;
                $this->user->save();
            } 
            DB::commit();
            // hide modal
            $this->dispatch('updateModalToggle');
            // refresh & rest data component
            $this->dispatch('refreshData')->to(UsersData::class);
            $this->reset(['name', 'email', 'password', 'password_confirmation', 'role', 'avatar']);
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
        return view('livewire.admin.users.users-update');
    }
}
