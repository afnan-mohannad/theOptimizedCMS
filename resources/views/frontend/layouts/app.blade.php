<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<!--  Meta Tag -->
@include('frontend.layouts.meta_tag')

<!-- Styles -->
    <!-- Jquery & Bootstrap-->
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/lib/bootstrap/css/bootstrap.5.2.3.rtl.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/navbar.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/main.css">
    <link rel="stylesheet" href="{{config('customConfig.cdn_assets_url')}}/frontend/css/components/footer.css">
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

<div class="bgimg">
@include('frontend.layouts.navbar')
@yield('body')
@include('frontend.layouts.footer')
</div>

<!-- Jquery & Bootstrap JS-->
<script src="{{config('customConfig.cdn_assets_url')}}/frontend/js/components/main.js"></script>
<script src="{{config('customConfig.cdn_assets_url')}}/frontend/lib/bootstrap/js/bootstrap.js"></script>
<!--  End Jquery & Bootstrap JS -->

@yield('script')

@if(config("app.Google_Map_Key")!=null)
    <!-- Google Map -->
    @include('frontend.layouts.google_map')
    <!--  End Google Map -->
@endif

</body>
</html>
