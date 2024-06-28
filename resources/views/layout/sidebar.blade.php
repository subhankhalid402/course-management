<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <img alt="Logo" src="{{asset('assets/media/logo.png')}}"
             class="h-50px app-sidebar-logo-minimize"/>
        <a href="{{ env('BASE_URL') }}">
            <img alt="Logo" src="{{asset('assets/media/logo.png')}}"
                 class="h-125px app-sidebar-logo-default"/>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <style type="text/css">
        i.bi, i[class^=fonticon-], i[class*=" fonticon-"], i[class^=fa-], i[class*=" fa-"], i[class^=la-], i[class*=" la-"] {
            color: var(--custom-bg-secondary);
        }

        .menu-link.active > i.bi,
        .menu-link.active [class^=fonticon-],
        .menu-link.active [class*=" fonticon-"],
        .menu-link.active [class^=fa-],
        .menu-link.active [class*=" fa-"],
        .menu-link.active [class^=la-],
        .menu-link.active [class*=" la-"] {
            color: var(--bs-primary-inverse);
        }

        /*.menu-item.menu-accordion.here.show i.bi {*/
        /*    color: var(--bs-primary-inverse);*/
        /*}*/
    </style>
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">

                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ isset($menu) && $menu == 'dashboard' ? 'active' : '' }}"
                       href="{{env('BASE_URL').'dashboard'}}">
                        <i class="bi bi-bar-chart-line fs-3 mx-2"></i>
                        <span class="menu-title fw-bold">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ isset($menu) && ($menu == 'preference_play' || $menu == 'preference_mate' || $menu == 'preference_missing' || $menu == 'preference_adopt') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="">
                            <i class="bi bi-stack fs-3 mx-2"></i>
                        </span>
                        <span class="menu-title fw-bold">Preferences</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <!--begin:Menu item-->
                        <div class="menu-item">

                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'preference_play' ? 'active' : '' }}" href="{{env('BASE_URL').'dogs?preference=play'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Play</span>
                            </a>
                            <!--end:Menu link-->

                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'preference_mate' ? 'active' : '' }}" href="{{env('BASE_URL').'dogs?preference=mate'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Mate</span>
                            </a>
                            <!--end:Menu link-->

                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'preference_missing' ? 'active' : '' }}" href="{{env('BASE_URL').'dogs?preference=missing'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Missing</span>
                            </a>
                            <!--end:Menu link-->
                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'preference_adopt' ? 'active' : '' }}" href="{{env('BASE_URL').'dogs?preference=adopt'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Adopt</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ isset($menu) && ($menu == 'terms_and_conditions' || $menu == 'privacy_policy' || $menu == 'contact_us') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="">
                            <i class="bi bi-info-square-fill fs-3 mx-2"></i>
                        </span>
                        <span class="menu-title fw-bold">Support</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <!--begin:Menu item-->
                        <div class="menu-item">

                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'terms_and_conditions' ? 'active' : '' }}" href="{{env('BASE_URL').'support/terms-and-conditions'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Terms and Conditions</span>
                            </a>
                            <!--end:Menu link-->

                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'privacy_policy' ? 'active' : '' }}" href="{{env('BASE_URL').'support/privacy-policy'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Privacy Policy</span>
                            </a>
                            <!--end:Menu link-->

                            <!--begin:Menu link-->
                            <a class="menu-link {{ isset($menu) && $menu == 'contact_us' ? 'active' : '' }}" href="{{env('BASE_URL').'support/contact-us'}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fw-bold">Contact Us</span>
                            </a>
                            <!--end:Menu link-->

                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->


                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ isset($menu) && $menu == 'change_password' ? 'active' : '' }}"
                       href="{{env('BASE_URL').'auth/change-password'}}">
                        <i class="bi bi-lock fs-3 mx-2"></i>
                        <span class="menu-title fw-bold">Change Password</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
            {{--                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">--}}
            {{--                    <!--begin:Menu link-->--}}
            {{--                    <span class="menu-link">--}}
            {{--                        <span class="menu-icon">--}}
            {{--                            <i class="ki-duotone ki-chart-pie-3 fs-2">--}}
            {{--                                <span class="path1"></span>--}}
            {{--                                <span class="path2"></span>--}}
            {{--                                <span class="path3"></span>--}}
            {{--                            </i>--}}
            {{--                        </span>--}}
            {{--                        <span class="menu-title fw-bold">Default</span>--}}
            {{--                        <span class="menu-arrow"></span>--}}
            {{--                    </span>--}}
            {{--                    <!--end:Menu link-->--}}
            {{--                    <!--begin:Menu sub-->--}}
            {{--                    <div class="menu-sub menu-sub-accordion menu-active-bg">--}}
            {{--                        <!--begin:Menu item-->--}}
            {{--                        <div class="menu-item">--}}
            {{--                            <!--begin:Menu link-->--}}
            {{--                            <a class="menu-link" href="{{env('BASE_URL').'default/create'}}">--}}
            {{--                                <span class="menu-bullet">--}}
            {{--                                    <span class="bullet bullet-dot"></span>--}}
            {{--                                </span>--}}
            {{--                                <span class="menu-title fw-bold">Create Form Extended</span>--}}
            {{--                            </a>--}}
            {{--                            <!--end:Menu link-->--}}
            {{--                        </div>--}}
            {{--                        <!--end:Menu item-->--}}
            {{--                        <!--begin:Menu item-->--}}
            {{--                        <div class="menu-item">--}}
            {{--                            <!--begin:Menu link-->--}}
            {{--                            <a class="menu-link" href="{{env('BASE_URL').'default/list'}}">--}}
            {{--                                <span class="menu-bullet">--}}
            {{--                                    <span class="bullet bullet-dot"></span>--}}
            {{--                                </span>--}}
            {{--                                <span class="menu-title fw-bold">Form List</span>--}}
            {{--                            </a>--}}
            {{--                            <!--end:Menu link-->--}}
            {{--                        </div>--}}
            {{--                        <!--end:Menu item-->--}}
            {{--                    </div>--}}
            {{--                    <!--end:Menu sub-->--}}
            {{--                </div>--}}
            <!--end:Menu item-->

                <!--begin:Menu item-->
            {{--                <div class="menu-item">--}}
            {{--                    <!--begin:Menu link-->--}}
            {{--                    <a class="menu-link" href="{{env('BASE_URL').'users'}}">--}}
            {{--                        <i class="bi bi-person-lines-fill fs-3 mx-2"></i>--}}
            {{--                        <span class="menu-title fw-bold">Users Management</span>--}}
            {{--                    </a>--}}
            {{--                    <!--end:Menu link-->--}}
            {{--                </div>--}}
            <!--end:Menu item-->

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="#"
           class="logout btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
           title="Click here to Logout">
            <span class="btn-label">Logout</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
