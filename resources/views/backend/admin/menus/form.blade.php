@extends('backend.app')

@section('title',__('admin.menus.Menu Builder'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Form-->
            <form class="form d-flex flex-column flex-lg-row" id="itemFrom" id="roleFrom" role="form" method="POST"
            action="{{ isset($menu) ? route('app.menus.update',$menu->id) : route('app.menus.store') }}">
                @csrf
                @if (isset($menu))
                    @method('PUT')
                @endif
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-12">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <!--begin::Svg Icon | path: C:/wamp64/www/keenthemes/core/html/src/media/icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-muted svg-icon-2hx m-5"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"/>
                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <h2>
                                                {{ __((isset($menu) ? __('admin.Edit') : __('admin.menus.Create Menu'))) }}
                                            </h2>
                                        </div>
                                        <div class="card-title">
                                            <a href="{{ route('app.menus.index') }}" class="btn-shadow btn btn-danger">
                                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                                </span>
                                                {{ __('admin.Back to list') }}
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--begin::Pricing-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{__('admin.menus.Manage Menu Item')}}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" id="name" class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="Name" value="{{ isset($menu) ? $menu->name : old('name') }}" autofocus/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__('admin.menus.Enter')}}</div>
                                            <!--end::Description-->
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Description')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea type="text" name="description" id="description" class="form-control mb-2 @error('description') is-invalid @enderror" placeholder="Description" rows="5"/>{{ isset($menu) ? $menu->description : old('description') }}
                                            </textarea>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Pricing-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('app.menus.index')}}" class="btn btn-light me-5">{{__('admin.Cancel')}}</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary bg-color">
                            @isset($menu)
                                <i class="bi bi-pencil-fill"></i>
                                <span>{{__('admin.Update')}}</span>
                            @else
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>{{__('admin.Create')}}</span>
                            @endisset
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection

@push('script')

@endpush
