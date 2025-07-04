@extends('backend.app')
@section('title',__('admin.Pages'))
@section('li1',__('admin.Listing'))
@section('li1_link',route('app.pages.index'))
@section('li2','')
@section('li2_link','')
@push('css')
@endpush
@section('content')
    @if(Request::route()->getName() == "app.pages.create")
        @livewire('admin.pages.pages-create')
    @elseif(Request::route()->getName() == "app.pages.update")
        @livewire('admin.pages.pages-update',['id'=>Request::route()->id])
    @elseif(Request::route()->getName() == "app.pages.show")
        @livewire('admin.pages.pages-show',['id'=>Request::route()->id])
    @else
        @livewire('admin.pages.pages-data')
    @endif

    @include('livewire.admin.messages')
    @livewire('admin.pages.pages-delete',,key(Str::random(8)))

@endsection
@push('js')
<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/pages.js" defer></script>
@endpush
