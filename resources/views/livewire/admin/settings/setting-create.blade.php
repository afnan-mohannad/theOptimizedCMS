<x-create-modal title="{{__('Add New Setting')}}" >
  
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('Setting Type')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <select wire:model="addType" id="addType" class="form-control form-control-solid mb-3 mb-lg-0" onchange="setGroup()">
                <option value=""></option>
                <option value="field">{{ __('Field') }}</option>
                <option value="group">{{ __('Tab') }}</option>
              
            </select>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'addType'])
        </div>
    </div>
    <!--end::Input group-->
     <!--begin::Input group-->
     <div id="group" class="row mb-7" wire:ignore>
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-3">{{__('Tab')}}</label>
            <select wire:model="group" class="form-control form-control-solid mb-3 mb-lg-0">
                @isset($allGroup)
                    <option value=""></option>
                    @foreach($allGroup as $group)
                    <option value="{{ $group->key }}">{{ $group->display_name }}</option>
                    @endforeach 
                @endisset
                
            </select>
            {{-- @include('livewire.admin.error', ['property' => 'group']) --}}
        </div>
     </div>
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('Display Name')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" wire:model="display_name" wire:keyup="generateKey" id="display_name" class="form-control form-control-solid mb-3 mb-lg-0 direction" placeholder="{{__('name ')}}" autocomplete="off"/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'display_name'])
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <div class="col-12">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">{{__('Key')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input  type="key" wire:model="key" id="key" class="form-control form-control-solid mb-3 mb-lg-0 direction" placeholder="{{__('key ')}}"/>
            <!--end::Input-->
            @include('livewire.admin.error', ['property' => 'key'])
        </div>
    </div>
    <!--end::Input group-->
    <div class="row mb-7" id="type" wire:ignore>
        <div class="col-12">
            <label class="required fw-semibold fs-6 mb-2">{{__('Type')}}</label>
            <select name="type" wire:model="type" class="form-control form-control-solid mb-3 mb-lg-0">
                <option value="">{{ __('choose') }}</option>
                <option value="text">{{ __('textbox') }}</option>
                <option value="text_area">{{ __('textarea') }}</option>
                <option value="file">{{ __('file') }}</option>
            </select>
            {{-- @include('livewire.admin.error', ['property' => 'type']) --}}
        </div>
    </div>
    <div class="row-mb-7 mt-5">
        <div class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="1" id="status" checked="checked" wire:model="status" disabled/>
            <label class="form-check-label" for="status">
                {{__('admin.Active')}}
            </label>
        </div>
    </div>
 
</x-create-modal>