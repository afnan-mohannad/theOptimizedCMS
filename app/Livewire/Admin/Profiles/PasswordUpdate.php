<?php

namespace App\Livewire\Admin\Profiles;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class PasswordUpdate extends Component
{
    public $current_password, $password , $password_confirmation;

    public function mount()
    {
        Gate::authorize('app.profile.password');
    }
    
    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'password_confirmation' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'current_password' => __('admin.profile.Current Password'),
            'password' => __('admin.users.Password'),
            'password_confirmation' => __('admin.users.Password Confirmation'),
            
        ];
    }

    public function updatePassword()
    {
     
        $data = $this->validate($this->rules(), [], $this->attributes());
        $hashedPassword = Auth::user()->password;
        if (Hash::check($this->current_password, $hashedPassword)) {
            if (!Hash::check($this->password, $hashedPassword)) {
                
                User::updatePassword(Auth::user(),$this->password);

                session()->flash('success', __('admin.profile.password_success'));
                $this->reset(['current_password', 'password', 'password_confirmation']);
                return redirect()->route('app.profile.password.change');
            } 
            else {
                session()->flash('error', __('admin.profile.password_failed'));
            }
        } 
        else 
        {
            $this->dispatch('swal:passwordNotMatch', [
                'title'=>__('admin.profile.password_not_matched'),
                'html'=>__('admin.profile.password_not_matched'),
                'timer'=>3000,
                'icon'=>'error',
                'toast'=>true,
                'position'=>'top-right',
                'yes'=>__('admin.Close'),
            ]);
        }
          
    }

    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatch('scrollToError');
        }
        return view('livewire.admin.profiles.password-update');
    }
}
