@if (request()->is('app/*'))
<!DOCTYPE html>
<html lang="{{ lang() }}">
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
		<link rel="shortcut icon" href="{{setting('site_favicon')!==null ? asset('storage/'.setting('site_favicon')) : asset('assets/backend/images/favicon/favicon-32x32.png')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->

		<!--begin::Global Stylesheets Bundle(used by all pages)-->

		<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	

		<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		
		<link href="{{config('customConfig.cdn_assets_url')}}/backend/css/styles.css" rel="stylesheet" type="text/css" />

		<!--end::Global Stylesheets Bundle-->
		
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
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center text-center p-10">
                        <!--begin::Wrapper-->
                        <div class="card card-flush w-lg-650px py-5">
                            <div class="card-body py-15 py-lg-20">
                                <!--begin::Title-->
                                <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">@yield('code')</h1>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-semibold fs-6 text-gray-500 mb-7">@yield('message')</div>
                                <!--end::Text-->
                                <!--begin::Illustration-->
                                <div class="mb-3">
                                    
                                </div>
                                <!--end::Illustration-->
                                <!--begin::Link-->
                                <div class="mb-0">
                                    <a href="{{route('app.dashboard')}}" class="btn btn-sm btn-primary bg-color">{{__('admin.Dashboard')}}</a>
                                </div>
                                <!--end::Link-->
                            </div>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script src="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/js/scripts.bundle.js"></script>
        <script src="{{config('customConfig.cdn_assets_url')}}/backend/js/script.js"></script>
		<!--end::Javascript-->
        @stack('js')
	</body>
	<!--end::Body-->
</html>
 
@else

<!DOCTYPE html>
<html lang="{{lang()}}">
<head>

<!--  Meta Tag -->
@include('frontend.layouts.meta_tag')

<!-- Styles -->
    <style>
    @font-face {
        font-family: Playfair-Bold;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Playfair_Display/PlayfairDisplay-Bold.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: Playfair-Regular;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Playfair_Display/PlayfairDisplay-Regular.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: PlayfairDisplay-ExtraBold;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Playfair_Display/PlayfairDisplay-ExtraBold.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: SourceSans3-Light;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Source_Sans_3/SourceSans3-Light.woff2");
        font-display: swap;
    }
    @font-face {
        font-family: SourceSans3-Regular;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Source_Sans_3/SourceSans3-Regular.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: SourceSans3-SemiBoldItalic;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Source_Sans_3/SourceSans3-SemiBoldItalic.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: SourceSans3-SemiBold;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Source_Sans_3/SourceSans3-Bold.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: Roboto-Medium;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Roboto/Roboto-Medium.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: Roboto-MediumItalic;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Roboto/Roboto-MediumItalic.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: Roboto-Bold;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Roboto/Roboto-Bold.ttf");
        font-display: swap;
    }
    @font-face {
        font-family: PlayfairDisplay-Medium;
        src: url("{{config('customConfig.cdn_assets_url')}}/frontend/fonts/Playfair_Display/PlayfairDisplay-Medium.ttf");
        font-display: swap;
    }
    </style>
    <!-- Jquery & Bootstrap-->
    @if(lang() === 'ar' || lang() === 'ar' )
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/lib/bootstrap/css/bootstrap.5.2.3.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/main.rtl.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/navbar.rtl.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/footer.rtl.css">
    @else
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/lib/bootstrap/css/bootstrap.5.2.3.rtl.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/main.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/navbar.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/footer.css">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    @yield('style')
<!-- End Style -->

<!-- Fonts -->
@yield('fonts')
<!-- End Fonts -->

@if(config("app.Google_Analytics_ID")!=null)
<!-- Google Analytics -->
    @include('frontend.layouts.google_analytics')
<!--  End Google Analytics -->
@endif

</head>

<body>
    @include('frontend.layouts.navbar')
    <section>
        <div class="container">
            <div class="row wrapperPaddding">
            <div class="col-12 px-0">
                <center>
                    <div class="mt-5 pt-5">
                        <h1> @yield('code') </h1>
                        <p>
                            @yield('message')
                        </p>
                        <img src="@yield('image')" title="@yield('message')">
                    </div>
                </center>
            </div>
            </div>
        </div>
    </section>
    @include('frontend.layouts.footer')
    <!-- Jquery & Bootstrap JS-->
    <script src="{{config('customConfig.cdn_assets_url')}}/frontend/lib/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{config('customConfig.cdn_assets_url')}}/frontend/js/components/main.js"></script>
    <!--  End Jquery & Bootstrap JS -->
    @yield('script')
</body>   

</html>
@endif

