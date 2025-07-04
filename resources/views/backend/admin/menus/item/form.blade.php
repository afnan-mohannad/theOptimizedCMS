@extends('backend.app')

@section('title',__('admin.menu_item'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Form-->
            <form class="form d-flex flex-column flex-lg-row" id="itemFrom" role="form" method="POST"
            action="{{ isset($menuItem) ? route('app.menus.item.update',['id'=>$menu->id,'itemId'=>$menuItem->id]) : route('app.menus.item.store',$menu->id) }}">
                @csrf
                @isset($menuItem)
                    @method('PUT')
                @endisset
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
                                            @isset($menuItem)
                                                {{__('admin.menus.Edit Menu Item')}}
                                            @else
                                                {{__('admin.menus.Add New Menu Item to')}} (<code>{{ $menu->name }}</code>)
                                            @endisset
                                            </h2>
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
                                        <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Permission')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="{{__('admin.Select an option')}}" id="permission" name="permission">
                                                @if(isset($permissions) && !empty($permissions))
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->id }}" @isset($menuItem) {{ $menuItem->permission_id == $permission->id ? 'selected' : '' }} @endisset>{{ $permission->name[lang()] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <!--end::Select2-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <br>
                                        <!--begin::Input group-->
                                        <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{__('admin.Type')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="{{__('admin.Select type')}}" id="type" name="type" onchange="setItemType()">
                                                <option value="item" @isset($menuItem) {{ $menuItem == 'item' ? 'selected' : '' }} @endisset>Menu Item</option>
                                                <option value="divider" @isset($menuItem) {{ $menuItem == 'divider' ? 'selected' : '' }} @endisset>Divider</option>
                                            </select>
                                            <!--end::Select2-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7"></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <br>
                                        <!--begin::Input group-->
                                        <div id="divider_fields">
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Title')}} {{ __('admin.(en)') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="divider_title_en" id="divider_title_en" class="form-control mb-2 @error('divider_title_en') is-invalid @enderror" placeholder="{{__('admin.Title')}} {{ __('admin.(en)') }}" value="{{ isset($menuItem->divider_title['en']) ? $menuItem->divider_title['en'] : old('divider_title_en') }}" autofocus required/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('admin.menus.Title of the Divider.')}}</div>
                                                <!--end::Description-->
                                                @error('divider_title_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Title')}} {{__('admin.(ar)') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="divider_title_ar" id="divider_title_ar" class="form-control mb-2 @error('divider_title_ar') is-invalid @enderror" placeholder="{{__('admin.Title')}} {{__('admin.(ar)') }}" value="{{ isset($menuItem->divider_title['ar']) ? $menuItem->divider_title['ar'] : old('divider_title_ar') }}" autofocus required/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('admin.menus.Title of the Divider.')}}</div>
                                                <!--end::Description-->
                                                @error('divider_title_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div id="item_fields">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Title')}} {{ __('admin.(en)') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="title_en" id="title_en" class="form-control mb-2 @error('title_en') is-invalid @enderror" placeholder="{{__('admin.Title')}} {{ __('admin.(en)') }}" value="{{ isset($menuItem) ? $menuItem->title['en'] : old('title_en') }}" required/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('admin.menus.Title of the Menu Item')}}</div>
                                                <!--end::Description-->
                                                @error('title_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Title')}} {{__('admin.(ar)') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="title_ar" id="title_ar" class="form-control mb-2 @error('title_ar') is-invalid @enderror" placeholder="{{__('admin.Title')}} {{__('admin.(ar)') }}" value="{{ isset($menuItem) ? $menuItem->title['ar'] : old('title_ar') }}" required/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('admin.menus.Title of the Menu Item')}}</div>
                                                <!--end::Description-->
                                                @error('title_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">URL</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="url" id="url" class="form-control mb-2 @error('url') is-invalid @enderror" placeholder="URL" value="{{ isset($menuItem) ? $menuItem->url : old('url') }}" required/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7"></div>
                                                <!--end::Description-->
                                                @error('url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Target')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select mb-2 @error('target') is-invalid @enderror" data-control="select2" data-hide-search="true" data-placeholder="{{__('admin.Select the target')}}" id="target" name="target">
                                                    <option value="_self" @isset($menuItem) {{ $menuItem->target == '_self' ? 'selected' : '' }} @endisset>
                                                        Same Tab/Window
                                                    </option>
                                                    <option value="_blank" @isset($menuItem) {{ $menuItem->target == '_blank' ? 'selected' : '' }} @endisset>
                                                        New Tab/Window
                                                    </option>
                                                </select>
                                                <!--end::Select2-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7"></div>
                                                <!--end::Description-->
                                                @error('target')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->
                                            <br>
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{__('admin.Icon')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="icon_class" id="icon_class" class="form-control mb-2 @error('icon_class') is-invalid @enderror" placeholder="{{__('admin.Icon')}}" value="{{ isset($menuItem) ? $menuItem->icon_class : old('icon_class') }}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('admin.menus.Font Icon class')}} <a target="_blank" href="https://icons.getbootstrap.com/">(Bootstrap Font Class)</a></div>
                                                <!--end::Description-->
                                                @error('icon_class')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->
                                        </div>
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
                            @isset($menuItem)
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

@push('js')
    <script type="text/javascript">
        function setItemType(){
            if($('select[name="type"]').val() == 'divider'){
                $('#divider_fields').removeClass('d-none');
                $('#item_fields').addClass('d-none');

                $("#title_en").removeAttr("required");
                $("#title_ar").removeAttr("required");
                $("#url").removeAttr("required");

                $("#divider_title_en").attr("required","required");
                $("#divider_title_ar").attr("required","required");

            }else{
                $('#divider_fields').addClass('d-none');
                $('#item_fields').removeClass('d-none');

                $("#title_en").attr("required","required");
                $("#title_ar").attr("required","required");
                $("#url").attr("required","required");

                $("#divider_title_en").removeAttr("required");
                $("#divider_title_ar").removeAttr("required");
            }
        }; setItemType();
        $('input[name="type"]').change(setItemType);
    </script>
@endpush
