@extends('backend.app')

@section('title',__('admin.users.Profile Details'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="d-flex align-items-center mb-5">
                            <!--begin::Svg Icon | path: C:/wamp64/www/keenthemes/core/html/src/media/icons/duotune/communication/com005.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"/>
                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"/>
                                </svg>
                                </span>
                                <!--end::Svg Icon-->
                            <!--begin::Title-->
                            <div class="d-flex flex-column">
                                <h2 class="m-5">{{__('admin.profile.Update Password')}}</h2>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--end::Details-->
                </div>
            </div>
            <!--end::Navbar-->
            <div class="row justify-content-center">
                <div class="col-12">
                    
                    <div class="main-card mb-3 card">
                     
                        <div class="card-body">
                           
                            @livewire('admin.profiles.password-update')
                            
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/profile.js"></script>
@endpush