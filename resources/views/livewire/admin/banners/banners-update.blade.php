<x-update-modal title="{{__('admin.banners.Update Banner')}}">
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <div class="col-12">
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.Picture')}}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.banners.max_size')}} (1920x1184)"></i>
            </label> 
            <br>
            <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <!-- File Input -->
                <input type="file"wire:model='picture' accept=".png, .jpg, .jpeg"/>
            
                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
            @if ($picture)
                @if(str_starts_with($picture, 'banners'))
                    <div class="my-4">
                        <img src="{{ asset('storage/'.$picture) }}" width="100%" height="150px" class="banner-img">
                    </div>
                @else
                    <div class="my-4">
                        <img src="{{ $picture->temporaryUrl() }}" width="100%" height="150px" class="banner-img">
                    </div>
                @endif
            @endif
            @if ($picture)
            <!--begin::delete-->
            <a class="btn btn-icon btn-circle w-25px h-25px bg-body shadow pictureDelete" wire:click="removePicture">
                <i class="bi bi-trash fs-2 red"></i>
            </a>
            <!--end::delete-->
            @endif
            <!--begin::Hint-->
            <div class="form-text mb-5">{{__('admin.allowed_images_types')}} {{__('admin.max_size', ['max'=>1, 'unit'=>'MB'])}}</div>
            <!--end::Hint-->
            @include('livewire.admin.error', ['property' => 'picture'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.heading1_text')}} {{ __('admin.(en)') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>100, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="heading1_text_en" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.banners.heading1_text')}} {{ __('admin.(en)') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'heading1_text_en'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.heading1_text')}} {{ __('admin.') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>100, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="heading1_text_ar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.banners.heading1_text')}} {{ __('admin.') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'heading1_text_ar'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.heading2_text')}} {{ __('admin.(en)') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>100, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="heading2_text_en" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.banners.heading2_text')}} {{ __('admin.(en)') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'heading2_text_en'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.heading2_text')}} {{ __('admin.') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>100, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="heading2_text_ar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.banners.heading2_text')}} {{ __('admin.') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'heading2_text_ar'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.button_text')}} {{ __('admin.(en)') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="button_text_en" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.banners.button_text')}} {{ __('admin.(en)') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'button_text_en'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.banners.button_text')}} {{ __('admin.') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="button_text_ar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.banners.button_text')}} {{ __('admin.') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'button_text_ar'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="fw-semibold fs-6 mb-2">{{__('admin.button_href')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="button_href" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="/about" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'button_href'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="fw-semibold fs-6 mb-2">{{__('admin.button_target')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="button_target" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="_blank" value="_blank"/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'button_target'])
        </div>
    </div>
    <!--end::Input group-->
</x-update-modal>