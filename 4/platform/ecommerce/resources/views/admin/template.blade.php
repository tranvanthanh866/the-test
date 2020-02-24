<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_title ?? 'Dashboard'}}</title>
    <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />

    <meta name="robots" content="noindex, nofollow" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('ecommerce/libs/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ecommerce/libs/flags/css/flag-icon.min.css') }}" rel="stylesheet">

    <link href="{{ asset('ecommerce/dist/admin/css/vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('ecommerce/dist/admin/css/app.css') }}" rel="stylesheet">


    @yield('script.head')

</head>
<body>
<div id="app">
    <div class="main-header d-flex">
        @include('ecommerce::admin.layouts.header')
    </div>
    <div class="main-sidebar">
        @include('ecommerce::admin.layouts.sidebar')
    </div>
    <div class="main-content">
        @include('ecommerce::admin.layouts.bc')
        @yield('content')
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 copy-right" >
                        {{date('Y')}} &copy; by <a href="thanhtv.info" target="_blank">Thanhtv</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="backdrop-sidebar-mobile"></div>
</div>

{{--@include('Media::browser')--}}

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" ></script>
@yield('script.body')

</body>
</html>

