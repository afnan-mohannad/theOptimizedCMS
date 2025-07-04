@extends('backend.app')

@section('title',__('admin.menus.Menu Builder'))


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
            <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%;">
                <!--begin::Card header-->
                <div class="card-header pt-10">
                    <div class="d-flex align-items-center">
                        <!--begin::Svg Icon | path: C:/wamp64/www/keenthemes/core/html/src/media/icons/duotune/general/gen019.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"/>
                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"/>
                            </svg>
                        </span>
                            <!--end::Svg Icon-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            {{__('admin.menus.Menu Manager')}}
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
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header pt-8">
                    <div class="card-title">

                    </div>
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Export-->
                            <a href="{{ route('app.menus.create') }}"><button type="button" class="btn btn-light-primary me-3" >
                            <!--begin::Svg Icon | path: icons/duotune/files/fil013.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                    <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.2C9.7 3 10.2 3.20001 10.4 3.60001ZM16 12H13V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V12H8C7.4 12 7 12.4 7 13C7 13.6 7.4 14 8 14H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V14H16C16.6 14 17 13.6 17 13C17 12.4 16.6 12 16 12Z" fill="currentColor" />
                                    <path opacity="0.3" d="M11 14H8C7.4 14 7 13.6 7 13C7 12.4 7.4 12 8 12H11V14ZM16 12H13V14H16C16.6 14 17 13.6 17 13C17 12.4 16.6 12 16 12Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->{{__('admin.menus.Create Menu')}}</button></a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                @if(isset($menus) && !empty($menus))
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Table-->
                    <table id="kt_file_manager_list" data-kt-filemanager-table="folders" class="table align-middle table-row-dashed fs-6 gy-5">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        #
                                    </div>
                                </th>
                                <th class="min-w-250px">{{__('admin.Name')}}</th>
                                <th class="w-125px"></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($menus as $key=>$menu)
                            <tr>
                                <!--begin::Checkbox-->
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        {{$key+1}}
                                    </div>
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::Name=-->
                                <td data-order="account">
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: C:/wamp64/www/keenthemes/core/html/src/media/icons/duotune/general/gen010.svg-->
                                            <span class="svg-icon svg-icon-muted m-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M2 21V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H3C2.4 22 2 21.6 2 21Z" fill="currentColor"/>
                                                <path d="M2 10V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H3C2.4 11 2 10.6 2 10Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        <a href="{{ route('app.menus.builder',$menu->id) }}" class="text-gray-800 text-hover-primary">{{ $menu->name }}</a>
                                    </div>
                                </td>
                                <!--end::Name=-->
                                <!--begin::Actions-->
                                <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                    <div class="d-flex justify-content-end">
                                        <div class="ms-2">
                                            <a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="{{ route('app.menus.builder',$menu->id) }}">
                                                <i class="bi bi-list-ul"></i>
                                            </a>
                                        </div>
                                        <div class="ms-2">
                                            <a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="{{ route('app.menus.edit',$menu->id) }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        </div>
                                        <div class="ms-2">
                                        @if ($menu->deletable == true)
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                                    onclick="deleteData({{ $menu->id }})">
                                                <i class="bi bi-trash-fill"></i>
                                                <span></span>
                                            </button>
                                            <form id="delete-form-{{ $menu->id }}"
                                                action="{{ route('app.menus.destroy',$menu->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf()
                                                @method('DELETE')
                                            </form>
                                        @endif
                                        </div>
                                    </div>
                                </td>
                                <!--end::Actions-->
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
                @endif
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@endsection

@push('js')

@endpush
