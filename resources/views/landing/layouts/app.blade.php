<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'FlexStart - Bootstrap Template')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('landingPage/assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('landingPage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landingPage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingPage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landingPage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landingPage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingPage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('landingPage/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <!-- Include Header -->
  @include('landing.layouts.header')

  <!-- Main Content -->
  <main class="main">
    @yield('content')
  </main>

  <!-- Include Footer -->
  @include('landing.layouts.footer')

  <!-- Vendor JS Files -->
  <script src="{{ asset('landingPage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landingPage/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landingPage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landingPage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('landingPage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('landingPage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('landingPage/assets/js/main.js') }}"></script>

  <!-- Initialize AOS -->
  <script>
    AOS.init();  // Initialize AOS for animations
  </script>

</body>

</html>
