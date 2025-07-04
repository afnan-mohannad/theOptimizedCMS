<form  wire:submit.prevent='updatePassword'>
  
    <div class="form-group row mb-5">
        <label for="current_password" class="col-md-3 col-form-label text-md-right">{{ __('admin.profile.Current Password') }}</label>
        <div class="col-md-6">
            <input id="current-password" wire:model="current_password" type="password" class="form-control form-control-lg form-control-solid @error('current_password') is-invalid @enderror"  required>
            <i class="bi bi-eye-slash fs-2" id="toggle-current-password"></i>
        </div>
      
        @include('livewire.admin.error', ['property' => 'current_password'])

    </div>
    <div class="form-group row mb-5">
        <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('admin.users.Password') }}
            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.users.password_hint')}}"></i>
        </label>
        <div class="col-md-6">
            <input id="password" wire:model="password" type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"  autocomplete="new-password" required>
            <i class="bi bi-eye-slash fs-2" id="toggle-password"></i>
            
        </div>
       
        @include('livewire.admin.error', ['property' => 'password'])

    </div>
    <div class="form-group row mb-5">
        <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('admin.profile.Confirm Password') }}</label>
        <div class="col-md-6">
             <input id="password-confirm" type="password" class="form-control form-control-lg form-control-solid"  wire:model="password_confirmation" autocomplete="new-password" required>
            <i class="bi bi-eye-slash fs-2" id="toggle-new-password"></i>
        </div>
      
        @include('livewire.admin.error', ['property' => 'password_confirmation'])

    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn btn-primary bg-color">
                <i class="bi bi-pencil-fill"></i>
                <span>{{__('admin.Update')}}</span>
            </button>
        </div>
    </div>
</form>