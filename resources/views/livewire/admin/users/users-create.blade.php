<x-create-modal title="{{__('admin.users.Add User')}}">
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        @if ($avatar)
            <div class="personal-image">
                <label class="label">
                    <input type="file"wire:model='avatar' accept=".png, .jpg, .jpeg, .svg"/>
                    <figure class="personal-figure">
                        <img src="{{ $avatar->temporaryUrl() }}" class="personal-avatar" alt="avatar">
                        <figcaption class="personal-figcaption">
                        <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                        </figcaption>
                    </figure>
                </label>
            </div>
        @else
            <div class="personal-image">
                <label class="label">
                    <input type="file"wire:model='avatar' accept=".png, .jpg, .jpeg, .svg"/>
                    <figure class="personal-figure">
                        <img src="{{asset('assets/backend/metronic/ltr/src/media/avatars/300-6.jpg')}}" class="personal-avatar" alt="avatar">
                        <figcaption class="personal-figcaption">
                        <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                        </figcaption>
                    </figure>
                </label>
            </div>
        @endif
        @if ($avatar)
        <!--begin::delete--> 
        <center wire:ignore>
            <a class="btn btn-icon btn-circle w-25px h-25px bg-body shadow" wire:click="removePicture" id="delete_avatar">
                <i class="bi bi-trash fs-2 red"></i>
            </a>  
        </center>
        <!--end::delete-->
        @endif
        <!--begin::Hint-->
        <div class="form-text mb-5 text-center">{{__('admin.allowed_images_types')}}</div>
        <!--end::Hint-->
        @include('livewire.admin.error', ['property' => 'avatar'])
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.Name')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.Name')}}" required/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'name'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.users.Email')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="email" id="email" wire:model="email" class="form-control form-control-solid mb-3 mb-lg-0 direction" placeholder="{{__('admin.users.Email')}}" autocomplete="off" required/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'email'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12 position-relative">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.users.Password')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input id="password" type="password" wire:model="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.users.Password')}}" autocomplete="new-password" required/>
            <i class="bi bi-eye-slash fs-2 position-absolute top-70 cursor-pointer" id="toggle_password_users"></i>
            <!--end::Input-->
            <div class="text-muted fs-7">{{__('admin.users.password_hint')}}</div>
            @include('livewire.admin.error', ['property' => 'password'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12 position-relative">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.profile.Confirm Password')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input id="password_confirmation" type="password" wire:model="password_confirmation" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.profile.Confirm Password')}}" autocomplete="new-password" required/>
            <i class="bi bi-eye-slash fs-2 position-absolute top-70 cursor-pointer" id="toggle_password_confirmation"></i>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'password_confirmation'])
        </div>
    </div>
    <!--end::Input group-->
    <div class="row-mb-7">
        <!--begin::Label-->
        <label class="form-label">{{__('admin.Roles')}}</label>
        <!--end::Label-->
        <!--begin::Select2-->
        <select wire:model="role" id="roles-1" class="form-select mb-2" data-placeholder="{{__('admin.Select an option')}}" required>
            <option value="">{{__('admin.Select an option')}}</option>
            @if(isset($roles) && !empty($roles))
                @foreach($roles as $key=>$role)
                    <option value="{{$role->id}}" @if(isset($user->role) && $user->role->id == $role->id) selected="selected" @endif>{{$role->name}}</option>
                @endforeach
            @endif
        </select>
        <!--end::Select2-->
        @include('livewire.admin.error', ['property' => 'role'])
    </div>
    <!--begin::solid autosize textarea-->
    <div class="rounded border d-flex flex-column mt-2">
        <label for="" class="required form-label">{{__('admin.users.bio')}}
            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>255, 'min'=>50])}}"></i>
        </label>
        <textarea class="form-control form-control form-control-solid @error('bio') is-invalid @enderror" data-kt-autosize="true" rows="3" wire:model="bio"></textarea>
        @include('livewire.admin.error', ['property' => 'bio'])
    </div>
    <!--end::solid autosize textarea-->
    <div class="row-mb-7 mt-5">
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="1" id="status" checked="checked" wire:model="status"/>
            <label class="form-check-label" for="status">
                {{__('admin.Active')}}
            </label>
        </div>
    </div>
</x-create-modal>