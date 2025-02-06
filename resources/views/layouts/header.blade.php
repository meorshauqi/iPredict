<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>

    <title>iPredict</title>
    <meta name="description" content="Page with empty content">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{url('/adminpanel')}}/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles -->


    <!--begin:: Global Mandatory Vendors -->
    <link href="{{url('/adminpanel')}}/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css"
          rel="stylesheet" type="text/css"/>
    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{url('/adminpanel')}}/assets/vendors/general/tether/dist/css/tether.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css"
          rel="stylesheet"
          type="text/css"/>
    <link
        href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css"
        rel="stylesheet"
        type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css"
          rel="stylesheet"
          type="text/css"/>
    <link
        href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css"
        rel="stylesheet"
        type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/dropzone/dist/dropzone.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/quill/dist/quill.snow.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/animate.css/animate.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/toastr/build/toastr.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/socicon/css/socicon.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/adminpanel')}}/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css"
          rel="stylesheet"
          type="text/css"/>
    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{url('/adminpanel')}}/assets/css/demo12/style.bundle.css" rel="stylesheet"
              type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Custom Styles -->
    @yield('styles')
    <!--end::Custom Styles -->

    <link href="{{ asset('landingPage/assets/img/logo.png') }}" rel="icon">
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">


<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div>
    <!-- <div class="kt-header-mobile__logo">
        <a href="{{url('/adminpanel')}}">
            <img alt="Logo" src="{{url('/adminpanel')}}/assets/media/logos/logo-12.png"/>
        </a>
    </div> -->
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>

        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <!-- begin:: Aside -->
    @include('layouts.sidebar')
    <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                <!-- begin: Header Menu -->
                <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i
                        class="la la-close"></i></button>
                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
                        <ul class="kt-menu__nav ">
                        </ul>
                    </div>
                </div>
                <!-- end: Header Menu -->        <!-- begin:: Header Topbar -->
                <div class="kt-header__topbar">
                    <!--begin: Search -->
                    {{-- <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown"
                         id="kt_quick_search_toggle">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                            <span class="kt-header__topbar-icon"><i class="flaticon2-search-1"></i></span>
                        </div>
                        <div
                            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-top-unround dropdown-menu-anim dropdown-menu-lg">
                            <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact"
                                 id="kt_quick_search_dropdown">
                                <form method="get" class="kt-quick-search__form">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="flaticon2-search-1"></i></span></div>
                                        <input type="text" class="form-control kt-quick-search__input"
                                               placeholder="Search...">
                                        <div class="input-group-append"><span class="input-group-text"><i
                                                    class="la la-close kt-quick-search__close"></i></span></div>
                                    </div>
                                </form>
                                <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325"
                                     data-mobile-height="200">

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--end: Search -->


                    <!--begin: User Bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                {{-- <span class="kt-hidden kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                                <span class="kt-hidden kt-header__topbar-username kt-hidden-mobile">Sean</span> --}}
                                <img class="kt-hidden" alt="Pic"
                                     src="{{url('/adminpanel')}}/assets/media/users/300_25.jpg"/>
                                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                @if (auth()->user()->user_type === 'patient')
                                <span
                                    class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder">P
                                </span>
                                @endif
                                @if (auth()->user()->user_type === 'doctor')
                                <span
                                    class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder">D
                                </span>
                                @endif
                                @if (auth()->user()->user_type === 'admin')
                                <span
                                    class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder">A
                                </span>
                                @endif
                            </div>
                        </div>
                        <div
                            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                            <!--begin: Head -->
                            {{-- <div class="kt-user-card kt-user-card--skin-success kt-notification-item-padding-x"
                                 style="background-image: url({{url('/adminpanel')}}/assets/media/misc/bg-1.jpg)">
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden" alt="Pic"
                                         src="{{url('/adminpanel')}}/assets/media/users/300_25.jpg"/>
                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    <span
                                        class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
                                </div>
                                <div class="kt-user-card__name">
                                    Sean Stone
                                </div>
                                <div class="kt-user-card__badge">
                                    <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                                </div>
                            </div> --}}
                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a href="{{ route('profile.personal') }}"
                                   class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Profile
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Account settings and more
                                        </div>
                                    </div>
                                </a>

                                <div class="kt-notification__custom kt-space-between">
                                    <!-- Logout Form (Hidden) -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <!-- Logout Button -->
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">
                                        Sign Out
                                    </a>
                                </div>

                            </div>
                            <!--end: Navigation -->
                        </div>
                    </div>
                    <!--end: User Bar -->
                </div>
                <!-- end:: Header Topbar -->
            </div>
            <!-- end:: Header -->
