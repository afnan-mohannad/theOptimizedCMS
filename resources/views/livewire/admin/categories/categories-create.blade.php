<x-create-modal title="{{__('admin.categories.Add Category')}}">
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <div class="col-12">
            <label class="fw-semibold fs-6 mb-2">{{__('admin.banners.Picture')}}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.max_size',['max'=>1, 'unit'=>'MB'])}} (1920x1184)"></i>
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
                <div class="my-4">
                    <img src="{{ $picture->temporaryUrl() }}" class="banner-img picture-style">
                </div>
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
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.Name')}} {{ __('admin.(en)') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>100, 'min'=>5])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="name_en" wire:keyup="generateSlug" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.Name')}} {{ __('admin.(en)') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'name_en'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.Name')}} {{ __('admin.(ar)') }}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>100, 'min'=>5])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="name_ar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.Name')}} {{ __('admin.(ar)') }}" />
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'name_ar'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">
                {{__('admin.Slug')}}
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="slug" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.Slug')}}"/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'slug'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::solid autosize textarea-->
    <div class="rounded border d-flex flex-column">
        <label for="" class="form-label">{{__('admin.Description')}} {{__('admin.(en)') }}
            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>255, 'min'=>5])}}"></i>
        </label>
        <textarea class="form-control form-control form-control-solid @error('description_en') is-invalid @enderror" data-kt-autosize="true" rows="3" wire:model="description_en"></textarea>
        @include('livewire.admin.error', ['property' => 'description_en'])
    </div>
    <!--end::solid autosize textarea-->
    <!--begin::solid autosize textarea-->
    <div class="rounded border d-flex flex-column mt-5">
        <label for="" class="form-label">{{__('admin.Description')}} {{__('admin.(ar)') }}
            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>255, 'min'=>5])}}"></i>
        </label>
        <textarea class="form-control form-control form-control-solid @error('description_ar') is-invalid @enderror" data-kt-autosize="true" rows="3" wire:model="description_ar"></textarea>
        @include('livewire.admin.error', ['property' => 'description_ar'])
    </div>
    <!--end::solid autosize textarea-->
    <!--end::Input group-->
    <div class="fv-row mb-5 mt-5">
        @if(isset($categories) && !empty($categories))
            <div class="row mb-7" id="categories_select_drop_down">
                <div class="col-12">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2">
                        {{__('admin.Select category')}}
                    </label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="{{__('admin.Select category')}}" data-allow-clear="true" wire:model="parent_id" id="parent_id">
                        <option value="">{{__('admin.Select category')}}</option>
                        @foreach ($categories as $category)
                            <option wire:key="category-{{ $category->id }}" value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
    <!--begin::Input group-->
    <div class="row-mb-7 mt-5">
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="" id="is_active" checked="checked" wire:model="is_active"/>
            <label class="form-check-label" for="is_active">
                {{__('admin.Active')}}
            </label>
        </div>
    </div>
</x-create-modal>
{{-- @script()
    <script>
        $(document).ready(function() {
            $('#parent_id').select2();
            $('#parent_id').on('change', function() {
                let data = $(this).val();
                @this.parent_id = data;
            });
        });
    </script>
@endscript --}}