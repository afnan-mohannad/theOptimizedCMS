<!--begin::Form-->
<form class="form" id="settingsFrom" autocomplete="off" role="form" wire:submit.prevent='submit'>                   
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <!--begin::Input group-->
        <div class="row mb-6">
            @foreach ($fields as $field)
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label  fw-semibold fs-6">
                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip"></i>
                    {{$field->display_name}}
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">

                    @if ($field->fieldType == "text")
                    <div class="position-relative">
                        <input type="text" class="form-control form-control-lg form-control-solid mb-3" wire:model='inputs.{{ $field->key }}' >
                        <a class="btn btn-icon btn-circle btn-active-color-primary position-absolute" title="Remove Field" style="top: 5px; right: 6px;background: white;border-radius: 10px;height: 36px;"  wire:click="removeField('{{$field->id}}')" id="delete_avatar">
                            <i class="bi bi-trash fs-2"></i>
                        </a> 
                    </div>
                    
                    @elseif($field->fieldType == "text_area")
                    <div class="position-relative">
                        <textarea class="form-control form-control-lg form-control-solid mb-3" wire:model='inputs.{{ $field->key }}' rows="10" ></textarea>
                        <a class="btn btn-icon btn-circle btn-active-color-primary position-absolute" style="bottom: 10px;right: 6px;background: white;border-radius: 10px;" title="Remove Field"  wire:click="removeField('{{$field->id}}')" id="delete_avatar">
                            <i class="bi bi-trash fs-2"></i>
                        </a> 
                    </div>
                    @elseif($field->fieldType == "file") 
                     <!--begin::Image input-->
                     <div class="position-relative">
                        <div class="image-input image-input-outline mt-2" data-kt-image-input="true" style="background-image: url('{{asset('assets/backend/metronic/ltr/src/media/avatars/avatar.svg')}}')">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-custom h-custom custom-color-dark" style="background-image: url('{{ $field->value != null ?  Storage::url($field->value) : asset('assets/backend/images/logos/company_logo_white.svg') }}')" wire:ignore></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('admin.Change avatar')}}">
                                <i class="bi bi-pencil-fill fs-7" id="bi-pencil-fill"></i>
                                <!--begin::Inputs-->
                                <input type="file" wire:model='inputs.{{ $field->key }}' id="site_logo_light" accept=".png, .jpg, .jpeg, .svg" onchange="readURL(this)" class="@error('site_logo_light') is-invalid @enderror"/>

                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{__('admin.Cancel avatar')}}">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{__('admin.Remove avatar')}}">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                            
                        </div>  
                        <a class="btn btn-icon btn-circle btn-active-color-primary  position-absolute" title="Remove Field" style="top:4px;right: 6px;"  wire:click="removeField('{{$field->id}}')" >
                            <i class="bi bi-trash fs-2"></i>
                        </a>   
                     </div>
                    <!--begin::Hint-->
                    <div class="form-text">{{__('admin.allowed_images_types')}}</div>
                    <!--begin::Hint-->
                    <div class="form-text text-red-600 mb-2">{{__('admin.settings.note_about_dimensions')}}</div>
                    <!--end::Hint-->
                    @endif

                </div>
                <!--end::Col-->
            @endforeach
           
        </div>
        <!--end::Input group-->
        @isset($group)
        <div class="row-mb-7 mt-5 @if(count($fields) == 0) d-none @endif">
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" id="status" @if($status ==1) checked="checked" @endif wire:model="status"/>
                <label class="form-check-label" for="status">
                    {{__('admin.Active')}}
                </label>
            </div>
        </div>
        @endisset
        
    </div>
    <!--end::Card body-->
    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="reset" class="btn btn-light btn-active-light-primary me-2" onclick="cancel()">{{__('admin.Discard')}}</button>
        <button type="submit" class="btn btn-primary bg-color" @if(count($fields) == 0) disabled  @endif>{{__('admin.Save Changes')}}</button>
    </div>
    <!--end::Actions-->
</form>
<!--end::Form-->
