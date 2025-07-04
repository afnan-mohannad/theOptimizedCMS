@extends('backend.app')

@section('title',__('admin.Roles'))

@section('li1',__('admin.Listing'))
@section('li1_link',route('app.roles.index'))
@if (isset($role) && !empty($role))
    @section('li2',__('admin.Edit'))
    @section('li2_link',route('app.roles.edit',$role->id))
@else
    @section('li2',__('admin.Add'))
    @section('li2_link',route('app.roles.create')) 
@endif

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
               <!--begin::Card-->
               <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%;">
                <!--begin::Card header-->
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <!--begin::Svg Icon | path: C:/wamp64/www/keenthemes/core/html/src/media/icons/duotune/general/gen003.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0079 2.6L15.7079 7.2L21.0079 8.4C21.9079 8.6 22.3079 9.7 21.7079 10.4L18.1079 14.4L18.6079 19.8C18.7079 20.7 17.7079 21.4 16.9079 21L12.0079 18.8L7.10785 21C6.20785 21.4 5.30786 20.7 5.40786 19.8L5.90786 14.4L2.30785 10.4C1.70785 9.7 2.00786 8.6 3.00786 8.4L8.30785 7.2L11.0079 2.6C11.3079 1.8 12.5079 1.8 13.0079 2.6Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <h2 class="m-5">{{ isset($role) ? __('admin.Edit') : __('admin.Create') }} {{__('admin.Role')}}</h2>
                        </div>
                        <!--end::Title-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pb-0">

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <!-- form start -->
                    <form id="roleFrom" role="form" method="POST"
                          action="{{ isset($role) ? route('app.roles.update',$role->id) : route('app.roles.store') }}">
                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{__('admin.roles.Manage Roles')}}</h5>
                            <br>
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">{{__('admin.Name')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name" id="name" class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="{{__('admin.Name')}}" value="{{ $role->name ?? ''  }}" required autofocus/>
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
                            <br>
                            <div class="text-center">
                                <strong>{{__('admin.roles.note1')}}</strong>
                                @error('permissions')
                                <p class="p-2">
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                    <label class="custom-control-label" for="select-all">{{__('admin.Select All')}}</label>
                                </div>
                            </div>
                            <br>
                            @forelse($modules->chunk(2) as $key => $chunks)
                                <div class="form-row">
                                    @foreach($chunks as $key=>$module)
                                        <div class="col">
                                            <h5>{{__('admin.Module')}}: {{ $module->name[lang()] }}</h5>
                                            @foreach($module->permissions as $key=>$permission)
                                                <div class="mb-3 ml-4">
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="permission-{{ $permission->id }}"
                                                               value="{{ $permission->id }}"
                                                               name="permissions[]"
                                                        @if(isset($role))
                                                            @foreach($role->permissions as $rPermission)
                                                            {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                            @endforeach
                                                        @endif
                                                        >
                                                        <label class="custom-control-label"
                                                               for="permission-{{ $permission->id }}">{{ $permission->name[lang()] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            @empty
                                <!--begin::Empty-->
                                <div data-kt-search-element="empty" class="text-center">
                                    <!--begin::Icon-->
                                    <div class="pt-10 pb-10">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                        <span class="svg-icon svg-icon-4x opacity-50">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor" />
                                                <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor" />
                                                <rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="currentColor" />
                                                <path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Message-->
                                    <div class="pb-15 fw-semibold">
                                        <h3 class="text-gray-600 fs-5 mb-2">{{__('admin.No Result Found.')}}</h3>
                                    </div>
                                    <!--end::Message-->
                                </div>
                                <!--end::Empty-->
                            @endforelse

                            <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span>{{__('admin.Reset')}}</span>
                            </button>

                            <button type="submit" class="btn btn-primary bg-color">
                                @isset($role)
                                    <i class="bi bi-pencil-fill"></i>
                                    <span>{{__('admin.Update')}}</span>
                                @else
                                    <i class="bi bi-plus-circle-fill"></i>
                                    <span>{{__('admin.Create')}}</span>
                                @endisset
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection

@push('js')
    <script type="text/javascript">
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
