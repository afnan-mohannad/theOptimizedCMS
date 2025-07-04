@extends('backend.app')

@section('title',__('admin.Users'))

@section('li1',__('admin.Listing'))
@section('li1_link',route('app.users.index'))
@section('li2','')
@section('li2_link','')

@push('css')
<link href="{{config('customConfig.cdn_assets_url')}}/backend/css/avatar.css" rel="stylesheet" type="text/css" />
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
                @livewire('admin.users.users-data')
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@livewire('admin.users.users-show',,key(Str::random(8)))
@livewire('admin.users.users-update',,key(Str::random(8)))
@livewire('admin.users.users-delete',,key(Str::random(8)))

@include('livewire.admin.messages')

@endsection

@push('js')
<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/users.js"></script>
@endpush
