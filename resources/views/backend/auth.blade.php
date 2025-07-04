<!DOCTYPE html>
<html lang="{{ lang() }}">
	<!--begin::Head-->
	<head><base href="">
		<title>{{setting('site_title_'.lang())}}</title>
		<meta charset="utf-8" />
		<meta name="description" content="{{setting('site_description')}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="{{app()->getLocale()}}" />
		<meta property="og:type" content="CMS" />
		<meta property="og:title" content="{{setting('site_title_'.lang())}}" />
		<meta property="og:url" content="{{urldecode(Request::url())}}" />
		<meta property="og:site_name" content="{{setting('site_title_'.lang())}}" />
		<link rel="canonical" href="{{urldecode(Request::url())}}" />
		<link rel="shortcut icon" href="{{setting('site_favicon')!==null ? asset('storage/'.setting('site_favicon')) : asset('assets/frontend/images/Fav_Icon.svg')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{config('customConfig.cdn_assets_url')}}/backend/css/styles.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body data-kt-name="metronic" id="kt_body" class="bg-auth app-blank bgi-size-cover bgi-position-center bgi-no-repeat" style="">
		<!--begin::Theme mode setup on page load-->
		<script>
			if ( document.documentElement ) { 
				const defaultThemeMode = "system"; 
				const name = document.body.getAttribute("data-kt-name"); 
				let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); 
				if ( themeMode === null ) { 
					if ( defaultThemeMode === "system" ) { 
						themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; 
					} else { 
						themeMode = defaultThemeMode;
					} 
				} document.documentElement.setAttribute("data-theme", themeMode); 
			}
		</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!-- Page Content -->
			<main>
			{{ $slot }}
			</main>
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{config('customConfig.cdn_assets_url')}}/backend/metronic/ltr/assets/";</script>
		<script src="{{config('customConfig.cdn_assets_url')}}/backend/js/login.js"></script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>