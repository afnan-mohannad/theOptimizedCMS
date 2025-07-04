@extends('backend.app')

@section('title',__('admin.users.Profile Details'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            @if(Request::route()->getName() == "app.profile.update")

             @livewire('admin.profiles.profile-update',['id'=>Request::route()->id])
             
            @else

            @livewire('admin.profiles.profile-data')

            @endif
            
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
