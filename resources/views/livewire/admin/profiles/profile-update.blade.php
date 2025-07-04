<div>
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-xxl">
                <!--begin::Form-->
                <form class="form d-flex flex-column flex-lg-row" role="form" id="userFrom" wire:submit.prevent='submit'>
                   
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{__('admin.users.Avatar')}}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                @if(isset($avatar) && $avatar != null)
                                    @if(str_starts_with($avatar, 'profile/avatar'))
                                        <style>
                                            .image-input-placeholder { 
                                                background-image: url('{{asset('storage/'.$avatar)}}'); 
                                                position:relative;
                                            } 
                                        </style>
                                        <!--begin::delete-->
                                     
                                        <a class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute" style="top:228px;left:140px"  wire:click="removePicture" id="delete_avatar">
                                            <i class="bi bi-trash fs-2 red"></i>
                                        </a> 
                                      
                                        <!--end::delete-->
                                    @else
                                       
                                        <img class="image-input image-input-circle image-input-outline image-input-wrapper h-150px w-150px position-absolute" src="{{$avatar->temporaryUrl() }}">
                                        <!--begin::Cancel-->
                                       
                                        <a class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute" style="top:228px;left:160px" title="{{__('admin.Cancel avatar')}}"  wire:click="removePicture" id="delete_avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </a> 
                                        <!--end::Cancel-->
                                    @endif

                                @else
                                    <style>
                                        .image-input-placeholder { 
                                            background-image: url('{{asset('assets/backend/metronic/ltr/src/media/avatars/blank.png')}}'); 
                                        } 
                                        [data-theme="dark"] .image-input-placeholder { background-image: url({{asset('assets/backend/metronic/ltr/src/media/svg/files/blank-image-dark.svg')}}); }
                                    </style>
                                @endif
                                <!--end::Image input placeholder-->
                                <div class="image-input image-input-empty image-input-outline image-input-circle image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px">
                                    </div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('admin.Change avatar')}}">
                                        <i class="bi bi-pencil-fill fs-7" id="bi-pencil-fill"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" wire:model='avatar' accept=".png, .jpg, .jpeg, .svg" />
                                       
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    
                                  
                                </div>
                                <!--end::Image input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">{{__('admin.users.note1')}}</div>
                                @include('livewire.admin.error', ['property' => 'avatar'])

                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                    </div>
                    <!--end::Aside column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                      
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{__('admin.General')}}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Name')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="name" id="name" class="form-control form-control-lg form-control-solid mb-2 @error('name') is-invalid @enderror" placeholder="{{__('admin.Name')}}"  wire:model="name" autofocus/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7"></div>
                                                <!--end::Description-->
                                               
                                                @include('livewire.admin.error', ['property' => 'name'])

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.users.Email')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="email" id="email" name="email"  class="form-control form-control-lg form-control-solid mb-2 @error('email') is-invalid @enderror" placeholder="{{__('admin.users.Email')}}" wire:model="email" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7"></div>
                                                <!--end::Description-->
                                              
                                                @include('livewire.admin.error', ['property' => 'email'])

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::solid autosize textarea-->
                                            <div class="mb-10 fv-row">
                                                <label for="" class="form-label">{{__('admin.users.bio')}}
                                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>255, 'min'=>50])}}"></i>
                                                </label>
                                                <textarea class="form-control form-control form-control-solid @error('bio') is-invalid @enderror" data-kt-autosize="true" rows="3" wire:model="bio"></textarea>
                                                @include('livewire.admin.error', ['property' => 'bio'])
                                            </div>
                                            <!--end::solid autosize textarea-->
                                            <!--begin::Main wrapper-->
                                            <div class="mb-10 fv-row fv-row">
                                                <!--begin::Wrapper-->
                                                <div class="mb-1">
                                                    <!--begin::Label-->
                                                    <label class="form-label fw-semibold fs-6 mb-2">
                                                        {{__('admin.users.Password')}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative mb-3">
                                                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                                        type="password" wire:model="password" name="password" id="password"
                                                        autocomplete="new-password"
                                                        placeholder="{{__('admin.users.Password')}}"/>
                                                        
                                                        @include('livewire.admin.error', ['property' => 'password'])

                                                    </div>
                                                    <!--end::Input wrapper-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Main wrapper-->
                                            <!--begin::Main wrapper-->
                                            <div class="mb-10 fv-row fv-row" data-kt-password-meter="true">
                                                <!--begin::Wrapper-->
                                                <div class="mb-1">
                                                    <!--begin::Label-->
                                                    <label class="form-label fw-semibold fs-6 mb-2">
                                                        {{__('admin.users.Password Confirmation')}}
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative mb-3">
                                                        <input class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror"
                                                        type="password" wire:model="password_confirmation" name="password_confirmation" id="password_confirmation"
                                                        autocomplete="off"
                                                        placeholder="{{__('admin.users.Password Confirmation')}}"/>
                                                        <!--begin::Visibility toggle-->
                                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                            data-kt-password-meter-control="visibility">
                                                            <i class="bi bi-eye-slash fs-2"></i>
    
                                                            <i class="bi bi-eye fs-2 d-none"></i>
                                                        </span>
                                                        <!--end::Visibility toggle-->
                                                       
                                                        @include('livewire.admin.error', ['property' => 'password_confirmation'])

                                                    </div>
                                                    <!--end::Input wrapper-->
                                                    <!--begin::Highlight meter-->
                                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                                    </div>
                                                    <!--end::Highlight meter-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Hint-->
                                                <div class="text-muted">
                                                 {{__('admin.users.password_hint')}}
                                                </div>
                                                <!--end::Hint-->
                                            </div>
                                            <!--end::Main wrapper-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('app.users.index')}}" class="btn btn-light me-5">{{__('admin.Cancel')}}</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary bg-color">
                                <span class="indicator-label">{{__('admin.Save Changes')}}</span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
</div>
