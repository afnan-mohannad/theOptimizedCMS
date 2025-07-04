<x-create-modal title="{{__('admin.tags.Add Tag')}}">
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('admin.Slug')}}
                <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>3])}}"></i>
            </label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="slug" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{__('admin.Slug')}}" autofocus/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'slug'])
        </div>
    </div>
    <!--end::Input group-->
    <div class="row-mb-7">
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="{{$is_active}}" id="is_active" checked="checked" wire:model="is_active"/>
            <label class="form-check-label" for="is_active">
                {{__('admin.Active')}}
            </label>
        </div>
    </div>
</x-create-modal>
