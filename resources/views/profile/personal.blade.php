@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
    <link rel="stylesheet" href="{{ url('select2/dist/css/select2.min.css') }}">
@endsection

@section('content')


<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
					                <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>

                Profile 1                            </h3>

                    </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                                    <a href="#" class="btn kt-subheader__btn-primary">
                        Actions &nbsp;
                        <!--<i class="flaticon2-calendar-1"></i>-->
                    </a>

                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" id="Combined-Shape" fill="#000000"/>
    </g>
</svg>                        <!--<i class="flaticon2-plus"></i>-->
                    </a>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                        <!--begin::Nav-->
                        <ul class="kt-nav">
                            <li class="kt-nav__head">
                                Add anything or jump to:
                                <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                            </li>
                            <li class="kt-nav__separator"></li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-drop"></i>
                                    <span class="kt-nav__link-text">Order</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                    <span class="kt-nav__link-text">Ticket</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                    <span class="kt-nav__link-text">Goal</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                    <span class="kt-nav__link-text">Support Case</span>
                                    <span class="kt-nav__link-badge">
                                        <span class="kt-badge kt-badge--success">5</span>
                                    </span>
                                </a>
                            </li>
                            <li class="kt-nav__separator"></li>
                            <li class="kt-nav__foot">
                                <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                            </li>
                        </ul>
                        <!--end::Nav-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Aside-->
        <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
            <!--begin:: Widgets/Applications/User/Profile1-->
    <div class="kt-portlet ">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit-y">
            <!--begin::Widget -->
            <div class="kt-widget kt-widget--user-profile-1">
                <div class="kt-widget__head">
                    <div class="kt-widget__content">
                        <div class="kt-widget__section">
                            <a href="#" class="kt-widget__username">
                                {{ $user->name ?? 'Not Provided' }}
                                <i class="flaticon2-correct kt-font-success"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__content">
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Email:</span>
                            <a href="#" class="kt-widget__data">{{ $user->email ?? 'Not Provided' }}</a>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Phone:</span>
                            <a href="#" class="kt-widget__data">+60{{ $user->phone ?? 'Not Provided' }}</a>
                        </div>
                    </div>
                    <div class="kt-widget__items">
                        <a href="{{route('profile.personal')}}" class="kt-widget__item kt-widget__item--active">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="kt-widget__desc">
                                    Personal Information
                                </span>
                            </span>
                        </a>
                        <a href="{{route('profile.password')}}" class="kt-widget__item ">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                                <span  class="kt-widget__desc">
                                    Change Password
                                </span>
                            </span>

                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Widget -->
        </div>
    </div>
    <!--end:: Widgets/Applications/User/Profile1-->

         </div>
        <!--End:: App Aside-->

        <!--Begin:: App Content-->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container kt-container--fluid">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Personal Information
            </h3>
        </div>
    </div>
</div>

<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Personal Information <small>Update your personal information</small></h3>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <div class="kt-section__body">

                        <!-- Common Fields for Both Users -->
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" name="name" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="email" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Phone</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" placeholder="Update phone number">
                            </div>
                        </div>

                        <!-- Conditional Fields for Doctor -->
                        @if(Auth::user()->user_type === 'doctor')
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Department</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" value="{{ $user->doctor->department }}" disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Conditional Fields for Admin -->
                        @if(Auth::user()->user_type === 'admin')
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Role</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" value="{{ $user->admin->role_description }}" disabled>
                                </div>
                            </div>
                        @endif

                        <!-- Conditional Fields for Patient -->
                        @if(Auth::user()->user_type === 'patient')
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">IC Number</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" name="ic" value="{{ $patient->ic ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Address</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" name="address" value="{{ $patient->address ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Date of Birth</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="date" name="date_of_birth" value="{{ $patient->date_of_birth ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ (old('gender', $patient->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ (old('gender', $patient->gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-3 col-xl-3"></div>
                        <div class="col-lg-9 col-xl-9">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                            <a href="{{ route('profile.personal') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



        <!--End:: App Content-->
    </div>
    <!--End::App-->


        </div>
@endsection

