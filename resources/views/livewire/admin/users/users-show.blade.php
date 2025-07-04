<x-show-modal title="{{__('admin.Showing')}}: {{$name}}">
    @if (isset($avatar))
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <div class="personal-image">
            <label class="label">
            <figure class="personal-figure">
                <img src="{{asset('storage/'.$avatar)}}" class="personal-avatar" alt="avatar">
            </figure>
            </label>
        </div>
    </div>
    <!--end::Input group-->
    @endif
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="text-center fw-semibold fs-6 mb-2">{{$name}}</label>
        <!--end::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
       <!--begin::Label-->
       <label class="text-center fw-semibold fs-6 mb-2">{{$email}}</label>
       <!--end::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="text-center fw-semibold fs-6 mb-2">{{$role ? $role->name : ""}}</label>
        <!--end::Label-->
     </div>
     <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        @if ($status)
        <label class="text-center fw-semibold fs-6 mb-2"><span class="badge badge-light-success">{{__('admin.Active')}}</span></label>
        @else
        <label class="text-center fw-semibold fs-6 mb-2"><span class="badge badge-light-danger">{{__('admin.InActive')}}</span></label>
        @endif
    </div>
    <!--end::Input group-->
    
</x-show-modal>
