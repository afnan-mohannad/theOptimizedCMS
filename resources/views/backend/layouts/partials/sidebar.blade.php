<!--begin::Aside-->
<div id="kt_aside" class="aside">
    <!--begin::Aside Toolbarl-->
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
        <!--begin::Aside user-->
        <!--begin::User-->
        <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
            <!--begin::Symbol-->
            <div class="symbol symbol-50px">
                <img src="{{ isset(Auth::user()->avatar) && Auth::user()->avatar != ''  ? asset('/storage/'. Auth::user()->avatar) : asset('assets/backend/images/avatars/blank.png')}}" alt="{{ Auth::user()->name }}" />
            </div>
            <!--end::Symbol-->
            <!--begin::Wrapper-->
            <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                <!--begin::Section-->
                <div class="d-flex">
                    <!--begin::Info-->
                    <div class="flex-grow-1 me-2">
                        <!--begin::Username-->
                        <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ Auth::user()->name }}</a>
                        <!--end::Username-->
                        <!--begin::Description-->
                        <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ Auth::user()->role->name }}</span>
                        <!--end::Description-->
                        <!--begin::Label-->
                        <div class="d-flex align-items-center text-success fs-9">
                        <span class="bullet bullet-dot bg-success me-1"></span>{{__('admin.online')}}</div>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                    <!--begin::User menu-->
                    <div class="me-n2">
                        <!--begin::Action-->
                        <a class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor" />
                                    <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true" id="user-drop-down">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img class="border-radius-50" alt="{{Auth::user()->name}}" src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('assets/backend/images/avatars/blank.png')}}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5">{{Auth::user()->name}}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
                                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start">
                                <a class="menu-link px-5">
                                    <span class="menu-title position-relative">{{__('admin.Language')}}
                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                    @if (app()->getLocale() == 'ar')
                                    {{__('admin.Arabic')}}
                                    <img class="w-15px h-15px rounded-1 ms-2" src="{{asset('assets/backend/metronic/ltr/src/media/flags/palestine.svg')}}" alt="English" /></span></span>
                                    @else 
                                    {{__('admin.English')}}
                                    <img class="w-15px h-15px rounded-1 ms-2" src="{{asset('assets/backend/metronic/ltr/src/media/flags/united-states.svg')}}" alt="English" /></span></span>
                                    @endif
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    @if (app()->getLocale() == 'en')
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('language','ar') }}" class="menu-link d-flex px-5 active">
                                                <span class="symbol symbol-20px me-4">
                                                    <img class="rounded-1" src="{{asset('assets/backend/metronic/ltr/src/media/flags/palestine.svg')}}" alt="Arabic" />
                                                </span>{{__('admin.Arabic')}}
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    @else
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('language','en') }}" class="menu-link d-flex px-5 active">
                                                <span class="symbol symbol-20px me-4">
                                                    <img class="rounded-1" src="{{asset('assets/backend/metronic/ltr/src/media/flags/united-states.svg')}}" alt="English" />
                                                </span>{{__('admin.English')}}
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    @endif
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{route('app.profile.index')}}" class="menu-link px-5">{{__('admin.My Profile')}}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5 my-1">
                                <a href="{{route('app.profile.password.change')}}" class="menu-link px-5">{{__('admin.profile.Update Password')}}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('app.settings.index')
                            <div class="menu-item px-5 my-1">
                                <a href="{{route('app.settings.index','General')}}" class="menu-link px-5">{{__('admin.Account Settings')}}</a>
                            </div>   
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="menu-link px-5">{{__('admin.Sign Out')}}</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Action-->
                    </div>
                    <!--end::User menu-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::User-->
        <!--end::Aside user-->
    </div>
    <!--end::Aside Toolbarl-->
    <x-backend-side-menu />
</div>
<!--end::Aside-->
