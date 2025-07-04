@extends('backend.app')

@section('title',__('admin.Tags'))

@section('li1',__('admin.Listing'))
@section('li1_link',route('app.tags.index'))
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
                @livewire('admin.tags.tags-data')
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@livewire('admin.tags.tags-update',,key(Str::random(8)))
@livewire('admin.tags.tags-delete',,key(Str::random(8)))

@include('livewire.admin.messages')

@endsection

@push('js')
<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/tags.js" defer></script>
@endpush
