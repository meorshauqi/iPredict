<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item" id="kt_aside_brand">
        <div>
            <h3>
                @if (auth()->user()->user_type === 'patient')
                    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">iPredict</a>
                @elseif (auth()->user()->user_type === 'doctor')
                    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">iPredict</a>
                @elseif (auth()->user()->user_type === 'admin')
                    <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">iPredict</a>
                @endif
            </h3>
        </div>
    </div>
    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div>
        <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav">

                <!-- Patient Sidebar -->
                @if (auth()->user()->user_type === 'patient')
                    <li class="kt-menu__section kt-menu__section--first">
                        <h4 class="kt-menu__section-text">Patient</h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>

                    <li class="kt-menu__item" aria-haspopup="true">
                        <a href="{{ route('dashboard') }}" class="kt-menu__link">
                            <i class="kt-menu__link-icon flaticon2-dashboard"></i>
                            <span class="kt-menu__link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon-user"></i>
                            <span class="kt-menu__link-text">Profile Management</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item" aria-haspopup="true">
                                    <a href="{{ route('profile.personal') }}" class="kt-menu__link">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Edit/Update Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__item" aria-haspopup="true">
                        <a href="{{ route('symptom.checker') }}" class="kt-menu__link">
                            <i class="kt-menu__link-icon flaticon-light"></i>
                            <span class="kt-menu__link-text">Symptom Checker</span>
                        </a>
                    </li>
                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon-layers"></i>
                            <span class="kt-menu__link-text">Appointments</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item" aria-haspopup="true">
                                    <a href="{{ route('appointment.create') }}" class="kt-menu__link">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Add Appointment</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item" aria-haspopup="true">
                                    <a href="{{ route('appointment.list') }}" class="kt-menu__link">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Appointments List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Doctor Sidebar -->
                @if (auth()->user()->user_type === 'doctor')

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__section kt-menu__section--first">
                        <h4 class="kt-menu__section-text">Patient & Doctors</h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>

                    <li class="kt-menu__item" aria-haspopup="true">
                        <a href="{{ route('dashboard') }}" class="kt-menu__link">
                            <i class="kt-menu__link-icon flaticon2-dashboard"></i>
                            <span class="kt-menu__link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon-user"></i>
                            <span class="kt-menu__link-text">Profile Management</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item" aria-haspopup="true">
                                    <a href="{{ route('profile.personal') }}" class="kt-menu__link">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Edit/Update Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                        class="kt-menu__link-icon flaticon-layers"></i><span
                        class="kt-menu__link-text">Patients</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Patients</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('patient.list') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Patients List</span></a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                        class="kt-menu__link-icon flaticon-layers"></i><span
                        class="kt-menu__link-text">Appointments</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Appointments</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('appointment.list') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Appointments List</span></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                @endif

                <!-- Admin Sidebar -->
                @if (auth()->user()->user_type === 'admin')
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__section kt-menu__section--first">
                        <h4 class="kt-menu__section-text">Patient & Doctors</h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>

                    <li class="kt-menu__item" aria-haspopup="true">
                        <a href="{{ route('dashboard') }}" class="kt-menu__link">
                            <i class="kt-menu__link-icon flaticon2-dashboard"></i>
                            <span class="kt-menu__link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon-user"></i>
                            <span class="kt-menu__link-text">Profile Management</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item" aria-haspopup="true">
                                    <a href="{{ route('profile.personal') }}" class="kt-menu__link">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Edit/Update Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                        class="kt-menu__link-icon flaticon-layers"></i><span
                        class="kt-menu__link-text">Patients</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Patients</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('patient.list') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Patients List</span></a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                                    class="kt-menu__link-icon flaticon-layers"></i><span
                                    class="kt-menu__link-text">Doctors</span><i
                                    class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                    class="kt-menu__link"><span class="kt-menu__link-text">Doctors</span></span></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('doctors.create')}}" class="kt-menu__link "><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                    class="kt-menu__link-text">Add Doctor</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('doctors.list')}}" class="kt-menu__link "><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                    class="kt-menu__link-text">Doctors List</span></a></li>
                                            </ul>
                                        </div>
                                </li>

                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                        class="kt-menu__link-icon flaticon-layers"></i><span
                        class="kt-menu__link-text">Appointments</span><i
                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Appointments</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('appointment.list') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                    class="kt-menu__link-text">Appointments List</span></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                @endif

                <!-- Shared Menu -->

            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->
