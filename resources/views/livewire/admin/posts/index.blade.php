@extends('backend.app')

@section('title',__('admin.Posts'))
@section('li1',__('admin.Listing'))
@section('li1_link',route('app.posts.index'))
@section('li2','')
@section('li2_link','')

@push('css')
    <link href="{{config('customConfig.cdn_assets_url')}}/backend/css/loader.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    @php
        $category = null;
        if(isset($_GET['category']) && $_GET['category'] != '') 
            $category = $_GET['category'];
    @endphp

    <!--begin::Content-->
    @if(Request::route()->getName() == "app.posts.create")
        @livewire('admin.posts.posts-create',['category'=>$category])
    @elseif(Request::route()->getName() == "app.posts.update")
        @livewire('admin.posts.posts-update',['id'=>Request::route()->id])
    @elseif(Request::route()->getName() == "app.posts.show")
        @livewire('admin.posts.posts-show',['id'=>Request::route()->id])
    @else
        @livewire('admin.posts.posts-data',['category'=>$category])
    @endif

    @include('livewire.admin.messages')
    @include('components.loader')

    @livewire('admin.posts.posts-delete',,key(Str::random(8)))

@endsection

@push('js')
    <script src="{{config('customConfig.cdn_assets_url')}}/backend/js/loader.js" defer></script>
    <script src="{{config('customConfig.cdn_assets_url')}}/backend/js/posts.js" defer></script>
@endpush
