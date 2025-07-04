@extends('backend.app')

@section('title',__('admin.menus.Menu Builder'))

@push('css')
    <link href="{{asset('assets/backend/metronic/ltr/assets/css/menu-builder.min.css') }}" rel="stylesheet">
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
                            <h2 class="m-5">{{__('admin.menus.Menu Builder')}} ({{ $menu->name }})</h2>
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
                            <a href="{{ route('app.menus.index') }}"><button type="button" class="btn btn-light-primary me-3">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="bi bi-arrow-left-circle-fill"></i>
                                </span>
                                {{ __('admin.Back to list') }}</button></a>
                                <!--begin::Export-->
                            <a href="{{ route('app.menus.item.create',$menu->id) }}"><button type="button" class="btn btn-light-success me-3">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </span>
                                {{ __('admin.Add New Item') }}</button></a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <div class="dd">
                        <x-menu-builder :menuItems="$menu->menuItems"/>
                    </div>
                </div>
                <!--end::Card body-->
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js" integrity="sha512-a3kqAaSAbp2ymx5/Kt3+GL+lnJ8lFrh2ax/norvlahyx59Ru/1dOwN1s9pbWEz1fRHbOd/gba80hkXxKPNe6fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(function () {
            $('.dd').nestable({maxDepth: 2});
            $('.dd').on('change', function (e) {
                $.post('{{ route('app.menus.order',$menu->id) }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    toastr.success("Successfully updated menu order.")
                });
            });
        });
    </script>

@endpush
