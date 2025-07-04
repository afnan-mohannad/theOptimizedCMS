@extends('backend.app')

@section('title',__('admin.Users'))
@section('li1',__('admin.Listing'))
@section('li1_link',route('app.users.index'))

<!--begin::Breadcrumb-->
@if (isset($user) && !empty($user))
    @section('li2',__('admin.Edit'))
    @section('li2_link',route('app.users.edit',$user->id))
@else
    @section('li2',__('admin.Add'))
    @section('li2_link',route('app.users.create')) 
@endif
<!--end::Breadcrumb-->

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Form-->
            <form class="form d-flex flex-column flex-lg-row" role="form" id="userFrom" method="POST"
            action="{{ isset($user) ? route('app.users.update',$user->id) : route('app.users.store') }}"
            enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('admin.users.Avatar')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            <!--begin::Image input placeholder-->
                            @if(isset($user->avatar) && $user->avatar != null)
                                <style>
                                    .image-input-placeholder { 
                                        background-image: url('{{asset('storage/'.$user->avatar)}}'); 
                                    } 
                                </style>
                            @else
                                <style>
                                    .image-input-placeholder { 
                                        background-image: url('{{asset('assets/backend/metronic/ltr/src/media/avatars/blank.png')}}'); 
                                    } 
                                    [data-theme="dark"] .image-input-placeholder { background-image: url({{asset('assets/backend/metronic/ltr/src/media/svg/files/blank-image-dark.svg')}}); }
                                </style>
                            @endif
                            <!--end::Image input placeholder-->
                            <div class="image-input image-input-empty image-input-outline image-input-circle image-input-placeholder mb-3" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px">
                                </div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('admin.Change avatar')}}">
                                    <i class="bi bi-pencil-fill fs-7" id="bi-pencil-fill"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{__('admin.Cancel avatar')}}">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{__('admin.Remove avatar')}}">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">{{__('admin.users.note1')}}</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Thumbnail settings-->
                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
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
                                            <h2>{{__('admin.General')}}</h2>
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
                                            <input type="text" name="name" id="name" class="form-control form-control-lg form-control-solid mb-2 @error('name') is-invalid @enderror" placeholder="{{__('admin.Name')}}" value="{{isset($user->name) ? $user->name : old('name')}}" autofocus/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
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
                                            <label class="required form-label">{{__('admin.users.Email')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" id="email" name="email"  class="form-control form-control-lg form-control-solid mb-2 @error('email') is-invalid @enderror" placeholder="{{__('admin.users.Email')}}" value="{{isset($user->email) ? $user->email : old('email')}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Main wrapper-->
                                        <div class="mb-10 fv-row fv-row">
                                            <!--begin::Wrapper-->
                                            <div class="mb-1">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold fs-6 mb-2">
                                                    {{__('admin.users.Password')}}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input wrapper-->
                                                <div class="position-relative mb-3">
                                                    <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                                    type="password" name="password" id="password"
                                                    autocomplete="off"
                                                    placeholder="{{__('admin.users.Password')}}"/>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <!--end::Input wrapper-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Main wrapper-->
                                        <!--begin::Main wrapper-->
                                        <div class="mb-10 fv-row fv-row" data-kt-password-meter="true">
                                            <!--begin::Wrapper-->
                                            <div class="mb-1">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold fs-6 mb-2">
                                                    {{__('admin.users.Password Confirmation')}}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input wrapper-->
                                                <div class="position-relative mb-3">
                                                    <input class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror"
                                                    type="password" name="password_confirmation" id="password_confirmation"
                                                    autocomplete="off"
                                                    placeholder="{{__('admin.users.Password Confirmation')}}"/>
                                                    <!--begin::Visibility toggle-->
                                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                        data-kt-password-meter-control="visibility">
                                                        <i class="bi bi-eye-slash fs-2"></i>

                                                        <i class="bi bi-eye fs-2 d-none"></i>
                                                    </span>
                                                    <!--end::Visibility toggle-->
                                                    @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <!--end::Input wrapper-->
                                                <!--begin::Highlight meter-->
                                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                                </div>
                                                <!--end::Highlight meter-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Hint-->
                                            <div class="text-muted">
                                             {{__('admin.users.password_hint')}}
                                            </div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Main wrapper-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('app.users.index')}}" class="btn btn-light me-5">{{__('admin.Cancel')}}</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary bg-color">
                            <span class="indicator-label">{{__('admin.Save Changes')}}</span>
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
