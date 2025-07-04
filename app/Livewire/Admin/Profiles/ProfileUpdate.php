<?php

namespace App\Livewire\Admin\Profiles;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class ProfileUpdate extends Component
{
    use WithFileUploads; 

    public $user, $name, $avatar, $bio, $email, $password, $password_confirmation;

    public function mount($id)
    {
        Gate::authorize('app.profile.update');

        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->avatar  = $this->user->avatar;
        $this->bio   = $this->user->bio;
        $this->email = $this->user->email;
        
    }

    public function removePicture()
    {
        $this->avatar = null;
        if(!empty($this->user->avatar))
            unlink('storage/'.$this->user->avatar);
        $this->user->avatar = '';
        $this->user->save();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' .$this->user->id],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'avatar' => ['nullable'],
            'bio' => ['nullable', 'string', 'max:255', 'min:50']
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('admin.Name'),
            'email' => __('admin.users.Email'),
            'password' => __('admin.users.Password'),
            'password_confirmation' => __('admin.users.Password Confirmation'),
            'avatar'=> __('admin.users.Avatar'),
            'bio'=> __('home.bio')
        ];
    }

    public function submit()
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        try {

            DB::beginTransaction();

            User::updateUser(
                $this->user,
                $this->user->role_id,
                $this->name,
                $this->email,
                  1,
                $this->bio
            );

            if(isset($this->password) && !empty($this->password))
                User::updatePassword($this->user,$this->password);
             
            if ($this->avatar != $this->user->avatar) {
                if(isset($this->user->avatar) && $this->user->avatar != null)
                    unlink('storage/'.$this->user->avatar);
                $profile_avatar = time() . '.' . $this->avatar->getClientOriginalExtension();
                $this->avatar->storeAs('profile/avatar', $profile_avatar, 'public');
                $this->user->avatar = 'profile/avatar/' . $profile_avatar;
                $this->user->save();
            } 
            

            DB::commit();
            session()->flash('success', __('admin.success_update', ['item'=>$this->user->name]));
            return redirect()->route('app.profile.index');
            
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
        return view('livewire.admin.profiles.profile-update');
    }
}
