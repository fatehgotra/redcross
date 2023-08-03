<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading" data-layout-config='{"darkMode":false}'>

    <!-- ========== Navbar Start ========== -->
    @include('guest.includes.navbar')
    <!-- ========== Navbar End ============ -->

    @yield('content')

    <!-- ========== Footer Start ========== -->
    @include('guest.includes.footer')
    <!-- ========== Footer End ============ -->

    @include('guest.includes.script')
</body>

</html>
