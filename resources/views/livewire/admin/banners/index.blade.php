@extends('backend.app')

@section('title',__('admin.Banners'))

@section('li1',__('admin.Listing'))
@section('li1_link',route('app.banners.index'))
@section('li2','')
@section('li2_link','')

@push('css')
@endpush

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                @livewire('admin.banners.banners-data')
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@livewire('admin.banners.banners-update',,key(Str::random(8)))
@livewire('admin.banners.banners-delete',,key(Str::random(8)))

@include('livewire.admin.messages')

@endsection

@push('js')
<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/banners.js" defer></script>
@endpush
