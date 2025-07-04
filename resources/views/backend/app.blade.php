<!DOCTYPE html>
<html lang="{{ lang() }}" @if (lang() =="ar")dir="rtl"@endif>
	<!--begin::Head-->
	<head><base href="">
		<title>@yield('title') | {{ setting('site_title_'.lang()) }}</title>
		<meta charset="utf-8" />
		<meta name="description" content="{{ setting('site_description_'.lang()) }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="{{app()->getLocale()}}" />
		<meta property="og:type" content="CMS" />
		<meta property="og:title" content="@yield('title') | {{ setting('site_title_'.lang()) }}" />
		<meta property="og:url" content="{{urldecode(Request::url())}}" />
		<meta property="og:site_name" content="@yield('title') | {{ setting('site_title_'.lang()) }}" /> 
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="canonical" href="{{urldecode(Request::url())}}" />
		<link rel="shortcut icon" href="{{setting('site_favicon')!==null ? asset('storage/'.setting('site_favicon')) : asset('assets/frontend/images/Fav_Icon.svg')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		@if (lang() == "en")
			<!--begin::Global Stylesheets Bundle(used by all pages)-->
			<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
			<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
			<link href="{{config('customConfig.cdn_assets_url')}}/backend/css/styles.css" rel="stylesheet" type="text/css" />
			<!--end::Global Stylesheets Bundle-->
		@else
			<!--begin::Global Stylesheets Bundle(used by all pages)-->
			<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/rtl/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
			<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/rtl/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
			<link href="{{config('customConfig.cdn_assets_url')}}/backend/css/styles.rtl.css" rel="stylesheet" type="text/css" />
			<!--end::Global Stylesheets Bundle-->
		@endif
		
        @stack('css')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body data-kt-name="metronic" id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
		<!--begin::Theme mode setup on page load-->
		<script>
        	if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }
        </script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				@include('backend.layouts.partials.sidebar')
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    @include('backend.layouts.partials.header')
                    @yield('content')
					@include('livewire.admin.messages')
					@include('backend.layouts.partials.js_translations')
                    @include('backend.layouts.partials.footer')
                </div>
                <!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script src="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/js/scripts.bundle.js"></script>
        <script src="{{config('customConfig.cdn_assets_url')}}/backend/js/script.js"></script>
		<!--end::Javascript-->

        @stack('js')

        @if (Session::has('success'))
            <script>
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": 1000,
                }
                toastr.success("{{ Session::get('success') }}")
            </script>
        @endif
        @if (Session::has('error'))
            <script>
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": 1000,
                }
                toastr.error("{{ Session::get('error') }}")
            </script>
        @endif
        @if (Session::has('info'))
            <script>
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": 1000,
                }
                toastr.info("{{ Session::get('info') }}")
            </script>
        @endif
        @if (Session::has('warning'))
            <script>
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": 1000,
                }
                toastr.warning("{{ Session::get('warning') }}")
            </script>
        @endif

	</body>
	<!--end::Body-->
</html>
