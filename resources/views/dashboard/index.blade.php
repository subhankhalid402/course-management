@extends('layout.master')
@section('page_title','Dashboard')
@section('content')
    <!--begin::Content wrapper-->
    <div id="main-content-body" class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        @yield('page_title')</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body p-0">
                        <!--begin::Wrapper-->
                        <div class="card-px text-center py-20 my-10">
                            <div class="row g-5 g-xl-8">
                                <div class="col-xl-3">

                                    <!--begin::Statistics Widget 5-->
                                    <a href="{{ env('BASE_URL') }}users"
                                       class="card bg-secondary hoverable card-xl-stretch mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <i class="ki-duotone ki-user text-primary fs-2x ms-n1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>

                                            <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">
                                                {{ $total_users }}
                                            </div>

                                            <div class="fw-semibold text-gray-400">
                                                Users
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->    </div>

                                <div class="col-xl-3">

                                    <!--begin::Statistics Widget 5-->
                                    <a href="{{ env('BASE_URL') }}dogs"
                                       class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <i class="fas fa-dog text-gray-100 fs-2x ms-n1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span><span class="path6"></span><span
                                                    class="path7"></span></i>

                                            <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">
                                                {{ $total_dogs }}
                                            </div>

                                            <div class="fw-semibold text-gray-100">
                                                Dogs
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->    </div>

                                @foreach($preference as $p => $count)
                                    <div class="col-xl-3">

                                        <!--begin::Statistics Widget 5-->
                                        <a href="{{ env('BASE_URL') }}dogs?preference={{$p}}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <i class="fas fa-shield-dog text-white fs-2x ms-n1"><span
                                                        class="path1"></span><span class="path2"></span></i>

                                                <div class="text-white fw-bold fs-2 mb-2 mt-5">
                                                    {{ $count }}
                                                </div>

                                                <div class="fw-semibold text-white">
                                                    {{ $p }}
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Statistics Widget 5-->    </div>
                                @endforeach



                            </div>
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Illustration-->
                        <div class="text-center px-4">
                            <img class="mw-100 mh-300px" alt="" src="{{asset('assets/media/general/home.png')}}"/>
                        </div>
                        <!--end::Illustration-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
