<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('app.settings.index') ? 'active' : ''  }}" href="{{route('app.settings.index')}}">{{__('admin.General')}}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('app.settings.appearance.index') ? 'active' : ''  }}" href="{{route('app.settings.appearance.index')}}">{{__('admin.settings.Appearence')}}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('app.settings.socialite.index') ? 'active' : ''  }}" href="{{route('app.settings.socialite.index')}}">{{__('admin.settings.Social Accounts')}}</a>
    </li>
    <!--end::Nav item-->
</ul>
<!--begin::Navs-->
