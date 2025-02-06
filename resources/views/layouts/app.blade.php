<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login page for Health Management System">
    <meta name="author" content="iPredict">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iPredict') }}</title>

    <!-- Google Fonts and FontAwesome -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700" rel="stylesheet">
    <link href="{{ asset('adminpanel/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page Custom Styles -->
    <link href="{{ asset('adminpanel/assets/css/demo12/pages/login/login-1.css') }}" rel="stylesheet" type="text/css">

    <!-- Global Mandatory Vendors -->
    <link href="{{ asset('adminpanel/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css">

    <!-- Optional Vendors -->
    <link href="{{ asset('adminpanel/assets/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminpanel/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">

    <!-- Global Theme Styles -->
    <link href="{{ asset('adminpanel/assets/css/demo12/style.bundle.css') }}" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link href="{{ asset('landingPage/assets/img/logo.png') }}" rel="icon">
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- Navigation (Optional if required) -->
    {{-- @include('layouts.navigation')

    <!-- Page Heading (Optional if header is provided) -->
    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset --}}

    <!-- Page Content -->
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        @yield('content') <!-- This is where Blade sections from individual views will be injected -->
    </div>

    <!-- Required Scripts -->
    <script src="{{ asset('adminpanel/assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminpanel/assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminpanel/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminpanel/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminpanel/assets/js/demo12/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminpanel/assets/js/demo12/pages/login/login-1.js') }}" type="text/javascript"></script>
</body>
</html>
