@extends('backend.app')

@section('title',__('admin.settings.General Settings'))

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
                        <div class="d-flex align-items-center">
                            <!--begin::Svg Icon | path: C:/wamp64/www/keenthemes/core/html/src/media/icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/>
                                <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/>
                                </svg>
                                </span>
                                <!--end::Svg Icon-->
                            <!--begin::Title-->
                            <div class="d-flex flex-column">
                                <h2 class="m-5">{{__('admin.Settings')}}</h2>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--end::Details-->
                    @include('backend.admin.settings.sidebar')
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <!--begin::Content-->
                <div class="collapse show">
                    @csrf
                    @method('PATCH')
                    <!--begin::Form-->
                    <form class="form" id="settingsFrom" autocomplete="off" role="form" method="POST" action="{{ route('app.settings.update') }}">
                        @csrf
                        @method('PATCH')
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>65, 'min'=>35])}}"></i>
                                {{__('admin.settings.Site Title')}} {{ __('admin.(en)') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_title_en" id="site_title" class="form-control form-control-lg form-control-solid @error('site_title_en') is-invalid @enderror" value="{{ setting('site_title_en') ?? old('site_title_en') }}"
                                    placeholder="{{__('admin.settings.Site Title')}} {{ __('admin.(en)') }}"/>
                                    @error('site_title_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>65, 'min'=>35])}}"></i>
                                    {{__('admin.settings.Site Title')}} {{__('admin.') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_title_ar" id="site_title" class="form-control form-control-lg form-control-solid @error('site_title_ar') is-invalid @enderror" value="{{ setting('site_title_ar') ?? old('site_title_ar') }}"
                                    placeholder="{{__('admin.settings.Site Title')}} {{__('admin.') }}"/>
                                    @error('site_title_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>320, 'min'=>120])}}"></i>
                                    {{__('admin.settings.Site Description')}} {{ __('admin.(en)') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea type="text" name="site_description_en" id="site_description" class="form-control form-control-lg form-control-solid @error('site_description_en') is-invalid @enderror"
                                    placeholder="Site Title" rows="10">{{ setting('site_description_en') ?? old('site_description_en') }}</textarea>
                                    @error('site_description_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>320, 'min'=>120])}}"></i>
                                    {{__('admin.settings.Site Description')}} {{__('admin.') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea type="text" name="site_description_ar" id="site_description" class="form-control form-control-lg form-control-solid @error('site_description_ar') is-invalid @enderror"
                                    placeholder="Site Title" rows="10">{{ setting('site_description_ar') ?? old('site_description_ar') }}</textarea>
                                    @error('site_description_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>150, 'min'=>10])}}"></i>
                                    {{__('admin.settings.Site Address 1')}} {{ __('admin.(en)') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea type="text" name="site_address_line1_en" id="site_address" class="form-control form-control-lg form-control-solid @error('site_address_line1_en') is-invalid @enderror"
                                    placeholder="{{__('admin.settings.Site Address 1')}}">{{ setting('site_address_line1_en') ?? old('site_address_line1_en') }}</textarea>
                                    @error('site_address_line1_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>150, 'min'=>10])}}"></i>
                                    {{__('admin.settings.Site Address 1')}} {{__('admin.') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea type="text" name="site_address_line1_ar" id="site_address" class="form-control form-control-lg form-control-solid @error('site_address_line1_ar') is-invalid @enderror"
                                    placeholder="{{__('admin.settings.Site Address 1')}}">{{ setting('site_address_line1_ar') ?? old('site_address_line1_ar') }}</textarea>
                                    @error('site_address_line1_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>15, 'min'=>9])}}"></i>
                                    {{__('admin.settings.Site Mobile')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_mobile1" id="site_mobile1" class="form-control form-control-lg form-control-solid @error('site_mobile1') is-invalid @enderror" value="{{ setting('site_mobile1') ?? old('site_mobile1') }}"
                                    placeholder="{{__('admin.settings.Site Mobile')}}"/>
                                    @error('site_mobile1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>15, 'min'=>8])}}"></i>
                                    {{__('admin.settings.Site Phone')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_phone" id="site_phone" class="form-control form-control-lg form-control-solid @error('site_phone') is-invalid @enderror" value="{{ setting('site_phone') ?? old('site_phone') }}"
                                    placeholder="{{__('admin.settings.Site Phone')}}"/>
                                    @error('site_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>15, 'min'=>8])}}"></i>
                                    {{__('admin.settings.Site Fax')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_fax" id="site_fax" class="form-control form-control-lg form-control-solid @error('site_fax') is-invalid @enderror" value="{{ setting('site_fax') ?? old('site_fax') }}"
                                    placeholder="{{__('admin.settings.Site Fax')}}"/>
                                    @error('site_fax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>6])}}"></i>
                                    {{__('admin.settings.Site Email')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_email" id="site_email" class="form-control form-control-lg form-control-solid @error('site_email') is-invalid @enderror" value="{{ setting('site_email') ?? old('site_email') }}"
                                    placeholder="{{__('admin.settings.Site Email')}}"/>
                                    @error('site_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>2])}}"></i>
                                    {{__('admin.settings.PO Box')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_po_box" id="site_po_box" class="form-control form-control-lg form-control-solid @error('site_po_box') is-invalid @enderror" value="{{ setting('site_po_box') ?? old('site_po_box') }}"
                                    placeholder="{{__('admin.settings.PO Box')}}"/>
                                    @error('site_po_box')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" title="{{__('admin.min_max_msg', ['max'=>50, 'min'=>2])}}"></i>
                                    {{__('admin.settings.Postal Code')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="site_postal_code" id="site_postal_code" class="form-control form-control-lg form-control-solid @error('site_postal_code') is-invalid @enderror" value="{{ setting('site_postal_code') ?? old('site_postal_code') }}"
                                    placeholder="{{__('admin.settings.Postal Code')}}"/>
                                    @error('site_postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    {{__('admin.Enable En')}}
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" id="enable_en" name="enable_en"
                                        @if(setting('enable_en')=='on') checked @endif/>
                                    </div>
                                    @error('enable_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2" onclick="cancel()">{{__('admin.Discard')}}</button>
                            <button type="submit" class="btn btn-primary bg-color">{{__('admin.Save Changes')}}</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
