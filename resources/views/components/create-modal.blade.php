<!--begin::Modal body-->
<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
    <!--begin::Form-->
    <form id="kt_modal_add_user_form" wire:submit.prevent='submit'>
        <!--begin::Scroll-->
        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_arader" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
            {{$slot}}
        </div>
        <!--end::Scroll-->
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">{{__('admin.Discard')}}</button>
            <button type="submit" class="btn btn-primary bg-color">
                @include('livewire.admin.loading', ['buttonName' => __('admin.Create')])
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<!--end::Modal body-->