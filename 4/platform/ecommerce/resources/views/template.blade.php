<!doctype html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
<head>
    <meta charset='utf-8'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    @yield('head')
</head>
<body class="@yield('class-body')">
@yield('beforebody')

@yield('header')

@yield('content')

@yield('footer')

<!-- ./wrapper -->
@yield('script')

</body>
</html>
